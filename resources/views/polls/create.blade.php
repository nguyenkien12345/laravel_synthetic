@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="center">New Poll</h2>

        {{-- small, medium và extra-large --}}
        <form class="col s12 m12 xl12" method="post" action="{{route('poll.store')}}">
            @csrf

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row">

                <div class="input-field col s12 m12 xl12">
                    <input required="required" name="title" id="title" type="text" class="validate">
                    <label for="title">Title</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input required="required" name="start_date" id="startDate" type="text" class="datepicker">
                    <label for="startDate">Start date</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input required="required" name="start_time" id="startTime" type="text" class="timepicker">
                    <label for="startTime">Start time</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input required="required" name="end_date" id="endDate" type="text" class="datepicker">
                    <label for="endDate">End date</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input required="required" name="end_time" id="endTime" type="text" class="timepicker">
                    <label for="endTime">End time</label>
                </div>

                @php $answer=[1,2,3,4]; @endphp

                {{--
                thêm/xóa các tùy chọn cho một cuộc thăm dò, sử dụng Alpine.js để quản lý số lượng tùy chọn và ràng
                buộc dữ liệu vào các input tương
                --}}
                {{-- Thuộc tính x-data được sử dụng để khai báo một biến optionsNumber trong môi trường Alpine.js với
                giá trị ban đầu là 2. Biến này sẽ được sử dụng để theo dõi số lượng tùy chọn hiện tại trong form. --}}
                <div class="row col s12 m12 xl12" x-data="{optionsNumber:2}">
                    <h4>Options</h4>

                    {{--
                    Đây là một khối mẫu Alpine.js cho phép lặp lại một đoạn mã HTML bên trong nó dựa trên số lượng
                    tùy chọn (optionsNumber). Biến i và index được sử dụng để lặp qua từng tùy chọn và chỉ số của nó.
                    --}}
                    <template x-for="i,index in optionsNumber">
                        <div class="row">
                            <div class="col s12 m12 xl12">
                                <input required="required" name="options[][content]" id="content" type="text"
                                    class="validate" :placeholder="`Option` + i">
                            </div>
                            <div class="col s12 m12 xl12">
                                {{--
                                Sự kiện x-on:click được sử dụng để xử lý việc giảm giá trị của optionsNumber khi
                                người dùng nhấp vào nút xóa
                                --}}
                                <button
                                    x-on:click="optionsNumber > 2 ? optionsNumber-- : alert('poll must has at least 2 options')"
                                    class="waves-effect waves-light btn red darken-4" type="button">
                                    REMOVE
                                </button>
                            </div>
                        </div>
                    </template>

                    {{--
                    Sự kiện x-on:click được sử dụng để tăng giá trị của optionsNumber khi người dùng nhấp vào nút
                    này.
                    --}}
                    <button x-on:click="optionsNumber++" class="waves-effect waves-light btn info darken-2 center"
                        type="button">Add option
                    </button>

                    <hr>

                    <button class="waves-effect waves-light btn cyan darken-2 center" type="submit">Create</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dates = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(dates);
        var tiems = document.querySelectorAll('.timepicker');
        var instances = M.Timepicker.init(tiems);
      });
</script>
@endsection
