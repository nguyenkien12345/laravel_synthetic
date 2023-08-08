<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;
    // RefreshDatabase sẽ thực thi các hàng động sau lần lượt là:
    // 1) Chạy các migration
    // 2) Chèn dữ liệu mẫu (Seeder)
    // 3) Rollback sau khi kiểm thử hoàn tất

    public function setUp(): void {
        // Gọi trước khi các hàm test bắt đầu
    }

    // Start các hàm test
    // Quy tắc đặt tên hàm test: Luôn luôn bắt đầu bằng chữ test (Nó mới chạy được)

    // End các hàm test

    public function tearDown(): void {
        // Gọi sau khi các hàm test kết thúc
    }
}
