<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Multi Step Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>
    .form-section {
        display: none;
    }

    .form-section.current{
        display: block;
    }

    .parsley-errors-list {
        font-size: 13px;
        color: red;
        font-weight: bolder;
        padding: 5px;
        list-style-type: none;
    }
</style>

<body>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-6 offset-md-4">

                <div class="card">
                    <div class="card-header text-center text-uppercase text-white font-weight-bold bg-info p-3 rounded">
                        <h5 class="fs-3">multi step form</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{route('multistepform.submitForm')}}" method="POST" class="contact-form" id="contact-form">
                            @csrf
                            <div class="form-section">
                                <div class="form-group mb-1">
                                    <label class="fs-5 font-weight-bolder mb-1" for="firstName">First Name:</label>
                                    <input type="text" name="first_name" class="form-control" id="firstName" required />
                                </div>

                                <div class="form-group mb-1">
                                    <label class="fs-5 font-weight-bolder mb-1" for="lastName">Last Name:</label>
                                    <input type="text" name="last_name" class="form-control" id="lastName" required />
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="form-group mb-1">
                                    <label class="fs-5 font-weight-bolder mb-1" for="email">Email:</label>
                                    <input type="text" name="email" id="email" class="form-control" required />
                                </div>

                                <div class="form-group mb-1">
                                    <label class="fs-5 font-weight-bolder mb-1" for="phone">Phone:</label>
                                    <input type="text" name="phone" id="phone" class="form-control" required />
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="form-group mb-1">
                                    <label class="fs-5 font-weight-bolder mb-1" for="age">Age:</label>
                                    <input type="number" name="age" id="age" class="form-control" required />
                                </div>

                                <div class="form-group mb-1">
                                    <label class="fs-5 font-weight-bolder mb-1" for="gender">Gender:</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>

                                <div class="form-group mb-1">
                                    <label class="fs-5 font-weight-bolder mb-1" for="note">Note:</label>
                                    <textarea name="note" id="note" cols="20" rows="5" class="form-control" required></textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-around align-items-center p-2 form-navigation">
                                <button type="button" id="btnPrevious" class="previous btn btn-outline-info">Previous</button>
                                <button type="button" id="btnNext" class="next btn btn-outline-info">Next</button>
                                <button type="submit" id="btnSubmit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function(){
            const sections = $('.form-section');

            function navigate(index) {
                sections.removeClass('current').eq(index).addClass('current');
                // Nếu mà index lớn hơn 0 thì mới hiển thị nút lùi ngược lại không hiển thị
                $('.form-navigation #btnPrevious').toggle(index > 0);
                // Nếu mà index khác với độ dài của sections thì mới hiển thị nút tiến ngược lại không hiển thị
                const atTheEnd = sections.length - 1;
                $('.form-navigation #btnNext').toggle(index !== atTheEnd);
                // Nút submit chỉ được phép hiển thị ở form cuối cùng ngược lại không hiển thị
                $('.form-navigation #btnSubmit').toggle(index === atTheEnd);
            }

            // Luôn luôn bắt đầu ở vị trí thứ 0
            navigate(0);

            function currentIndex(){
                return sections.index(sections.filter('.current'));
            };

            $('.form-navigation #btnPrevious').click(function(){
                navigate(currentIndex() - 1);
            });

            sections.each(function(index,section){
                // $(section).find(':input'): Tìm tất cả các thẻ input và gắn thuộc tính data-parsley-group
                $(section).find(':input').attr('data-parsley-group', 'block-' + index);
            });

            $('.form-navigation #btnNext').click(function(){
                $('#contact-form').parsley().whenValidate({
                    group: 'block-' + currentIndex()
                }).done(function(){
                    navigate(currentIndex() + 1);
                })
            });
        })
    </script>
</body>

</html>
