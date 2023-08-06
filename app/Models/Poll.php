<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Option;
use Carbon\Carbon;

class Poll extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    // Nó sẽ tương ứng với name là start_date
    public function getStartDateAttribute()
    {
        // return Carbon::parse($this->start_at)->toDateString();  // Chỉ lấy ra ngày tháng năm
        return $this->start_at->format('M d, Y');
    }

    // Nó sẽ tương ứng với name là start_time
    public function getStartTimeAttribute()
    {
        // return Carbon::parse($this->start_at)->toTimeString();  // Chỉ lấy ra giờ phút giây
        return $this->start_at->format('h:i A');
    }

    // Nó sẽ tương ứng với name là end_date
    public function getEndDateAttribute()
    {
        // return Carbon::parse($this->end_at)->toDateString();  // Chỉ lấy ra ngày tháng năm
        return $this->end_at->format('M d, Y');
    }

    // Nó sẽ tương ứng với name là end_time
    public function getEndTimeAttribute()
    {
        // return Carbon::parse($this->end_at)->toTimeString();  // Chỉ lấy ra giờ phút giây
        return $this->end_at->format('h:i A');
    }

    public function getEndDateFromAttribute()
    {
        return $this->end_at->diffForHumans();
    }

    // 1 cuộc bỏ phiếu, cuộc thu thập thông tin, ý kiến (poll) chỉ được tạo bởi 1 người dùng (user)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // 1 cuộc bỏ phiếu, cuộc thu thập thông tin, ý kiến (poll) có thể có nhiều lựa chọn (option)
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    // 1 cuộc bỏ phiếu, cuộc thu thập thông tin, ý kiến (poll) có thể có nhiều bầu chọn (vote)
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
