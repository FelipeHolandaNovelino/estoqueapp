<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids; 
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasUuids; 

    protected $guarded = [];

    protected $keyType = 'string';

    /**
     * Relacionamento: O Produto pertence a um Usuário (o criador).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // A função categoria() foi removida.
}