@extends('admin.layouts.app')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @section('title', "Danh mục sản phẩm")

    @section('content')
    <h1>Danh mục sản phẩm</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Thêm mới danh mục</a>
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên..."
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            @if(request('search'))
            <a href="{{ route('categories.index') }}" class="btn btn-outline-danger">Hủy</a>
            @endif
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->status ? 'Hoạt động' : 'Đã dừng' }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Bạn có muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
    @endsection
</div>