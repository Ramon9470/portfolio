<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'titulo',
        'slug',
        'descricao',
        'tecnologias',
        'imagem_url',
        'repo_url',
        'live_url',
        'ordem'
    ];

    protected $casts = [
        'tecnologias' => 'array',
    ];
}