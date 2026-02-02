<?php

namespace Database\Seeders;

use App\Models\Inventaris;
use Illuminate\Database\Seeder;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventaris::insert([
            [
                'id' => 'INV-1124',
                'name' => 'Lenovo Legion',
                'type_id' => 1,
                'serial_number' => '11235512',
                'spesifikasi' => 'RAM 16GB',
                'status_id' => 1,
                'assigned_user_id' => 1,
                'department_id' => 1,
            ],
            [
                'id' => 'INV-1125',
                'name' => 'Lenovo Legion',
                'type_id' => 1,
                'serial_number' => '1123120012',
                'spesifikasi' => 'RAM 16GB',
                'status_id' => 2,
                'assigned_user_id' => 2,
                'department_id' => 1,
            ],
            [
                'id' => 'INV-1126',
                'name' => 'Lenovo Legion',
                'type_id' => 1,
                'serial_number' => '11929319',
                'spesifikasi' => 'RAM 16GB',
                'status_id' => 4,
                'assigned_user_id' => 3,
                'department_id' => 1,
            ],
            [
                'id' => 'INV-1127',
                'name' => 'Lenovo Legion',
                'type_id' => 1,
                'serial_number' => '220310902',
                'spesifikasi' => 'RAM 16GB',
                'status_id' => 3,
                'assigned_user_id' => 4,
                'department_id' => 1,
            ],
            [
                'id' => 'INV-1128',
                'name' => 'Lenovo Legion',
                'type_id' => 1,
                'serial_number' => '321021023',
                'spesifikasi' => 'RAM 16GB',
                'status_id' => 1,
                'assigned_user_id' => 5,
                'department_id' => 1,
            ],
            [
                'id' => 'INV-1129',
                'name' => 'Dell Monitor 24"',
                'type_id' => 2,
                'serial_number' => '112302012',
                'spesifikasi' => 'IPS Panel',
                'status_id' => 2,
                'assigned_user_id' => 1,
                'department_id' => 2,
            ],
            [
                'id' => 'INV-1130',
                'name' => 'Keyboard Mechanical',
                'type_id' => 3,
                'serial_number' => '221023912',
                'spesifikasi' => 'Blue Switch',
                'status_id' => 4,
                'assigned_user_id' => null,
                'department_id' => 1,
            ],
        ]);
    }
}
