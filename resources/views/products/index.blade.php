@extends('layouts.app')

@section('content')
<div class="container">
    <div class="fs-2 mb-3">Danh sách sản phẩm</div>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Thêm mới sản phẩm</a>
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên..."
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            @if(request('search'))
            <a href="{{ route('products.index') }}" class="btn btn-outline-danger">Hủy</a>
            @endif
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Danh mục</th>
                <th>Hình ảnh</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->category_name }}</td>
                <td>
                    @php
                    $imageSrc = $product->image ? (str_starts_with($product->image, 'http') ? $product->image :
                    asset('storage/' . ltrim($product->image, '/'))) : '';
                    @endphp
                    @if($imageSrc)
                    <img src="{{ $imageSrc }}" alt="" width="50">
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->status ? 'Hoạt động' : 'Không hoạt động' }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Cậu có chắc chắn muốn xóa không?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection