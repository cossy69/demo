@extends('layouts.app')

@section('content')
<div class="container">
    <div class="fs-2 mb-3">Chỉnh sửa bài viết</div>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Tiêu đề bài viết</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nội dung bài viết</label>
            <textarea name="content" class="form-control" rows="5"
                required>{{ old('content', $post->content) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Hình ảnh hiện tại</label>
            @if($post->image)
            <div><img
                    src="{{ str_starts_with($post->image, 'http') ? $post->image : asset('storage/' . ltrim($post->image, '/')) }}"
                    alt="" width="100"></div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Tải lên ảnh mới (nếu muốn)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-select" required>
                <option value="">Chọn danh mục</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select">
                <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection