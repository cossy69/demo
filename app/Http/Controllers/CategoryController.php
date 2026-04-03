<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        //Query builder
        // $query = DB::table('categories')->orderBy('id', 'desc');
        // $categories = $query->paginate(5);
        // $search = $request->input('search');
        // $query = DB::table('categories')->orderBy('id', 'desc');

        // if ($search) {
        //     $query->where('name', 'like', '%' . $search . '%');
        // }

        // $categories = $query->paginate(5)->appends(['search' => $search]);
        // return view('categories.index', compact('categories'));

        //Eloquent
        $query = Category::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search.'%');
        }
        $categories = $query->orderBy('id', 'desc')->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        //Query builder
        $categories = DB::table('categories')->get();
        return view('admin.categories.create', compact('categories'));
    }
    public function store(CategoryRequest $request)
    {
        // DB::table('categories')->insert([
        //     'name' => $request->name,
        //     'status' => (bool) $request->status,
        // ]);

        // return redirect()->route('categories.index')->with('success', 'Thêm mới danh mục thành công.');
        //Eloquent
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('success', 'Thêm mới danh mục thành công.');
    }

    public function edit(Category $category)
    {
        // $category = DB::table('categories')->where('id', $id)->first();
        // return view('categories.edit', compact('category'));
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        // DB::table('categories')->where('id', $id)->update([
        //     'name' => $request->name,
        //     'status' => (bool) $request->status,
        // ]);

        // return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công.');
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }
    public function destroy(CategoryRequest $category)
{
    // Kiểm tra xem có sản phẩm hoặc bài viết nào thuộc danh mục này không
    // $hasProducts = DB::table('products')->where('category_id', $id)->exists();
    // $hasPosts = DB::table('posts')->where('category_id', $id)->exists();

    // if ($hasProducts || $hasPosts) {
    //     return redirect()->back()->with('error', 'Không thể xóa! Danh mục này vẫn còn sản phẩm hoặc bài viết.');
    // }

    // DB::table('categories')->where('id', $id)->delete();
    // return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công.');
    $category->delete();
    return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công.');
}
}