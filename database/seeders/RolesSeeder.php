<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'role_name' => 'ยังไม่ระบุ',
            ],
            [
                'role_name' => 'แอดมิน',
            ],
            [
                'role_name' => 'พนักงานขาย',
            ],
            [
                'role_name' => 'พนักงานคลังสินค้า',
            ]
        ];

        foreach($role as $key => $value) {
            Roles::create($value);
        }
    }
}
