<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactFileStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'En espera'],
            ['name' => 'Procesando'],
            ['name' => 'Fallido'],
            ['name' => 'Terminado'],
        ];
        DB::table('contact_file_status')->insert($statuses);
    }
}
