<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        $users = User::all();
        $products = Product::all();

        $reviewsCount = Review::count();
        return view('admin.reviews.index', [
            'page_title' => ' التقييمات',
            'reviews' => $reviews,
            'users' => $users,
            'products' => $products,
            'reviewsCount' => $reviewsCount,
        ]);
    }

    public function create()
    {
        return view('admin.reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'rating' => 'required|numeric|min:0|max:5',
            'product_id' => 'required|exists:products,id',
        ]);

        $review = new Review([
            'comment' => $request->comment,
            'rating' => $request->rating,
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
        ]);

        $review->save();

        return redirect()->route('dashboard.reviews.index')->with('success', 'تم إضافة التقييم بنجاح.');
    }

    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'comment' => 'required',
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        $review->update([
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->route('dashboard.reviews.index')->with('success', 'تم تحديث التقييم بنجاح.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('dashboard.reviews.index')->with('success', 'تم حذف التقييم بنجاح.');
    }
}
