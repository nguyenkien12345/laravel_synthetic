<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Full Calendar js</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
</head>

<body>
    <!-- Modal -->
    <div class="modal fade border-0" id="bookingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-4 bg-info rounded-top-3">
                    <h5 class="modal-title text-capitalize text-success font-weight-bolder text-decoration-underline">
                        booking title
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4 bg-light">
                   <form id="bookingForm">
                        <div class="form-group my-3">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title: ">
                            <span id="titleError" class="text-danger mt-1 d-none"></span>
                        </div>
                        <div class="form-group my-3">
                            <select name="priority" id="priority" class="form-control">
                                <option value="" selected disabled>Please Choose Priority</option>
                                @forelse ($priorities as $key => $value)
                                    <option value="{{$value}}">{{$key}}</option>
                                @empty
                                    <option value="">Priority is empty</option>
                                @endforelse
                            </select>
                            <span id="priorityError" class="text-danger mt-1 d-none"></span>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="notes" id="notes" placeholder="Enter Notes: "></textarea>
                        </div>
                   </form>
                </div>

                <div class="modal-footer p-4 bg-secondary rounded-bottom-3">
                    <button type="button" class="btn btn-secondary" id="btnClose" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"   id="btnSave">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center text-success font-weight-bold mt-5">Project FullCalendar Of Nguyễn Trung Kiên</h3>
                <div id="calendar" class="my-5"></div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // convert object form php to js
            const bookings = @json($bookings);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next, today',              // Các nút điều hướng "prev" (tháng trước), "next" (tháng sau) và "today" (hôm nay).
                    center: 'title',                        // Hiển thị tháng và năm hiện tại
                    right: 'month, agendaWeek, agendaDay'   // Các nút để chọn chế độ xem "month" (chế độ tháng), "agendaWeek" (chế độ tuần), và "agendaDay" (chế độ ngày).
                },
                weekends: true,                             // Có hiển thị thứ 7 và chủ nhật không
                weekNumbers: true,                          // Hiển thị tuần thứ bao nhiêu trong tháng
                events: bookings,                           // Hiển thị các bookings lên trên calendars,
                selectable: true,                           // Cho phép người dùng chọn các sự kiện trên lịch
                selectHelper: true,                         // Hiển thị 1 trình trợ giúp chọn sự kiện
                defaultView: 'month',                       // View mặc định hiển thị đang là month. Mỗi lần hiển thị là nó sẽ load view này lên
                editable: true,
                eventLimit : true,                          // Tự động thu gọn sự kiện khi quá nhiều và cho thêm nút load more
                eventRender: function(event, element, view) {
                    // Tùy chỉnh các phần tử HTML của sự kiện trước khi hiển thị
                    // Ta sẽ gắn thêm 2 thuộc tính data-toggle và title cho các thẻ title của event
                    element.find('span.fc-title').attr('data-toggle', 'tooltip');
                    element.find('span.fc-title').attr('title', event.title);
                    element.find('.fc-content').prepend(
                        '<img src="' + event.image + '" width="30px" height="60px" style="display: block; width:100%; object-fit: cover" class="event-image"/>'
                    );
                },
                select: function(start, end, allDays) {
                    // start: Ngày tháng và giờ bắt đầu của khoảng thời gian đã chọn.
                    // end: Ngày tháng và giờ kết thúc của khoảng thời gian đã chọn.
                    // allDays: Một giá trị boolean cho biết liệu khoảng thời gian đã chọn có bao gồm cả ngày cuối tuần hay không
                    $('#bookingModal').modal('toggle');
                    $('#btnSave').click(function(e){
                        e.preventDefault();
                        const title = $('#title').val();
                        const notes = $('#notes').val();
                        const priority = $('#priority').val();
                        const startDate = moment(start).format('YYYY-MM-DD');
                        const endDate = moment(end).format('YYYY-MM-DD');
                        $.ajax({
                            url: "{{ route('google-calendar.add-booking') }}",
                            type: "POST",
                            dataType: "json",
                            data: {
                                title: title,
                                notes: notes,
                                priority: priority,
                                start_date: startDate,
                                end_date: endDate
                            },
                            success: function(response) {
                                console.log(response);
                                $('#titleError').removeClass('d-block').addClass('d-none');
                                $('#titleError').html('');
                                $('#priorityError').removeClass('d-block').addClass('d-none');
                                $('#priorityError').html('');

                                $('#bookingModal').modal('hide');

                                $('#bookingForm')[0].reset();

                                const commonOptions = {
                                    showCloseButton: false,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                }

                                if(response.status){
                                    Swal.fire({
                                        title: 'Notification',
                                        text: "Add Booking Success",
                                        icon: 'success',
                                        ...commonOptions
                                    });

                                    // Mỗi lần thêm thành công sẽ chỉ render lại đúng phần tử vừa được thêm chứ không render lại toàn bộ calendar
                                    $('#calendar').fullCalendar('renderEvent', {
                                        'id': response.data.id,
                                        'title': response.data.title,
                                        'start': response.data.start,
                                        'end': response.data.end,
                                        'color': response.data.color,
                                    });
                                }
                                else{
                                    Swal.fire({
                                        title: 'Notification',
                                        text: "Add Booking Fail",
                                        icon: 'error',
                                        ...commonOptions
                                    });
                                }
                            },
                            error: function(error) {
                                const errors = error.responseJSON.errors;

                                if(errors.title && errors.title[0]){
                                    $('#titleError').removeClass('d-none').addClass('d-block');
                                    $('#titleError').html(errors.title[0]);
                                }

                                if(errors.priority && errors.priority[0]){
                                    $('#priorityError').removeClass('d-none').addClass('d-block');
                                    $('#priorityError').html(errors.priority[0]);
                                }
                            }
                        });
                    });
                },
                eventClick: function(event){                // Khi ta click vào 1 sự kiện nó sẽ trả các thông tin liên quan của sự kiện đó (Click vào sự kiện chứ không phải click vào ngày)
                    const id = event.id;
                    const title = event.title;
                    Swal.fire({
                        title: 'Confirmation',
                        text: `Are you sure to delete event ${title}`,
                        icon: 'warning',
                        showCloseButton: true,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        // reverseButtons: true,
                        focusConfirm: false,
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                // Tham số thứ 2 của route thường là 1 mảng các tham số sẽ được truyền đến tuyến đường
                                // '': Trong trường hợp này, '' như tham số thứ hai của route() không cần thiết định nghĩa thêm bất kỳ tham số nào.
                                url: '{{ route("google-calendar.delete-booking", '') }}' + '/' + id,
                                type: 'DELETE',
                                success: function(response) {
                                    const commonOptions = {
                                        showCloseButton: false,
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }

                                    if(response.status && response.data.data){
                                        Swal.fire({
                                            title: 'Notification',
                                            text: "Delete Booking Success",
                                            icon: 'success',
                                            ...commonOptions
                                        });

                                        // Khi phương thức 'removeEvents' được gọi, sự kiện có id tương ứng sẽ được xóa khỏi lịch, và lịch sẽ được cập nhật để không hiển thị sự kiện đó nữa.
                                        $('#calendar').fullCalendar('removeEvents', response.data.id);
                                    }
                                    else{
                                        Swal.fire({
                                            title: 'Notification',
                                            text: "Delete Booking Fail",
                                            icon: 'error',
                                            ...commonOptions
                                        });
                                    }
                                },
                                error: function(error) {
                                    const errors = error.responseJSON;
                                }
                            });
                        }
                    })
                },
                selectAllow: function(event){
                    // Disabled Multiple days event
                    // Setup cho phép người dùng có thể chọn khoảng thời gian như thế nào trên lịch
                    // event: Tham số này chứa các thông tin về thời gian bắt đầu (start) và thời gian kết thúc (end) của khoảng thời gian đã chọn.
                    // utcOffset(false): loại bỏ đối tượng múi giờ của Moment.js.
                    // Kiểm tra xem thời gian bắt đầu và kết thúc có cùng ngày (giữa start và end) hay không.
                    // Chúng ta đảm bảo rằng khoảng thời gian không trôi qua sang ngày kế tiếp. Sau đó, sử dụng isSame(..., 'day')
                    // để so sánh xem start và end có cùng một ngày không.
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
                }
            });

            $('#bookingModal').on('hidden.bs.modal', function(){
                $('#btnSave').unbind();
            });

            // Áp dụng cho các event
            $('.fc-event').css({
                'font-size': '15px',
                'font-weight': '600',
                'letter-spacing': '0.3',
                'cursor': 'pointer',
                'outline': 'none',
                'border-radius': 'none',
                'padding': '2px',
                'word-break': 'break-word',
                'height': '100px'
            });

            // Áp dụng cho toàn bộ giao diện calendar
            // $('.fc').css({
            //     'background-color': '#ccc',
            //     'opacity': '0.8'
            // });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>
