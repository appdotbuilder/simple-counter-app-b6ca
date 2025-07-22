<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Counter
 *
 * @property int $id
 * @property int $count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Counter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Counter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Counter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Counter whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counter whereUpdatedAt($value)
 * @method static \Database\Factories\CounterFactory factory($count = null, $state = [])
 * @method static Counter create(array $attributes = [])
 * @method static Counter firstOrCreate(array $attributes = [], array $values = [])
 * 
 * @mixin \Eloquent
 */
class Counter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'count' => 'integer',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'counters';
}