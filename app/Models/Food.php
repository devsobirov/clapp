<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Food extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(
            Field::class,
            'food_fields',
            'food_id',
            'field_id'
        )->withPivot(['value'])->orderByPivot('order', 'asc');
    }
}
