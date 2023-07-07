<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specilties extends Model
{
    use HasFactory;

    public function classes()
    {
        return $this->hasMany(Classes::class, 'Specialty_ID');
    }

    
}
