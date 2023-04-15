<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Food',
                'order' => 1,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Coctail',
                'order' => 5,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Wine',
                'order' => 10,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
