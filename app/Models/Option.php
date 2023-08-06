<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Poll;

class Option extends Model
{
    use HasFactory;

    protected $guarded = [];

    // 1 option chỉ thuộc vào 1 cuộc bỏ phiếu
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
