<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

class Group extends Model
{
    use HasFactory;

    // Tên bảng đấu
    protected $fillable = ['name'];

    public $timestamps = false;

    // 1 bảng đấu chỉ chứa tối đa 4 câu lạc bộ
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
