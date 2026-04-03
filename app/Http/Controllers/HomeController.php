<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $categoriesQuery = Category::query();
        $productsQuery = Product::with('category');

        if (!empty($keyword)) {
            $categoriesQuery->where('name', 'like', '%' . $keyword . '%');
            $productsQuery->where('name', 'like', '%' . $keyword . '%');
        }

        $categories = $categoriesQuery->get();
        $products = $productsQuery->get();

        return view('client.home', compact('categories', 'products', 'keyword'));
    }

    public function showProduct($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('client.product_detail', compact('product'));
    }
}
