<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with('details.product')
    ->where('status', 'Dipinjam')
    ->latest()
    ->paginate(10);
    
        $totalDipinjam = Borrowing::where(
            'status',
            'Dipinjam'
        )->count();

        $totalDikembalikan = Borrowing::where(
            'status',
            'Dikembalikan'
        )->count();

        $totalPeminjam = Borrowing::count();

        $terlambat = Borrowing::where(
            'status',
            'Dipinjam'
        )
        ->whereDate(
            'return_date',
            '<',
            now()
        )
        ->count();

       $products = Product::where('stock', '>', 0)
    ->where('status', 'Tersedia')
    ->get();

        return view(
            'borrowings',
            compact(
                'borrowings',
                'products',
                'totalDipinjam',
                'totalDikembalikan',
                'totalPeminjam',
                'terlambat'
            )
        );
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'borrower_name' => 'required',
                'division' => 'nullable',
                'phone' => 'nullable',
                'borrow_date' => 'required',
                'return_date' => 'required',
                'product_id' => 'required',
                'qty' => 'required'
            ]);

            $last = Borrowing::latest()->first();

            $number = $last
                ? $last->id + 1
                : 1;

            $code = 'BRW' .
                str_pad(
                    $number,
                    4,
                    '0',
                    STR_PAD_LEFT
                );

            $borrowing = Borrowing::create([

                'borrow_code' => $code,

                'borrower_name' =>
                    $request->borrower_name,

                'division' =>
                    $request->division,

                'phone' =>
                    $request->phone,

                'borrow_date' =>
                    $request->borrow_date,

                'return_date' =>
                    $request->return_date,

                'status' =>
                    'Dipinjam'
            ]);

            foreach (
                $request->product_id
                as $key => $productId
            ) {

                $qty =
                    $request->qty[$key];

                $product =
                    Product::findOrFail(
                        $productId
                    );

                if (
                    $product->stock < $qty
                ) {
                    return back()
                        ->with(
                            'error',
                            'Stok tidak cukup'
                        );
                }

                BorrowingDetail::create([

                    'borrowing_id' =>
                        $borrowing->id,

                    'product_id' =>
                        $productId,

                    'qty' =>
                        $qty

                ]);

                $product->stock -= $qty;

if ($product->stock <= 0) {
    $product->status = 'Dipinjam';
}

$product->save();
            }

            DB::commit();

            return redirect()
                ->route(
                    'borrowings.index'
                )
                ->with(
                    'success',
                    'Peminjaman berhasil'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    public function returnItem(
        Borrowing $borrowing
    )
    {
        DB::beginTransaction();

        try {

            foreach (
                $borrowing->details
                as $detail
            ) {

               $product = $detail->product;

$product->stock += $detail->qty;

if ($product->status == 'Dipinjam') {
    $product->status = 'Tersedia';
}

$product->save();
            }

            $borrowing->update([

                'status' =>
                    'Dikembalikan'

            ]);

            DB::commit();

            return back()
                ->with(
                    'success',
                    'Barang berhasil dikembalikan'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    public function destroy(
        Borrowing $borrowing
    )
    {
        $borrowing->delete();

        return back()
            ->with(
                'success',
                'Data berhasil dihapus'
            );
    }


    public function history()
{
    $histories = Borrowing::with('details.product')
        ->where('status', 'Dikembalikan')
        ->latest()
        ->paginate(10);

    return view(
        'history',
        compact('histories')
    );
}
}