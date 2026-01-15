<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'class_room_id',
        'name',
        'sub_code',
        'fullmark',
        'pass_mark',
        'description',
    ];

    public function teachers(){
        return $this->belongsToMany(Teacher::class);
    }
    public function students(){
        return $this->belongsToMany(Student::class);
    }

    public function classRooms(){
        return $this->belongsTo(ClassRoom::class);
    }


}
