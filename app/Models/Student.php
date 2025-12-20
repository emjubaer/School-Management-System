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
        'class',
        'dob',
        'address',
        'photo'
    ];

    public function subjects(){
        return $this->belongsToMany(Subject::class);
    }
}
