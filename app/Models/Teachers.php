<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    protected $table = 'teachers'; // set the table name
    protected $primaryKey = 'Teacher_ID';
    protected $fillable = [
        'certificate_name', 'department_id', 'user_id'
    ];
    public function roll()
    {
        return $this->hasOne(Roll::class, 'Roll_ID');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_teachers', 'Teacher_ID', 'Department_ID');
    }

    public function editing_marks_requests()
    {
        return $this->hasMany(Editing_Marks_Request::class, 'Teacher_ID');
    }
}
