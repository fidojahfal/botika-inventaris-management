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
            'jabatan' => 'Inventory Administrator',
            'department_id' => 1,
        ]);

        User::insert([
            [
                'name' => 'Daniel Alexander Carter',
                'jabatan' => 'Senior Software Engineer',
                'department_id' => 1,
            ],
            [
                'name' => 'Emily Grace Johnson',
                'jabatan' => 'Marketing and Communications Executive',
                'department_id' => 2,
            ],
            [
                'name' => 'Michael Benjamin Lee',
                'jabatan' => 'Financial Operations Officer',
                'department_id' => 3,
            ],
            [
                'name' => 'Sophia Elizabeth Turner',
                'jabatan' => 'Quality Assurance',
                'department_id' => 1,
            ],
            [
                'name' => 'Christopher Nathan Adams',
                'jabatan' => 'Financial Operations Officer',
                'department_id' => 3,
            ],
        ]);
    }
}
