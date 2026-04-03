<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function index(Request $request)
{
    // $search = $request->input('search');
    
    // $query = DB::table('products')
    //     ->join('categories', 'products.category_id', '=', 'categories.id')
    //     ->select('products.*', 'categories.name as category_name') // Lấy tên category
    //     ->orderBy('products.id', 'desc');

    // if ($search) {
    //     $query->where('products.name', 'like', '%' . $search . '%');
    // }

    // $products = $query->paginate(5)->appends(['search' => $search]);
    
    // return view('products.index', compact('products'));
    $query = Product::with('category');
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search.'%');
    }
    $products = $query->orderBy('id', 'desc')->paginate(5);
    return view('admin.products.index', compact('products'));
    }

    function create()
    {
        $categories = DB::table('categories')->where('status', 1)->get();
        return view('admin.products.create', compact('categories'));
    }
    function store(ProductRequest $request)
    {
        // DB::table('products')->insert([
        //     'name' => $request->name,
        //     'price' => $request->price,
        //     'quantity' => $request->quantity,
        //     'image' => $imagePath,
        //     'category_id' => $request->category_id,
        //     'status' => (bool) $request->status,
        // ]);

        // return redirect()->route('products.index')->with('success', 'Thêm mới sản phẩm thành công.');
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Thêm mới sản phẩm thành công.');
    }

    function edit(Category $category, Product $product)
    {
        // $product = DB::table('products')->where('id', $id)->first();
        // $categories = DB::table('categories')->where('status', 1)->get();
        // return view('products.edit', compact('product', 'categories'));
        $categories = Category::where('status', 1)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }
    function update(ProductRequest $request, Product $product)
    {
        // $product = DB::table('products')->where('id', $id)->first();
        // $imagePath = $product->image;
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('products', 'public');
        // }

        // DB::table('products')->where('id', $id)->update([
        //     'name' => $request->name,
        //     'price' => $request->price,
        //     'quantity' => $request->quantity,
        //     'image' => $imagePath,
        //     'category_id' => $request->category_id,
        //     'status' => (bool) $request->status,
        // ]);

        // return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công.');
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    function destroy(Product $product)
    {
        // DB::table('products')->where('id', $id)->delete();
        // return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công.');
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công.');
    }
}