<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    // Permite guardar el nombre de la materia de forma masiva
    protected $fillable = ['name'];

    /**
     * Relación: Una materia tiene muchas calificaciones (grades)
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
