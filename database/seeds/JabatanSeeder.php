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
                'nama' => 'kord_dpo',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'dpo',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'kord_tim_ahli',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'tim_ahli',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'ketum',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'wk1',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'wk2',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'sekum',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'bendum',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'kord_keorganisasian',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'staff_keorganisasian',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'kord_P&R',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'staff_P&R',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'kord_tools',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'staff_tools',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'kord_keilmuan',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'kord_program',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'staff_program',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'kord_network',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'staff_network',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'kord_multimedia',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'staff_multimedia',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'kord_hardware',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'staff_hardware',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'nama' => 'all_crew',
                'created_at' => now(),
                'updated_at' => now()
                ],
            ]
        );
    }
}
