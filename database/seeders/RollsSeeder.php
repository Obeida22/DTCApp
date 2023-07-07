<?php

namespace Database\Seeders;

use App\Models\Rolls;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RollsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rool = Rolls::create([

            'Roll_ID' => 1,
            'Roll_Name' => 'value2',
            // ...
        ]);
    }
}
