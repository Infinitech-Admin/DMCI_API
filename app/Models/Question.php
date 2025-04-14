<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'question',
        'answer',
        'status',
    ];

    public static function booted() {
        static::creating(function (Question $record) {
            $record->id = Str::ulid();
        });
    }
}
