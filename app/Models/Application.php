<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Application extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'position',
        'name',
        'email',
        'phone',
        'address',
        'resume'
    ];

    public static function booted()
    {
        static::creating(function (Application $record) {
            $record->id = Str::ulid();
        });
    }
}
