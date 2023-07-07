<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editing_Marks_Request extends Model
{
    use HasFactory;

    protected $table = 'editing_marks_requests';

    public function department()
    {
        return $this->belongsTo(Department::class, 'Department_ID');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'Class_ID');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'Student_ID');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'Teacher_ID');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'Material_ID');
    }

}
