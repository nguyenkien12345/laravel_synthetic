<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'priority',
        'notes',
        'status',
        'start_date',
        'end_date',
    ];

    public function setTitleAttribute($title)
    {
        if (!$title) return;
        $this->attributes['title'] = ucwords($title);
    }

    public function setNotesAttribute($notes)
    {
        if (!$notes) return;
        $this->attributes['notes'] = mb_strtolower($notes);
    }

    // public function getStartDateAttribute($value){
    //     return date('d-m-Y', strtotime($value));
    // }

    // public function getStartTimeAttribute(){
    //     return date('H:i', strtotime($this->attributes['start_date']));
    // }

    // public function getEndDateAttribute($value){
    //     return date('d-m-Y', strtotime($value));
    // }

    // public function getEndTimeAttribute(){
    //     return date('H:i', strtotime($this->attributes['end_date']));
    // }
}
