<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name_municipalitie', 'id_departament_belongs'];


    public function students(){
        return $this->hasMany(Student::class);
    }

    public function departments(){
        return $this->belongsTo(Department::class);
    }
}
