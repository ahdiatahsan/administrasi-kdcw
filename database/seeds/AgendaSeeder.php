<?php

use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default record to agendas table
        DB::table('agendas')->insert(
            [
                [
                    'nama' => 'Rapat Pengurus',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nama' => 'Rapat Anggota',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
