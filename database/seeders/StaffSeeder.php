<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  
        DB::table('staff')->insert([
            [
                'id' => Str::uuid(),
                'name' => "Mr. Wayan",
                'team_id' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => "Mr. Kadek",
                'team_id' => 2,
            ]
        ]);
    }
}
