<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'TI', 'description' => 'Solicitações relacionadas a tecnologia', 'is_active' => true],
            ['name' => 'Suprimentos', 'description' => 'Solicitações de materiais e insumos', 'is_active' => true],
            ['name' => 'RH', 'description' => 'Solicitações relacionadas a recursos humanos', 'is_active' => true],
        ]);
    }
}
