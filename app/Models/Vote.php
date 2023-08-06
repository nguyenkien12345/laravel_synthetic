<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Option;
use Carbon\Carbon;

class Vote extends Model
{
    use HasFactory;

    protected $guarded = [];

    // 1 lượt vote luôn thuộc về 1 option
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
