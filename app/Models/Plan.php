<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $publication_count
 * @property bool $is_active
 * */
class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'publication_count', 'is_active'
    ];

    protected $casts = [
        'publication_count' => 'integer',
        'is_active' => 'boolean'
    ];

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn($price) => round($price / 100, 2),
            set: fn($price) => intval($price * 100)
        );
    }
}
