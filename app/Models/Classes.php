<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class, 'Department_ID');
    }

    public function specialty()
    {
        return$this->belongsTo(Specialty::class, 'Specialty_ID');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_students', 'Class_ID', 'Student_ID');
    }

    public function moving_requests()
    {
        return $this->hasMany(Moving_Request::class, 'Class_ID');
    }

    public function editing_marks_requests()
    {
        return $this->hasMany(Editing_Marks_Request::class, 'Class_ID');
    }
}
