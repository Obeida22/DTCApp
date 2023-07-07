<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students'; // set the table name
    protected $primaryKey = 'user_ID'; // set the primary key field name
    protected $fillable = [
        'user_ID',
        'Father_name',
        'Mother_name',
        'Birth_place',
        'Recruitment_Division',
        'English_Name',
        'Address_Current',
        'Address_Permanent',
        'Admissions',
        'Graduate',
        'Total_MarkUser',
    ]; // specify the fields that can be mass assigned

    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID');
    }


    public function roll()
    {
        return $this->hasOne(Roll::class, 'Roll_ID');
    }

    public function wishes()
    {
        return $this->hasMany(Wish::class, 'Student_ID');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'Student_ID');
    }

    public function guardians()
    {
        return $this->hasMany(Guardian::class, 'Student_ID');
    }

    public function missionStudents()
    {
        return $this->hasMany(MissionStudent::class, 'Student_ID');
    }

    public function incomingConsultings()
    {
        return $this->hasMany(IncomingConsulting::class, 'Student_ID');
    }

    public function mode()
    {
        return $this->hasOne(StudentMode::class, 'Student_ID');
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_students', 'Student_ID', 'Class_ID');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'Roll_ID');
    }

    public function moving_requests()
    {
        return $this->hasMany(Moving_Request::class, 'Student_ID');
    }

    public function editing_marks_requests()
    {
        return $this->hasMany(Editing_Marks_Request::class, 'Student_ID');
    }
}
