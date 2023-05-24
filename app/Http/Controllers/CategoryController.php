<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $categoriesCount = Category::count();

        return view('admin.categories.index',[
            'page_title' => ' الاصناف',
            'categories' => $categories,
            'categoriesCount' => $categoriesCount,
        ]);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function showProducts($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products;
        $user = Auth::user(); 


        return view('categories.products', compact('category', 'products' , 'user'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Category $category)
    // {
    //     $request->validate([
    //         'name' => 'required|max:255',
    //     ]);

    //     $category->name = $request->name;
    //     $category->save();

    //     return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully!');
    // }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Category $category)
    // {
    //     $category->delete();

    //     return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully!');
    // }
}
