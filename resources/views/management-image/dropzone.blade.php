<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DROPZONE IMAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"  rel="stylesheet" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header p-3 bg-primary">
                        <h3>Dropzone Image</h3>
                    </div>

                    <div class="card-body p-3">
                        <form action="{{route('image.handle-dropzone-image')}}" class="dropzone dz-clickable" method="POST" enctype="multipart/form-data" id="formDropzone">
                            @csrf
                            {{--
                            <div>
                                <h3 class="text-center text-uppercase text-success font-weight-bolder">Upload Image By Click On Box</h3>
                            </div>
                            <div class="dz-default dz-message">
                                <span>Drop Files Here To Upload</span>
                            </div>
                            --}}
                        </form>
                    </div>

                    <div class="card-footer p-3 bg-success">
                        <h3>Designed By Nguyen Trung Kien</h3>
                    </div>
                </div>

                <div class="card preview-image">
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // formDropzone ở đây chính là id của cái form
        Dropzone.options.formDropzone = {
            maxFilesize: 10,
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            autoProcessQueue: true,
            dictRemoveFile: 'Xóa ảnh',
            dictDefaultMessage: 'Vui lòng chọn ảnh',
            paramName: 'file',
            // previewsContainer: '.preview-image',
            timeout: 1000,
            success: function(file, data) {
                console.log('success', data);
            },
            error: function(file, error) {
                console.log('error', error);
            },
            complete: function(file) {
                console.log('complete', file);
            }
        }
    </script>
</body>

</html>
