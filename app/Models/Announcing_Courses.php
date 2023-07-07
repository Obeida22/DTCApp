<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcing_Courses extends Model
{
    use HasFactory;
    public function employee()
{
    return $this->belongsTo(Employee::class, 'Employee_ID');
}
public function shortCourses()
{
    return $this->hasMany(ShortCourse::class, 'Courses_ID');
}
}
