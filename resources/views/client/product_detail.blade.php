<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Chi tiết sản phẩm</title>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Chi tiết sản phẩm</h1>
            <div>
                <a href="{{ route('home') }}" class="btn btn-secondary btn-sm me-2">Quay lại</a>
                @if (Auth::check())
                    <span class="me-3">Xin chào, {{ Auth::user()->name ?? 'Người dùng' }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Đăng xuất</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded-start" alt="{{ $product->name }}" style="width: 100%; object-fit: cover;">
                    @else
                        <div class="img-fluid rounded-start d-flex align-items-center justify-content-center bg-light" style="height: 300px;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title">{{ $product->name }}</h2>
                        <h4 class="card-text text-danger">{{ number_format($product->price) }} VNĐ</h4>
                        <p class="card-text"><strong>Danh mục:</strong> {{ $product->category->name ?? 'Không có' }}</p>
                        <p class="card-text"><strong>Số lượng:</strong> {{ $product->quantity }}</p>
                        <p class="card-text"><strong>Trạng thái:</strong> {{ $product->status ? 'Đang bán' : 'Ngừng bán' }}</p>
                        <button class="btn btn-primary mt-3">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmxc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
