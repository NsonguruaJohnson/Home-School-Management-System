<?php

namespace App\Models;

// use App\Models\Role;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id', 'description',
        // 'teacher_id',
    ];

    public function user(){
        // return $this->hasMany(User::class);
        return $this->belongsToMany(User::class);

    }

    public function activity(){
        return $this->hasMany(Activity::class); #or hasOne
    }

    // public function role(){
    //     return $this->hasMany(Role::class);
    // }
}
