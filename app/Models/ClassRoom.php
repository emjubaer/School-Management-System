<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = [
        'name',
        'status',
        'description',
    ];

    public function students(){
        return $this->hasMany(Student::class, 'class_id');
    }

    public function subjects(){
        return $this->hasMany(Subject::class);

        }
}
