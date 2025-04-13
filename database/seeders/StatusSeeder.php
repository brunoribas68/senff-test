<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['name' => 'aberto', 'description' => 'Aberto para processamento'],
            ['name' => 'em andamento', 'description' => 'Em progresso de resolução'],
            ['name' => 'fechado', 'description' => 'Concluído com sucesso'],
        ]);
    }
}
