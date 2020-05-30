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
                'password' => bcrypt('123123'), 
                'jabatan' => 8,
                'kontak' => 'Kosong',
                'noreg' => '001.KD.XVII.19',
                'status_surat' => null,
                'foto' => null, 
                'created_at' => now(), 
                'updated_at' => now()
                ],
            ]
        );
    }
}
