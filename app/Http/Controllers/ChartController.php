<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

class ChartController extends Controller
{

    private $user;
    private $userController;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->userController = new UserController($user);
    }

    public function userRegisterBarChart()
    {
        try {
            // Lấy ra số lượng người dùng được tạo trong mỗi tháng trong năm hiện tại.
            $users = $this->userController->usersByMonth();

            $labels = [];
            $data = [];
            // Mảng chứa 12 màu tương ứng với 12 tháng
            $colors = ['#FEF9E7', '#EBDEF0', '#F6DDCC', '#EAEDED', '#D7BDE2', '#AED6F', '#A9DFBF', '#FAD7A0', '#ABEBC6', '#F7DC6F', '#CB4335', '#9A7D0A'];

            for ($i = 1; $i <= 12; $i++) {
                // date('F', mktime(0, 0, 0, $i, 1)): Lấy tên của 1 tháng dựa trên 1 giá trị số tháng được đưa vào
                // Ví dụ, nếu $i có giá trị là 1, kết quả sẽ là "January",
                // nếu $i là 2, kết quả sẽ là "February", và cứ tiếp tục như vậy cho tất cả các giá trị $i từ 1 đến 12.
                $month = date('F', mktime(0, 0, 0, $i, 1));
                $count = 0;

                foreach ($users as $user) {
                    if ($user->month == $i) {
                        $count = $user->count;
                        break;
                    }
                }

                // Push vào mảng label từng giá trị month
                array_push($labels, $month);
                // Push vào mảng data từng giá trị count
                array_push($data, $count);
            }

            $datasets = [
                [
                    'label' => 'Users',
                    'data' => $data,
                    'backgroundColor' => $colors
                ]
            ];

            return view('charts.register_user_bar_chart', compact('datasets', 'labels'));
        } catch (\Exception $e) {
            return [
                'status' => false,
                'controller' => 'ChartController',
                'message' => $e->getMessage(),
                'time' => Carbon::now()->format('d/m/Y H:i')
            ];
        }
    }

    public function userRegisterHighChart()
    {
        try {
            // Lấy ra số lượng người dùng được tạo trong mỗi tháng trong năm hiện tại.
            $users = $this->userController->usersByMonth();

            $labels = [];
            $data = [];
            // Mảng chứa 12 màu tương ứng với 12 tháng
            $colors = ['#FEF9E7', '#EBDEF0', '#F6DDCC', '#EAEDED', '#D7BDE2', '#AED6F', '#A9DFBF', '#FAD7A0', '#ABEBC6', '#F7DC6F', '#CB4335', '#9A7D0A'];

            for ($i = 1; $i <= 12; $i++) {
                // date('F', mktime(0, 0, 0, $i, 1)): Lấy tên của 1 tháng dựa trên 1 giá trị số tháng được đưa vào
                // Ví dụ, nếu $i có giá trị là 1, kết quả sẽ là "January",
                // nếu $i là 2, kết quả sẽ là "February", và cứ tiếp tục như vậy cho tất cả các giá trị $i từ 1 đến 12.
                $month = date('F', mktime(0, 0, 0, $i, 1));
                $count = 0;

                foreach ($users as $user) {
                    if ($user->month == $i) {
                        $count = $user->count;
                        break;
                    }
                }

                // Push vào mảng label từng giá trị month
                array_push($labels, $month);
                // Push vào mảng data từng giá trị count
                array_push($data, $count);
            }

            return view('charts.register_user_high_chart', compact('data', 'labels', 'colors'));
        } catch (\Exception $e) {
            return [
                'status' => false,
                'controller' => 'ChartController',
                'message' => $e->getMessage(),
                'time' => Carbon::now()->format('d/m/Y H:i')
            ];
        }
    }
}
