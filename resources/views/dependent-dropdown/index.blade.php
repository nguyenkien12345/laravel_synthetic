<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dependent Dropdown</title>
</head>

<body>
    <form action="">
        <input type="hidden" name="token" id="token" value="{{$token}}">

        <div class="country" style="margin: 50px 0px; padding: 30px;">
            <select name="country" id="country" style="width: 300px">
                <option value="">SELECT COUNTRY</option>
                @foreach($countries as $country)
                <option value="{{$country['country_name']}}">{{$country['country_name']}}</option>
                @endforeach
            </select>
        </div>

        <div class="state" style="margin: 50px 0px; padding: 30px;">
            <select name="state" id="state" style="width: 300px">
                <option value="">SELECT OPTION</option>
            </select>
        </div>

        <div class="city" style="margin: 50px 0px; padding: 30px;">
            <select name="city" id="city" style="width: 300px">
                <option value="">SELECT OPTION</option>
            </select>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $('#country').change(function(e){
                e.preventDefault();
                let country = $(this).val() ? $(this).val().trim() : '';

                const data = {
                    token: $('#token').val().trim(),
                    country: country
                };

                $.ajax({
                    type: "GET",
                    url: "{{ route('dependent-dropdown.states') }}",
                    data: data,
                    success: function(response) {
                        let html = '<option value="">SELECT OPTION</option>';
                        if(response.length > 0) {
                            for(let i = 0; i < response.length; i++) {
                                html += `<option value="${response[i]['state_name']}">${response[i]['state_name']}</option>`;
                            }
                        }
                        else {
                             $('#city').html(html);
                        }
                        $('#state').html(html);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });

            $('#state').change(function(e){
                e.preventDefault();
                let state = $(this).val() ? $(this).val().trim() : '';

                const data = {
                    token: $('#token').val().trim(),
                    state: state
                };

                $.ajax({
                    type: "GET",
                    url: "{{ route('dependent-dropdown.cities') }}",
                    data: data,
                    success: function(response) {
                        console.log(response);
                        let html = '<option value="">SELECT OPTION</option>';
                        if(response.length > 0) {
                            for(let i = 0; i < response.length; i++) {
                                html += `<option value="${response[i]['city_name']}">${response[i]['city_name']}</option>`;
                            }
                        }
                        $('#city').html(html);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });
        });
    </script>

</body>

</html>
