<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome',
    ];

    // Uma lista pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Uma lista possui muitos filmes (Many-to-Many)
    public function filmes()
    {
        return $this->belongsToMany(Filme::class)
                    ->withTimestamps();
    }
}
