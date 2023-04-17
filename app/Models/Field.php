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
            'el' => "<input type='text'>",
            'description' => "Single line text input, max: 255 chars"
        ],
        self::TYPE_TEXTAREA => [
            'name' => 'Textarea',
            'el' => "<textarea></textarea>",
            'description' => "Multi line text input"
        ],
        self::TYPE_RICH_EDITOR => [
            'name' => 'Rich text editor',
            'el' => "",
            'description' => "Editor for formatted text with HTML markup"
        ],
    ];

    public static function getOrNew($id = null): Field
    {
        if (!empty($id)) return self::findOrFail($id);
        return new Field();
    }

    public function food(): BelongsToMany
    {
        return $this->belongsToMany(
            Food::class,
            'food_fields',
            'field_id',
            'food_id',
        )->withPivot(['value'])->orderByPivot('order');
    }

    public function getType(): string
    {
        if (array_key_exists($this->type, self::TYPES)) {
            return self::TYPES[$this->type]['name'];
        }
        return 'Unknown';
    }
}
