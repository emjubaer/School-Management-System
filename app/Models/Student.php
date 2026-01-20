<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    public function subjects()
    {
        return $this->hasManyThrough(Subject::class, ClassRoom::class, 'id', 'class_room_id', 'class_id', 'id');
    }

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }
}
