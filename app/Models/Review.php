<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rating',
        'comment',
        'user_id',
        'item_id'
    ];
    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function items(): BelongsTo {
        return $this->belongsTo(Item::class);
    }
}
