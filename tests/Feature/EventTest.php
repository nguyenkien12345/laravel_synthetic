<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\GoogleCalendarService;
use App\Http\Controllers\GoogleCalendarController;
use Tests\TestCase;

class EventTest extends TestCase
{
    private $googleCalendarService;
    private $googleCalendarController;

    // use RefreshDatabase;
    // RefreshDatabase sẽ thực thi các hàng động sau lần lượt là:
    // 1) Chạy các migration
    // 2) Chèn dữ liệu mẫu (Seeder)
    // 3) Rollback sau khi kiểm thử hoàn tất

    public function setUp(): void {
        // Gọi trước khi các hàm test bắt đầu
        parent::setUp();
        $this->afterApplicationCreated(function() {
            $this->googleCalendarService = new GoogleCalendarService();
            $this->googleCalendarController = new GoogleCalendarController();
        });
    }

    // Quy tắc đặt tên hàm test: Luôn luôn bắt đầu bằng chữ test (Nó mới chạy được)
    public function test_status_and_content_of_page_google_calendar() {
        // Kiểm tra xem khi get trang google-calendar về status trả về có phải là 200 và trong trang web có chứa chữ Nguyễn Trung Kiên
        // và không có chứa chữ Project123 FullCalendar123
        $response =$this->get('/google-calendar');
        $response->assertStatus(200);
        $response->assertSee('Nguyễn Trung Kiên');
        $response->assertDontSee('Project123 FullCalendar123');
    }

    public function test_count_list_event() {
        $events = $this->googleCalendarService->getAllEvent();
        // Kiểm tra xem đối tượng events trả về có phải là 5 record không
        $this->assertCount(5, $events);
    }

    public function test_events_has_specific_data() {
        // Kiểm tra xem trong bảng events có record nào có title là Đá banh và status là 1
        $this->assertDatabaseHas("events", ["title" => "Đá Banh", "status" => 1]);
    }

    public function test_get_detail_event() {
        // Kiểm tra đối tượng event trả về có status là 1, có title là Công Chứng Hồ Sơ, có notes là null, có priority khác 2
        $event = $this->googleCalendarService->getDetailEvent(1);
        $this->assertEquals($event->status, 1);
        $this->assertEquals($event->title, 'Công Chứng Hồ Sơ');
        $this->assertEmpty($event->notes);
        $this->assertNotEquals($event->priority, 2);
    }

    public function test_view_has_specific_data() {
        $event = $this->googleCalendarService->getDetailEvent(1);
        $response = $this->get('/google-calendar');
        // Kiểm tra xem trong view google-calendar trả về có chứa đối tượng php là bookings không ? Và trong đối tượng bookings
        // trả về này có chứa đối tượng event ở trên không (Nó sẽ giống như là kiểm tra trong list event hiển thị ra có chứa đối tượng
        // $event không)
        $response->assertViewHas('bookings', function ($collection) use ($event) {
            return $collection->contains($event);
        });
    }

    public function tearDown(): void {
        // Gọi sau khi các hàm test kết thúc
        parent::tearDown();
    }
}

// php artisan test --filter EventTest
