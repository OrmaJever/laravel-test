<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * @property int $id
 * @property string $text
 * @property bool $is_active
 * @property int $user_id
 *
 * @property-read User $user
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', 'is_active', 'user_id'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
