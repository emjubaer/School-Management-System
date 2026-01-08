<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
        use HasFactory;
    protected $fillable = [
        'reg_no',
        'name',
        'phone',
        'email',
        'class_id',
        'dob',
        'address',
        'photo'
    ];

    public function subjects(){
        return $this->belongsToMany(Subject::class);
    }

    public function classRoom(){
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }
}
