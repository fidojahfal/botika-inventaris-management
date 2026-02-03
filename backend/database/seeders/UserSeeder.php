<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Tiara Tiara',
            'email' => 'tiara@botika.online',
            'password' => Hash::make('password'),
            'position_id' => 5,
            'department_id' => 1,
        ]);

        User::insert([
            [
                'name' => 'Daniel Alexander Carter',
                'position_id' => 1,
                'department_id' => 1,
            ],
            [
                'name' => 'Emily Grace Johnson',
                'position_id' => 3,
                'department_id' => 2,
            ],
            [
                'name' => 'Michael Benjamin Lee',
                'position_id' => 3,
                'department_id' => 3,
            ],
            [
                'name' => 'Sophia Elizabeth Turner',
                'position_id' => 4,
                'department_id' => 1,
            ],
            [
                'name' => 'Christopher Nathan Adams',
                'position_id' => 3,
                'department_id' => 3,
            ],
        ]);
    }
}
