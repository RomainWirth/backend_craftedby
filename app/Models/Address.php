<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'street',
        'postalCode',
        'city',
        'countryCode',
        'user_id',
    ];

    protected $hidden = [
        'id'
    ];

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
