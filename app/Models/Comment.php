<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'author', 'message', 'record_id',
    ];

    /**
     * Обратная связь один ко многим записи в блоге с комментариями
     */

    public function records()
    {
        return $this->belongsTo(Record::class);
    }
}
