<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Village::create([
            'name' => 'Karanganyar'
        ]);
        Village::create([
            'name' => 'Soklat'
        ]);
        Village::create([
            'name' => 'Pasirkareumbi'
        ]);
        Village::create([
            'name' => 'Cigadung'
        ]);
        Village::create([
            'name' => 'Sukamelang'
        ]);
        Village::create([
            'name' => 'Wanareja'
        ]);
        Village::create([
            'name' => 'Dangdeur'
        ]);
        Village::create([
            'name' => 'Parung'
        ]);
    }
}
