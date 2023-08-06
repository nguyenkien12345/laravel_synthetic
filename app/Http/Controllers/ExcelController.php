<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function exportData(Request $request)
    {
        // Excel::download: Nó sẽ tải về máy tính của chúng ta (Mặc định nếu không truyền vào tham số thứ 3 trong hàm download thì sẽ luôn luôn là download file excel)

        // Download file xlsx
        // return Excel::download(new UsersExport(), 'users.xlsx');
        // Download file csv
        // return Excel::download(new UsersExport(), 'users.csv', \Maatwebsite\Excel\Excel::CSV);
        // Download file html
        // return Excel::download(new UsersExport(), 'users.html', \Maatwebsite\Excel\Excel::HTML);

        // Việc viết Excel::download(new UsersExport(), 'users.xlsx'), Excel::download(new UsersExport(), 'users.csv', \Maatwebsite\Excel\Excel::CSV),
        // Excel::download(new UsersExport(), 'users.html', \Maatwebsite\Excel\Excel::HTML); là quá dài dòng nên trong UsersExport ta chỉ cần khai báo thêm
        // use Exportable; thì có thể viết ngắn gọn như sau:

        // Download file xlsx
        // return (new UsersExport)->download('users.xlsx');
        // Download file csv
        // return (new UsersExport)->download('users.csv',  \Maatwebsite\Excel\Excel::CSV);
        // Download file html
        // return (new UsersExport)->download('users.html',  \Maatwebsite\Excel\Excel::HTML);

        // Bên UsersExport đã khai báo $fileName nên ta không cần đặt tên file lại
        // return (new UsersExport)->download();

        // Nếu bên UsersExport sử dụng hàng đợi ShouldQueue
        // File sẽ được lưu trong storage/app
        // (new UsersExport($request->query('name')))->queue('queue-users.xlsx');
        // return [
        //     'status' => true,
        //     'message' => 'OK'
        // ];

        // Excel::store: Nó sẽ chỉ lưu trữ trong folder storage/app/public/excel trong dự án của chúng ta
        // return Excel::store(new UsersExport(), 'public/excel/customer.xlsx');


        // Nhận vào tham số người dùng truyền vào
        return (new UsersExport($request->query('name')))->download();
    }

    public function importData()
    {
    }
}
