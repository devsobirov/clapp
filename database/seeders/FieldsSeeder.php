<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldsSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            [
                'name' => 'Ingredients',
                'type' => Field::TYPE_RICH_EDITOR,
                'description' => 'Ingredients list of food or coctail items',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Preparation time',
                'type' => Field::TYPE_INPUT,
                'description' => 'Usually for food items',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Allergies',
                'type' => Field::TYPE_TEXTAREA,
                'description' => 'List of allegens in food',
                'created_at' => now(), 'updated_at' => now()
            ],

            [
                'name' => 'Country/Region',
                'type' => Field::TYPE_INPUT,
                'description' => 'Usually for wine, in which country was made',
                'created_at' => now(), 'updated_at' => now()
            ],
        ];


        DB::table('fields')->insert($fields);
    }
}
