<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Food extends Model
{
    use HasFactory;

    protected $guarded = [];
    const DEFAULT_IMAGE = '';

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

    /** Eloquent Scopes */
    public function scopeSearch(Builder $query, $search = '')
    {
        $search = trim(strip_tags($search));
        $query->when(!empty($search), function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    public function scopeByCategory(Builder $query, $category_id = null)
    {
        $query->when(is_numeric($category_id), function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        });
    }

    public function image_url(): string
    {
        return asset($this->image ? $this->image : self::DEFAULT_IMAGE);
    }
}
