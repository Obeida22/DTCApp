<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaflets extends Model
{
    use HasFactory;

    public function department()
{
    return $this->belongsTo(Department::class, 'Department_ID');
}

public function teacher()
{
    return $this->belongsTo(Teacher::class, 'Teacher_ID');
}


}
