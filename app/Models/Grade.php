<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;

    // Campos que permitimos que el formulario guarde en la base de datos
    protected $fillable = [
        'subject_id', 
        'activity_type', 
        'score', 
        'date', 
        'comments'
    ];

    /**
     * Relación: Cada calificación pertenece a una materia
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}