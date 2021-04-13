<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JabatanSeeder::class); //seed tabel jabatans
        $this->call(UserSeeder::class); //seed tabel users
        $this->call(AgendaSeeder::class); //seed tabel agendas
    }
}
