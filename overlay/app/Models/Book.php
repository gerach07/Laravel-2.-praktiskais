<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'user_id', 'genre_id', 'title', 'author',
        'pages', 'year', 'description', 'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
