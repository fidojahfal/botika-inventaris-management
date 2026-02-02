<?php

namespace Database\Seeders;

use App\Models\type_inventaris;
use Illuminate\Database\Seeder;

class TypeInventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        type_inventaris::insert([
            ["name" => "Laptop"],
            ["name" => "Monitor"],
            ["name" => "Keyboard"],
            ["name" => "Mouse"],
        ]);
    }
}
