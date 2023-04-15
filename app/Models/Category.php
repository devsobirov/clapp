<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function isParent(): bool
    {
        return !!$this->parent_id;
    }

    public static function getParentCategories()
    {
        return self::select('id', 'title', 'created_at')
            ->whereNull('parent_id')
            ->orderBy('order')->orderBy('id', 'desc')
            ->get();
    }

    public static function getChildCategories($parent_id)
    {
        return self::select('id', 'title', 'image', 'created_at', 'order')
            ->where('parent_id', $parent_id)
            ->orderBy('order')->orderBy('id', 'desc')
            ->get();
    }

    public function image_url(): string
    {
        if ($this->image) return asset($this->image);
        return '';
    }
}
