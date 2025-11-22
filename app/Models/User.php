<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'data_nascimento',
        'foto',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    // Relacionamento Many-to-Many com filmes
    // Guarda nota e comentário no pivot
    public function filmes()
    {
        return $this->belongsToMany(Filme::class)
                    ->withPivot('avaliacao','comentario')
                    ->withTimestamps();
    }

    // Relacionamento One-to-Many com listas
    public function listas()
    {
        return $this->hasMany(Lista::class);
    }

    // Ajusta o Auth do Laravel para usar o campo 'senha' do banco
    public function getAuthPassword()
    {
        return $this->senha;
    }
}
