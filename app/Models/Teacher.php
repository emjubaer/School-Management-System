<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'emp_code',
        'name',
        'email',
        'phone',
        'gender',
        'address',
        'photo',
        'department',
        'designation',
        'status'
    ];


    public function user(){
        return $this->belongsTo('User::class');
    }
    public function subjects(){
        return $this->belongsToMany('Subject::class');
    }
}
