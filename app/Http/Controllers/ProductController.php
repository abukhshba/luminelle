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
    

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'images.*' => 'nullable|image',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
        ]);
    
        $product = Product::findOrFail($id);
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->category_id = $request->category_id;
        $product->save();
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('public/images/products');
                $imagePath = str_replace('public/', '', $imagePath);
    
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $imagePath;
                $productImage->save();


            }
        }
    
        return redirect()->route('dashboard.products.index');
    }
    

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('dashboard.products.index');
    }
}
