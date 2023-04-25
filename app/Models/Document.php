<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [];
    const BASE_DIR = 'docs';

    public static function getOrNew($id = null): self
    {
        return is_numeric($id) ? self::findOrFail($id) : new Document();
    }

    public function scopeSearch(Builder $query, $search = '')
    {
        $search = trim(strip_tags($search));
        $query->when(!empty($search), function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
}
