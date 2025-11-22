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

    // Relacionamento Many-to-Many com usuários (quem assistiu)
    public function usuarios()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('avaliacao','comentario')
                    ->withTimestamps();
    }

    // Relacionamento Many-to-Many com listas
    public function listas()
    {
        return $this->belongsToMany(Lista::class)
                    ->withTimestamps();
    }
}
