<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AUTOCOMPLETE SEARCH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" rel="stylesheet"  integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header p-3 bg-primary">
                        <h3>AutoComplete Search</h3>
                    </div>

                    <div class="card-body p-5">
                        <div class="form-group">
                            <input type="text" class="form-control typeahead" placeholder="Search...">
                        </div>
                    </div>

                    <div class="card-footer p-3 bg-success">
                        <h3>Designed By Nguyen Trung Kien</h3>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            const path = "{{route('auto-complete-search.list-team')}}";
            $('input.typeahead').autocomplete({
                source: function(request, response){
                    return $.ajax({
                        url: path,
                        data: {
                            search: $('.typeahead').val().trim()
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            const result = data.map((item) => item.name);
                            response(result);
                        },
                        error: function (error) {
                            console.log('error: ', error);
                        }
                    })
                },
                minLength: 1,
                delay: 500,
                autoFocus: true,
                select: function(event, ui) {
                    console.log("Selected: " + ui.item.value);
                },
                focus: function(event, ui) {
                    console.log("Focused: " + ui.item.value);
                },
            }).data("ui-autocomplete")._renderItem = function(ul, item) {
                let txt = String(item.value).replace(new RegExp(this.term, "gi"),"<b style='color: red;'>$&</b>");
                return $("<li></li>")                                               // Tạo 1 thẻ li mới
                    .data("ui-autocomplete-item", item)                             // Thêm thuộc tính data-ui-autocomplete-item cho thẻ li
                    .append("<span style='display: block'>" + txt + "</span>")      // Thêm nội dung vào thẻ li
                    .appendTo(ul);
            };
        });
    </script>
</body>

</html>
