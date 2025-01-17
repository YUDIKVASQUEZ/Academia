<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name_department', 'id_country_belongs'];
    use HasFactory;

    public function countries(){
        return $this->belongsTo(Country::class);
    }
    public function municipalities(){
        return $this->hasMany(Municipality::class);
    }
}
// Esto es un comentario
