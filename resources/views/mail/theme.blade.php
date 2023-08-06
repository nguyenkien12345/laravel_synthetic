<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="antialiased">

        <div class="col-6 offset-3 mt-5">
            <h3>Theme Activation</h3>

            @include('mail.notification')

            <div class="row">
                <form method="POST" action="{{ route('mail.active-theme') }}">
                    @csrf
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                            <option disabled selected>Select Status</option>
                            @foreach ($status as $key => $value)
                            <option value="{{$value}}">{{ucfirst($key)}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Theme</label>
                        <select name="theme" class="form-control">
                            <option disabled selected>Select Theme</option>
                            @foreach ($themes as $key => $value)
                            <option value="{{$value}}">{{ucfirst(str_ireplace('_', ' ', $key))}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</body>

</html>
