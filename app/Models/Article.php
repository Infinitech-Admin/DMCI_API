<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'headline',
        'url',
        'content',
        'date',
        'image',
    ];

    public static function booted() {
        static::creating(function (Article $record) {
            $record->id = Str::ulid();
        });
    }
}
