<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $bedrooms
 * @property int $bathrooms
 * @property int $storeys
 * @property int $garages
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|Apartment newModelQuery()
 * @method static Builder<static>|Apartment newQuery()
 * @method static Builder<static>|Apartment query()
 * @method static Builder<static>|Apartment whereBathrooms($value)
 * @method static Builder<static>|Apartment whereBedrooms($value)
 * @method static Builder<static>|Apartment whereCreatedAt($value)
 * @method static Builder<static>|Apartment whereGarages($value)
 * @method static Builder<static>|Apartment whereId($value)
 * @method static Builder<static>|Apartment whereName($value)
 * @method static Builder<static>|Apartment wherePrice($value)
 * @method static Builder<static>|Apartment whereStoreys($value)
 * @method static Builder<static>|Apartment whereUpdatedAt($value)
 * @mixin Eloquent
 * @mixin Builder
 */
class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'bathrooms',
        'bedrooms',
        'storeys',
        'garages'
    ];
}
