<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialty extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";
    protected $table = 'specialties';

    public function artisan(): BelongsToMany {
        return $this->belongsToMany(Artisan::class)->withPivot('artisan_id');
    }
}
