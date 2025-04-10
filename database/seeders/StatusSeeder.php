<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['name' => 'open', 'description' => 'Aberto para processamento'],
            ['name' => 'in_progress', 'description' => 'Em progresso de resolução'],
            ['name' => 'closed', 'description' => 'Concluído com sucesso'],
        ]);
    }
}
