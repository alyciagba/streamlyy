<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'diretor',
        'ano_lancamento',
        'descricao',
        'poster',
    ];

    // Relação com usuários (quem assistiu)
    public function usuarios()
    {
        return $this->belongsToMany(User::class)->withPivot('avaliacao','comentario')->withTimestamps();
    }

    // Relação com listas
    public function listas()
    {
        return $this->belongsToMany(Lista::class)->withTimestamps();
    }
}
