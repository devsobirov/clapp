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
            'el' => "<input type='text' value='_VALUE_' class='form-control' name='_NAME_' placeholder='_PL_'>",
            'description' => "Single line text input, max: 255 chars"
        ],
        self::TYPE_TEXTAREA => [
            'name' => 'Textarea',
            'el' => "<textarea class='form-control' rows='2' name='_NAME_' placeholder='_PL_'>_VALUE_</textarea>",
            'description' => "Multi line text input"
        ],
        self::TYPE_RICH_EDITOR => [
            'name' => 'Rich text editor',
            'el' => "<textarea class='form-control py-3 ck-editor init-editor' name='_NAME_' placeholder='_PL_'>_VALUE_</textarea>",
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

    public function getDefinition(): string
    {
        if (array_key_exists($this->type, self::TYPES)) {
            return self::TYPES[$this->type]['description'];
        }
        return 'Unknown';
    }

    public function getRawEl(): string
    {
        if (array_key_exists($this->type, self::TYPES)) {
            return self::TYPES[$this->type]['el'];
        }
        return 'Unknown';
    }

    public function getDOMElement($value = ''): string
    {
        $el = $this->getRawEl();
        $name = $this->id;
        $placeholder = $this->name;
        $id = 'field-' . $name;
        $label = "<div class='d-flex w-100 justify-content-between mb-1' id='$id'>
                    <label class='form-label'>$placeholder</label>
                    <button class='remove-field btn btn-outline-danger btn-sm' onclick='rmField($name)' type='button'>Remove field</button>
                </div>";
        $el =  str_replace(['_NAME_', '_PL_', '_VALUE_'], [$name, $placeholder, $value], $el);
        return $label . $el;
    }
}
