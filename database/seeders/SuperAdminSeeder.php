<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
        ['email' => 'falla3235@coex.com'],
        [
            'name' => 'Cristoffer Falla',
            'password' => bcrypt('CAllofduty123@%'),
            'estado_usuario' => 1,
            'id_rol' => 3
        ]
        );
    }
}
