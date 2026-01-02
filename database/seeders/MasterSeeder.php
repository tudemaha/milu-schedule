<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('master_teams')->insert([
            [
                'id' => 1,
                'name' => 'Hot Kitchen',
            ],
            [
                'id' => 2,
                'name' => 'Plating',
            ],
            [
                'id' => 3,
                'name' => 'Steward',
            ],
        ]);

        DB::table('master_request_types')->insert([
            [
                'id' => 1,
                'name' => 'Off',
            ],
            [
                'id' => 2,
                'name' => 'Morning (M)',
            ],
            [
                'id' => 3,
                'name' => 'Evening (E)',
            ],
            [
                'id' => 4,
                'name' => 'Personal Leave',
            ],
            [
                'id' => 5,
                'name' => 'Sick Leave',
            ]
        ]);
    }
}
