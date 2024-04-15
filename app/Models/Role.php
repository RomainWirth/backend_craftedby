<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
    ];

    protected $casts = [
        'id' => 'string',
//        'role' => UserRoleEnum::class
    ];
    protected $primaryKey = "id";

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }
}
