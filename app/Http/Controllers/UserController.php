<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // Lấy ra số lượng người dùng được tạo trong mỗi tháng trong năm hiện tại.
    public function usersByMonth()
    {
        try {
            $users = $this->user->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();
            return $users;
        } catch (\Exception $e) {
            return [
                'status' => false,
                'controller' => 'UserController',
                'message' => $e->getMessage(),
                'time' => Carbon::now()->format('d/m/Y H:i')
            ];
        }
    }
}
