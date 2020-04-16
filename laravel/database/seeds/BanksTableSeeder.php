<?php

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('banks')->insert([
            'banksName' => 'Ngân Hàng Hàng Hải - MSB'
        ]);
        DB::table('banks')->insert([
            'banksName' => 'Ngân Hàng Công Thương - ViettinBank'
        ]);
        DB::table('banks')->insert([
            'banksName' => 'Ngân Hàng Ngoại Thương - VietcomBank'
        ]);
        // DB::table('banks')->insert([
        //     'banksName' => 'Ngân Hàng Đầu Tư & Phát Triển - BIDV'
        // ]);
        // DB::table('banks')->insert([
        //     'banksName' => 'Ngân Hàng Quân Đội - MB'
        // ]);
        // DB::table('banks')->insert([
        //     'banksName' => 'Ngân Hàng Kỹ Thương - TECHCOMBANK'
        // ]);
        // DB::table('banks')->insert([
        //     'banksName' => 'Ngân Hàng Nông nghiệp và Phát triển Nông thôn - Agribank'
        // ]);
    }
}
