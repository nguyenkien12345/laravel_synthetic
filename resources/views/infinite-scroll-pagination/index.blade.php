<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Infinite Scroll Pagination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card my-5">
            <div class="card-header bg-dark p-2">
                <h1 class="text-center text-white text-capitalize font-weight-bold">laravel infinite scroll</h1>
            </div>

            <div class="card-body bg-secondary p-5">
                <div id="blogs-wrapper">
                @if($blogs->isNotEmpty())
                @include('infinite-scroll-pagination.blog-row', compact('blogs'))
                @endif
                {{-- Áp dụng cho cách 2 (sử dụng kết hợp với pagination truyền thống) --}}
                {{ $blogs->links() }}
            </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js" integrity="sha512-51l8tSwY8XyM6zkByW3A0E36xeiwDpSQnvDfjBAzJAO9+O1RrEcOFYAs3yIF3EDRS/QWPqMzrl6t7ZKEJgkCgw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Infinite --}}
    <script>
        $(function(){
            // CÁCH 1
            // Vì mặc định ban đầu load lên nó luôn nằm ở trang 1 òi nên ở đây ta sẽ phải bắt đầu từ trang 2
            // let page = 2;
            // const lastPage = {{$blogs->lastPage()}};

            // Lý thuyết
            // $(window).scrollTop(): Phương thức này trả về vị trí dọc hiện tại của cửa sổ trình duyệt từ đỉnh trang
            // (trên cùng) đến vị trí cuộn hiện tại.
            // $(window).height(): Phương thức này trả về chiều cao hiển thị của cửa sổ trình duyệt.
            // $(document).height(): Phương thức này trả về chiều cao của toàn bộ tài liệu (document),
            // bao gồm cả khu vực cuộn (scrollable area) và khu vực không cuộn (non-scrollable area).

            // $(window).scroll(function(){
            //     // Kiểm tra xem người dùng đã cuộn trang đến cuối cùng của trang hay chưa.
            //     if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            //         if(lastPage >= page) {
            //             loadMoreData(page);
            //             page++;
            //         }
            //     }
            // });

            // function loadMoreData(page){
            //     $.ajax({
            //         url: '{{ route("infinite-scroll-pagination.get-more-blog") }}',
            //         data: {
            //             page: page
            //         },
            //         method: 'GET',
            //         dataType: 'json',
            //         success: function(data) {
            //             if(data.status) {
            //                 $('#blogs-wrapper').append(data.html)
            //             }
            //         },
            //         error: function(error) {
            //             console.log('error: ', error);
            //         }
            //     })
            // }

            // -----------------------------------------------------------------------------------------------

            // CÁCH 2 ((sử dụng kết hợp với pagination truyền thống))
            $('ul.pagination').hide();

            $('#blogs-wrapper').jscroll({
                // Tự động kích hoạt phân trang khi người dùng cuộn trang
                autoTrigger: true,
                // Trong quá trình loading hiển thị spinner
                loadingHtml: `<div class="d-flex justify-content-center pb-5">
                    <div class="spinner-border " role="status" id="loader"><span class="visually-hidden">Loading...</span></div>
                </div>`,
                // Khoảng cách từ cuối trang đến khi plugin bắt đầu tải thêm dữ liệu mới.
                padding: 0,
                // Nó giống như là click đến trang tiếp theo
                nextSelector: '.pagination li.active + li a',
                // Phần tử chứa nôi dung sau khi inifinite scroll
                contentSelector: 'div#blogs-wrapper',
                callback: function() {
                    // Đoạn mã trong hàm callback này sẽ chỉ được gọi khi dữ liệu mới đã được tải thành công
                    $('ul.pagination').remove();
                }
            });
            // -----------------------------------------------------------------------------------------------
        });
    </script>
</body>

</html>
