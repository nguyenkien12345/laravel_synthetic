<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart Of Nguyễn Trung Kiên</title>

    <!-- Css -->
    @include('cart.styles')
    @stack('styles')
</head>

<body>
    <!-- Page Preloder -->
    @include('cart.preloader')

    <!-- Header Section Begin -->
    @include('cart.header')
    <!-- Header End -->

    @yield('content')

    <!-- Footer Section Begin -->
    @include('cart.footer')
    <!-- Footer Section End -->

    <!-- Js -->
    @include('cart.scripts')
    @stack('scripts')
</body>

</html>
