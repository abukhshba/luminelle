<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

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

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'images.*' => 'required|image',
            'description' => 'required',
            'price' => 'required|numeric',
            'deposit' => 'numeric',
            'category_id' => 'required',
        ]);


        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->deposit = $validatedData['deposit'];
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

                $productImages = $product->product_images;
            }
        }

    return redirect()->route('dashboard.products.index');
}


    public function show($id)
    {
        $product = Product::findOrFail($id);
        $images = $product->images;
        return view('admin.products.show', compact('product' , 'images'));
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
            'deposit' => 'required|numeric',
            'price' => 'required|numeric',
            'category_id' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->deposit = $validatedData['deposit'];
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

                $productImages = $product->product_images;

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
