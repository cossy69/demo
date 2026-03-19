@extends('layouts.app')

@section('content')
<div class="container">
    <div class="fs-2 mb-3">Chỉnh sửa sản phẩm</div>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Số lượng</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}"
                required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hình ảnh hiện tại</label>
            @if($product->image)
                <div><img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . ltrim($product->image, '/')) }}" alt="" width="100"></div>
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
                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select">
                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection