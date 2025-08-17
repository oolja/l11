<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\RestaurantFactory;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static Builder|Restaurant create(array $attributes = [])
 *
 * @property int $id
 * @property string $name
 * @property DateTimeInterface $created_at
 * @property DateTimeInterface $updated_at
 */
final class Restaurant extends Model
{
    /** @use HasFactory<RestaurantFactory> */
    use HasFactory;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    protected $fillable = [
        'name',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
