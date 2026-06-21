<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'status',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getImageAttribute($value)
    {
        if (!$value) {
            return null;
        }
        if (preg_match('/^(https?:\/\/|data:)/i', $value)) {
            return $value;
        }
        return asset('storage/' . $value);
    }
}

