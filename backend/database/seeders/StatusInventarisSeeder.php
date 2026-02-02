<?php

namespace Database\Seeders;

use App\Models\Status_inventaris;
use Illuminate\Database\Seeder;

class StatusInventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status_inventaris::insert([
            ["name" => "Baik"],
            ["name" => "Rusak"],
            ["name" => "Dilelang"],
            ["name" => "Tidak Dipakai"],
        ]);
    }
}
