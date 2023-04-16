<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Field extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TYPE_INPUT = 1;
    const TYPE_TEXTAREA = 2;
    const TYPE_RICH_EDITOR = 3;

    const TYPES = [
        self::TYPE_INPUT => [
            'name' => 'Input',
            'el' => "<input type='text'>"
        ],
        self::TYPE_TEXTAREA => [
            'name' => 'Textarea',
            'el' => "<textarea></textarea>"
        ],
        self::TYPE_RICH_EDITOR => [
            'name' => 'Rich text editor',
            'el' => ""
        ],
    ];

    public function food(): BelongsToMany
    {
        return $this->belongsToMany(
            Food::class,
            'food_fields',
            'field_id',
            'food_id',
        )->withPivot(['value'])->orderByPivot('order');
    }
}
