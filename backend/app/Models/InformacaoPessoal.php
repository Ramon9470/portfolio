<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformacaoPessoal extends Model
{
    protected $table = 'informacoes_pessoais';

    protected $fillable = [
        'nome_completo', 'titulo', 'resumo', 'email', 'telefone', 
        'cidade', 'estado', 'perfil_foto_url', 'github_url', 
        'linkedin_url', 'whatsapp_url', 'habilidades', 'idiomas'
    ];

    protected $casts = [
        'habilidades' => 'array',
        'idiomas' => 'array',
    ];
}