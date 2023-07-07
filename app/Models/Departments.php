<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'department_teachers', 'Department_ID', 'Teacher_ID');
    }

    public function moving_requests()
    {
        return $this->hasMany(Moving_Request::class, 'Department_ID');
    }

    public function editing_marks_requests()
    {
        return $this->hasMany(Editing_Marks_Request::class, 'Department_ID');
    }

    protected $table = 'departments'; // set the table name
    protected $primaryKey = 'Department_ID'; // set the primary key field name
    protected $fillable = ['Department_Name']; // specify the fields that can be mass assigned

}
