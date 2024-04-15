<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'paymentStatus',
        'user_id'
    ];
    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function items(): BelongsToMany {
        return $this->belongsToMany(Item::class, 'cart_item')->withPivot(['quantity']);
    }

    public function order(): HasOne {
        return $this->hasOne(Order::class);
    }

}
