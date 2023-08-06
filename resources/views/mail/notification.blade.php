@if (count($errors))
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif


@if (Session::has('success'))
<div class="alert alert-success">
    <p>{{session('success')}}</p>
</div>
@endif
