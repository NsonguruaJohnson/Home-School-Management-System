<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id', 'course_id'
    ];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    // public function role(){
    //     return $this->hasMany(Role::class);
    // }
}
