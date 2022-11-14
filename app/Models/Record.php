<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Record extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'author', 'message',
    ];

    /**
     * Связь один ко многим с комментариями
     */

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
