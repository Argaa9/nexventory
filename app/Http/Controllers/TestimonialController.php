<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('user')
            ->latest()
            ->get();

        return view(
            'testimonial',
            compact('testimonials')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Testimonial::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'rating' => $request->rating
        ]);

        return back()->with(
            'success',
            'Testimonial berhasil ditambahkan'
        );
    }
}