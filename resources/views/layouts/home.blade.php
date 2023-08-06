<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Dùng thư viện materialize cho css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    {{--
    Alpine.js giúp bạn xây dựng các tính năng tương tác trên phía máy khách một cách dễ dàng và gọn nhẹ mà không
    cần sử dụng một khung (framework) JavaScript lớn và phức tạp.
    Ví dụ, với Alpine.js, bạn có thể thêm xử lý sự kiện như click, hover, focus vào các phần tử HTML, thực hiện hiệu ứng
    hiển thị/ẩn, tương tác với dữ liệu người dùng và nhiều tính năng tương tác khác. Alpine.js sử dụng các thuộc tính
    HTML đặc biệt như x-data, x-bind, x-show, x-on, x-model để định nghĩa và ràng buộc các hành vi tương tác.
    --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Nguyễn Trung Kiên</title>
</head>

<body>
    {{-- Nội dung chính sẽ nằm ở đây --}}
    @yield('content')
    {{-- --}}

</body>

</html>
