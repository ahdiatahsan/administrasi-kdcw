<?php

use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default record to jabatans table
        DB::table('jabatans')->insert(
            [
                [
                'nama' => 'Koordinator DPO',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'DPO',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Koordinator Tim Ahli',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Tim Ahli',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Ketua Umum',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Wakil Ketua 1',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Wakil Ketua 2',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Sekretaris Umum',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Bendahara Umum',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Koordinator Keorganisasian',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Staf Keorganisasian',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Koordinator Public & Relation',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Staf Public & Relation&R',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Koordinator Tools & Properties',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Staf Tools & Properties',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Koordinator Keilmuan',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Koordinator Program',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Staf Program',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Koordinator Network',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Staf Network',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Koordinator Multimedia',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Staf Multimedia',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Koordinator Hardware',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'Staf Hardware',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'All Crew',
                'created_at' => now(),
                'updated_at' => now()
                ],
            ]
        );
    }
}
