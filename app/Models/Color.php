<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function items(): HasMany {
        return $this->hasMany(Item::class);
    }
}
