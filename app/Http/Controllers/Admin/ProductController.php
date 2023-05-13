<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

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
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
        ]);

        $imagePath = $request->file('image')->store('public/images/products');
        $imagePath = str_replace('public/', '', $imagePath);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->image = $imagePath;
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->category_id = $request->category_id;
        $product->save();

        return redirect()->route('dashboard.products.index');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
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

        return redirect()->route('dashboard.products.show', $id);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('dashboard.products.index');
    }
}
