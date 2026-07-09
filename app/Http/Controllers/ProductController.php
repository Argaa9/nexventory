<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('product_name', 'like', "%{$search}%")
                    ->orWhere('product_code', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        $categories = Category::all();

        $totalBarang = Product::count();

        $totalKategori = Category::count();

        $stokMenipis = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->count();

        $barangTersedia = Product::where(
            'status',
            'Tersedia'
        )->count();

        return view('products', compact(
            'products',
            'categories',
            'totalBarang',
            'totalKategori',
            'stokMenipis',
            'barangTersedia'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'product_code'     => 'required|unique:products,product_code',
            'product_name'     => 'required|max:255',
            'description'      => 'nullable',
            'stock'            => 'required|integer|min:0',
            'minimum_stock'    => 'required|integer|min:0',
            'location'         => 'required|max:255',
            'item_condition'   => 'required',
            'purchase_date'    => 'nullable|date',
            'purchase_price'   => 'nullable|numeric',
            'status'           => 'required',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

       if ($request->hasFile('image')) {

    $file = $request->file('image');

    $filename = time().'_'.$file->getClientOriginalName();

    $file->move(
        public_path('images/products'),
        $filename
    );

    $data['image'] = 'products/'.$filename;
}

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'product_code'     => 'required|unique:products,product_code,' . $product->id,
            'product_name'     => 'required|max:255',
            'description'      => 'nullable',
            'stock'            => 'required|integer|min:0',
            'minimum_stock'    => 'required|integer|min:0',
            'location'         => 'required|max:255',
            'item_condition'   => 'required',
            'purchase_date'    => 'nullable|date',
            'purchase_price'   => 'nullable|numeric',
            'status'           => 'required',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {

    if (
        $product->image &&
        file_exists(public_path('images/'.$product->image))
    ) {
        unlink(public_path('images/'.$product->image));
    }

    $file = $request->file('image');

    $filename = time().'_'.$file->getClientOriginalName();

    $file->move(
        public_path('images/products'),
        $filename
    );

    $data['image'] = 'products/'.$filename;
}

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            if (
    $product->image &&
    file_exists(public_path('images/'.$product->image))
) {
    unlink(public_path('images/'.$product->image));
}
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}