<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    use HasFactory;

    protected $table = 'experiences';

    protected $fillable = [
        'empresa',
        'cargo',
        'periodo',
        'descricao'
    ];
}