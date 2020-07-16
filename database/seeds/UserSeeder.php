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
                'nama' => 'Sekretaris Umum',
                'email' => 'sekum@kedai.or.id', 
                'password' => bcrypt('12341234'), 
                'jabatan' => 8,
                'kontak' => 'Kosong',
                'alamat' => 'BTP Blok.M No.541',
                'noreg' => '001.KD.XVIII.19',
                'status_surat' => 'Kosong',
                'foto' => 'image.png', 
                'created_at' => now(), 
                'updated_at' => now()
                ],
            ]
        );
    }
}
