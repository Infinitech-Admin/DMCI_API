<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'type',
        'width',
        'height',
        'image',
    ];

    public static function booted() {
        static::creating(function (Item $record) {
            $record->id = Str::ulid();
        });
    }
}
