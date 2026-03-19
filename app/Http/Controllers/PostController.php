<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = DB::table('posts')->orderBy('id', 'desc');
        $posts = $query->paginate(5);
        $search = request()->input('search');
        $query = DB::table('posts')->orderBy('id', 'desc');
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }
        $posts = $query->paginate(5)->appends(['search' => $search]);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->where('status', 1)->get();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }
        DB::table('posts')->insert([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'status' => (bool) $request->status,
        ]);
        return redirect()->route('posts.index')->with('success', 'Thêm mới bài viết thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostModel $postModel)
    {
        $post = DB::table('posts')->where('id', $postModel->id)->first();
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        $categories = DB::table('categories')->where('status', 1)->get();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }
        DB::table('posts')->where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'status' => (bool) $request->status,
        ]);
        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('posts')->where('id', $id)->delete();
        return redirect()->route('posts.index')->with('success', 'Xóa bài viết thành công.');
    }
}