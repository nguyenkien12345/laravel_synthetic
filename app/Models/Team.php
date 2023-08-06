<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Lấy ra số trận đã thi đấu của 1 team
    public function getMatchesPlayedAttribute()
    {
        return $this->won + $this->draw + $this->lost;
    }

    // Lấy ra hiệu số bàn thắng bại của 1 team
    public function getGoalsDifferenceAttribute()
    {
        return $this->goals_for - $this->goals_against;
    }

    // Lấy ra điểm của 1 team
    public function getPointsAttribute()
    {
        return $this->won * 3 + $this->draw * 1;
    }

    // 1 câu lạc bộ chỉ thi đấu trong 1 bảng đấu
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // Mỗi khi có thao tác save làm thay đổi dữ liệu như thêm sửa xóa thì sẽ thực hiện hàm boot dưới đây
    public static function boot()
    {
        parent::boot();

        static::saving(function ($team) {
            // Cập nhật lại field points
            $team->points = ($team->won * 3) + ($team->draw * 1);
        });
    }
}
