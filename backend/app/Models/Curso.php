<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'titulo',
        'instituicao',
        'tipo',
        'status',
        'horas',
        'data_inicio', 
        'data_conclusao',
        'certificado_url',
        'imagem_url'
    ];
}