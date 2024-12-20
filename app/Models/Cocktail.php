<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    use HasFactory;

    // Asegúrate de agregar los campos que deseas permitir para la asignación masiva
    protected $fillable = [
        'name',
        'image',
        'category',
        'user_id', // Si quieres guardar el usuario relacionado
    ];
}
