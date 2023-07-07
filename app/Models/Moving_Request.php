<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moving_Request extends Model
{
    use HasFactory;
    public function department()
    {
        return $this->belongsTo(Department::class, 'Department_ID');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'Student_ID');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'Class_ID');
    }

    public function new_department()
    {
        return $this->belongsTo(Department::class, 'Department_ID_New');
    }

    public function new_class()
    {
        return $this->belongsTo(Classes::class, 'Class_ID_New');
    }
}
