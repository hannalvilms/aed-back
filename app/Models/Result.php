<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'game_id', 'score'
    ];

    public function games()
    {
        return $this->belongsTo(Game::class);
    }
}
