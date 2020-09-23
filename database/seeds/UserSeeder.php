<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default record to users table
        DB::table('users')->insert(
            [ 
                [
                'nama' => 'Administrator',
                'email' => 'admin@kedai.or.id', 
                'password' => bcrypt('12341234'), 
                'jabatan' => 8,
                'kontak' => '08',
                'alamat' => 'BTP Blok.M No.541',
                'noreg' => '001.KD.XVIII.19',
                'status_surat' => 'Kosong',
                'foto' => 'admin.png', 
                'created_at' => now(), 
                'updated_at' => now()
                ],
            ]
        );
    }
}
