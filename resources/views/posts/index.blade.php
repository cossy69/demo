@extends('layouts.app')

@section('content')
<div class="container">
    <div class="fs-2 mb-3">Danh sách bài viết</div>
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Thêm mới bài viết</a>
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tiêu đề..."
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            @if(request('search'))
            <a href="{{ route('posts.index') }}" class="btn btn-outline-danger">Hủy</a>
            @endif
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Hình ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>
                    @php
                    $imageSrc = $post->image ? (str_starts_with($post->image, 'http') ? $post->image : asset('storage/'
                    . ltrim($post->image, '/'))) : '';
                    @endphp
                    @if($imageSrc)
                    <img src="{{ $imageSrc }}" alt="" width="50">
                    @endif
                </td>
                <td>{{ $post->status ? 'Hoạt động' : 'Không hoạt động' }}</td>
                <td>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Có chắc chắn muốn xóa không?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
</div>
@endsection