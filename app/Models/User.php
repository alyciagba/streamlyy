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

    // Relacionamento com filmes (muitos-para-muitos)
    public function filmes()
    {
        return $this->belongsToMany(Filme::class)->withPivot('avaliacao','comentario')->withTimestamps();
    }

    // Relacionamento com listas (um-para-muitos)
    public function listas()
    {
        return $this->hasMany(Lista::class);
    }

    // Ajusta o Auth do Laravel para usar o campo 'senha'
    public function getAuthPassword()
    {
        return $this->senha;
    }
}
