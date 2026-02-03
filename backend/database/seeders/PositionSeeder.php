<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            'Senior Software Engineer',
            'Marketing and Communication Executive',
            'Financial Operations Officer',
            'Quality Assurance',
            'Inventory Administrator',
        ];

        foreach ($positions as $position) {
            Position::firstOrCreate([
                'name' => $position
            ]);
        }
    }
}
