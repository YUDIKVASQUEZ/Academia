<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['document_type', 'document_number', 'identify_document','id_issuing_municipality',
     'expedition_date', 'names', 'first_last_name', 'second_last_name', 'gender', 'birth_date',
     'id_birth_municipality', 'stratum', 'id_course'];

    public function municipalities(){
        return $this->belongsTo(Municipality::class);
    }
    public function courses(){
        return $this->belongsTo(Course::class);
    }

}
