<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Listing extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
      'id',
      'user_id',
      'property_id',
      'name',
      'email',
      'phone',
      'unit_type',
      'unit_price',
      'status',
      'description',
      'images',
      'furnish_status',
      'item',
      'unit_area',
      'building_id',
      'unit_cut',
    ];

    public static function booted(){
        static::creating(function (Listing $record){
            $record->id = Str::ulid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); 
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class); 
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class); 
    }
}
