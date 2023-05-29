<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $productsCount = Product::count();
        $categories = Category::all();


        return view('admin.products.index', [
            'page_title' => ' المنتجات',
            'products' => $products,
            'categories' => $categories,
            'productsCount' => $productsCount,
        ]);
    }




    public function show($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user(); 
         $categoryID = $product->category->id;
         $categoryName = $product->category->name;
         $averageRating = Review::where('product_id', $id)->avg('rating');
         $averageRating = number_format($averageRating, 2);

        return view('products.show', compact('product','categoryID','averageRating','categoryName', 'user'));
    }
    


    public function storeReview(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);
        $userId = Auth::id();
        $productId = $request->input('product_id');
        // Create a new review instance
        $review = new Review();
        $review->rating = $validatedData['rating'];
        $review->comment = $validatedData['comment'];
        $review->user_id = $userId;
        $review->product_id = $productId;
        // Save the review
        $review->save();
    
        // Redirect or perform additional actions as needed
        return redirect()->back()->with('success', 'Review stored successfully.');
    }
    
    

}
