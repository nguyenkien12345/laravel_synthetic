<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, ShouldQueue, WithStyles, WithProperties
{
    use Exportable;

    // Với ShouldAutoSize nó sẽ lấy độ rộng cột bằng với độ rộng của nội dung

    // Với ShouldQueue là xử lý hàng đợi với dữ liệu cực lớn

    // Nếu chúng ta chỉ có nhu cầu download file excel và không có nhu cầu download file khác và không muốn phải đặt tên trong controller thì
    // ta có thể đặt tên file ngay tại file này. Bên controller không cần đặt lại tên file
    private $fileName = 'users-download.xlsx';
    private $search;

    public function __construct(string $search = null)
    {
        $this->search = $search;
    }

    // Với interface FromCollection
    // public function collection()
    // {
    //     // Xuất toàn bộ dữ liệu bảng User
    //     return User::all();
    // }

    // Với interface FromArray
    // public function array(): array
    // {
    //     // Xuất toàn bộ dữ liệu bảng User
    //     return User::all()->toArray();
    // }

    // Với interface FromQuery
    public function query()
    {
        // Xuất toàn bộ dữ liệu bảng User có phone khác null và có name bằng với name người dùng truyền vào và sắp xếp giảm dần theo id
        // ->where('name', $this->search)
        return User::query()->select('id', 'name', 'email', 'is_admin', 'gender', 'phone')->whereNotNull('phone')->orderBy('id', 'desc');
    }

    // Với interface WithMapping (Nó thường luôn đi kèm với interface FromQuery)
    // Nó sẽ duyệt qua từng row trong excel và đi format lại field trong từng column
    public function map($user): array
    {
        return [
            $user->id,
            strtolower($user->name),
            strtoupper($user->email),
            $user->is_admin == 1 ? 'Admin' : 'User',
            $user->gender == 1 ? 'Nam' : 'Nữ',
            str_replace('0', '+84', $user->phone)
        ];
    }

    // Với interface WithHeadings
    public function headings(): array
    {
        return [
            'Mã',
            'Họ và tên',
            'Email',
            'Chức vụ',
            'Giới tính',
            'Số điện thoại'
        ];
    }

    // format style css
    // + 'font': Định dạng phông chữ cho ô.
    // - 'name': Tên phông chữ (ví dụ: 'Arial', 'Times New Roman').
    // - 'size': Kích thước phông chữ.
    // - 'bold': Chữ đậm (true/false).
    // - 'italic': Chữ nghiêng (true/false).
    // - 'underline': Gạch chân chữ (true/false).
    // - 'strikethrough': Gạch ngang chữ (true/false).
    // - 'color': Màu chữ (ví dụ: 'FFFFFF' cho màu trắng).

    // + 'alignment': Căn chỉnh văn bản trong ô.
    // - 'horizontal': Căn chỉnh ngang ('left', 'center', 'right').
    // - 'vertical': Căn chỉnh dọc ('top', 'middle', 'bottom').
    // - 'wrap': Quấn nội dung trong ô (true/false).

    // + 'fill': Định dạng nền cho ô.
    // - 'fillType': Loại định dạng ('solid', 'linear', 'path').
    // - 'startColor': Màu bắt đầu (ví dụ: 'FFFFFF' cho màu trắng).
    // - 'endColor': Màu kết thúc (ví dụ: '000000' cho màu đen).
    // - 'rotation': Góc quay đối với định dạng tuyến tính.

    // + 'borders': Định dạng viền cho ô.
    // + 'outline': Định dạng viền ngoài cùng của ô.
    // - 'borderStyle': Kiểu viền ('none', 'thin', 'medium', 'thick', 'dashed', 'dotted', 'double').
    // - 'color': Màu viền (ví dụ: ['rgb' => 'FF0000'] cho màu đỏ).

    // + 'allBorders': Định dạng cho tất cả các viền của ô.
    // - 'borderStyle': Kiểu viền ('none', 'thin', 'medium', 'thick', 'dashed', 'dotted', 'double').
    // - 'color': Màu viền (ví dụ: ['rgb' => 'FF0000'] cho màu đỏ).

    // + 'top', 'bottom', 'left', 'right': Định dạng viền cho từng phần tử cụ thể của ô.
    // - 'borderStyle': Kiểu viền ('none', 'thin', 'medium', 'thick', 'dashed', 'dotted', 'double').
    // - 'color': Màu viền (ví dụ: ['rgb' => 'FF0000'] cho màu đỏ).

    // + 'diagonal': Định dạng đường chéo của ô.
    // - 'direction': Hướng của đường chéo ('up', 'down', 'both').
    // - 'borderStyle': Kiểu viền ('none', 'thin', 'medium', 'thick', 'dashed', 'dotted', 'double').
    // - 'color': Màu viền (ví dụ: ['rgb' => 'FF0000'] cho màu đỏ).

    // + 'numberFormat': Định dạng số cho ô.
    // 'formatCode': Mã định dạng số (ví dụ: '0.00', 'yyyy-mm-dd').
    // Với interface WithStyles
    public function styles(Worksheet $sheet)
    {
        return [
            // css cho dòng đầu tiên
            1 => [
                'font' => [
                    'name' => 'Times New Roman',
                    'size' => 16,
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'middle,',
                    'wrap' => true
                ]
            ],
            // css cho ô A1
            'A1' => [
                'borders' => [
                    'outline' => [
                        'borderStyle' => 'thick',
                        'color' => ['rgb' => '0048ba'],
                    ],
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => 'fdf1cb'],
                    'endColor' => ['rgb' => 'f8ccb2'],
                ],
            ],
            // css cho ô B1
            'B1' => [
                'borders' => [
                    'outline' => [
                        'borderStyle' => 'double',
                        'color' => ['rgb' => 'f8ed62'],
                    ],
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => 'FF0000'],
                    'endColor' => ['rgb' => '0000FF'],
                ],
            ],
            // css cho toàn bộ cột B, E, F
            'B' => [
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'middle',
                    'wrap' => true
                ],
            ],
            'E' => [
                'alignment' => [
                    'horizontal' => 'left',
                    'vertical' => 'middle',
                    'wrap' => true
                ],
            ],
            'F' => [
                'alignment' => [
                    'horizontal' => 'right',
                    'vertical' => 'middle',
                    'wrap' => true
                ],
            ],
        ];
    }

    // Với interface WithProperties
    public function properties(): array
    {
        return [
            'title' => 'Users',
            'description' => 'Thông tin chi tiết bảng Users',
            'author' => 'Nguyễn Trung Kiên',
            'subject' => 'Tất tần tật về Users',
            'keywords' => 'users, app_synthetic',
            'company' => 'NTK VS MTTT',
            'category' => 'User',
            'manager' => 'Quản lý Nguyễn Trung Kiên',
            'created' => Carbon::now(),
            'lastModifiedBy' => 'Mai Thị Thanh Thúy',
            'managerEmail' => 'nguyentrungkien@gmail.com',
            'companyWebsite' => 'www.nguyentrungkien.com',
            'companyLogo' => public_path('images/mttt.jpg'),
            'companyAddress' => '998/68/5, Quang Trung, Phường 8, Gò Vấp, Thành phố Hồ Chí Minh',
            'companyCity' => 'Ho Chi Minh',
            'companyState' => 'Go Vap',
            'companyZipCode' => '700000',
            'companyCountry' => 'Việt Nam',
            'companyPhone' => '0981284476',
            'companyFax' => '84981284476',
            'companyEmail' => 'nguyentrungkienmaithithanhthuy@gmail.com',
            'sheetTitle' => 'Bảng Users Version 1',
        ];
    }

    // Với interface FromView
    // public function view(): View
    // {
    //     // Trả về view (giao diện bảng) ra excel
    //     $users = User::select('id', 'name', 'email', 'is_admin', 'gender', 'phone')->whereNotNull('phone')->orderBy('id', 'desc')->get();
    //     return view('excel.index', compact('users'));
    // }
}
