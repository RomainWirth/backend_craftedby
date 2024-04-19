<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artisan extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'siret',
        'about',
        'craftingDescription',
        'companyName',
        'theme_id',
        'user_id',
    ];
    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";
    protected $table = 'artisans';

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function theme(): BelongsTo {
        return $this->belongsTo(Theme::class);
    }

    public function specialties(): BelongsToMany {
        return $this->belongsToMany(Specialty::class)->withPivot('specialty_id');
    }

    public function items(): HasMany {
        return $this->hasMany(Item::class);
    }
}
