<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
    public function resizeImage(){
        return view('management-image.index');
    }

    public function resizeImageSubmit(Request $request){
        $image = $request->image;
        if($image) {
            $nameOfImage = $image->getClientOriginalName();
            $sizeOfImage = $image->getSize();
            $typeOfImage = $image->getClientOriginalExtension();
            $pathOfImage = $image->getRealPath();

            $newNameOfFile = time() . $nameOfImage;

            $image_resize = Image::make($pathOfImage);
            $image_resize->resize(500,500);
            $image_resize->save(public_path('images/' . $newNameOfFile));
            return "Resize Your Image Success";
        }
        else {
            return "Please Upload Your Image !";
        }
    }

    public function dropzoneImage(){
        return view('management-image.dropzone');
    }

    public function dropzoneImageSubmit(Request $request){
        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        return "Upload Your Image Success";
    }

    public function lazyLoadImage(){
        return view('management-image.lazy-load-image');
    }
}

// Phân biệt image->save và image->move
// + image->save: Trong ngữ cảnh này, image->save có thể tham chiếu đến việc lưu dữ liệu ảnh đã được xử lý vào một
// vị trí cụ thể trên hệ thống tập tin hoặc lưu trữ đám mây của máy chủ. Trong Laravel, khi bạn xử lý một bức ảnh
// bằng các thư viện như Intervention Image, bạn có thể áp dụng các biến đổi khác nhau (ví dụ: thay đổi kích thước, cắt,
// đóng dấu) cho bức ảnh và sau đó sử dụng phương thức save để lưu bức ảnh đã được xử lý vào một tập tin.

// + image->move: Trong ngữ cảnh này, image->move có thể tham chiếu đến việc di chuyển một tập tin ảnh đã được tải lên
// từ thư mục tạm thời (ví dụ: một vị trí tạm thời mà tập tin được lưu trữ trong quá trình tải lên) đến một vị trí cố định
// khác trên hệ thống tập tin để lưu trữ tập tin ảnh đã tải lên.

// + image->save thường áp dụng cho việc lưu trữ một bức ảnh đã được xử lý vào một vị trí cụ thể sau khi áp dụng một số thao tác
// xử lý ảnh.
// + image->move thường áp dụng cho việc di chuyển một tập tin ảnh đã được tải lên từ thư mục tạm thời sang một vị trí cố định
// để lưu trữ tập tin ảnh đã tải lên.
