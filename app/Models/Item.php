<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'imageUrl',
        'description',
        'price',
        'stock',
        'category_id',
        'size_id',
        'color_id',
        'artisan_id',
    ];

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";
    protected $table = 'items';

    public function artisan(): BelongsTo {
        return $this->belongsTo(Artisan::class);
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function size(): BelongsTo {
        return $this->belongsTo(Size::class);
    }

    public function color(): BelongsTo {
        return $this->belongsTo(Color::class);
    }

    public function materials(): BelongsToMany {
        return $this->belongsToMany(Material::class);
    }

    public function carts(): BelongsToMany {
        return $this->belongsToMany(Cart::class, 'cart_item')->withPivot('quantity');
    }

    public function reviews(): HasMany {
        return $this->hasMany(Review::class);
    }

}
