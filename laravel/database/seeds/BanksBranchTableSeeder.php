<?php

use Illuminate\Database\Seeder;

class BanksBranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('branch')->insert([
            'banksid' => '1',
            'branchName'=>'Chi nhánh Cầu Giấy'
        ]);
         DB::table('branch')->insert([
            'banksid' => '1',
            'branchName'=>'Chi nhánh Láng Hạ'
        ]);
         DB::table('branch')->insert([
            'banksid' => '1',
            'branchName'=>'Chi nhánh Thanh Xuân'
        ]);
         DB::table('branch')->insert([
            'banksid' => '1',
            'branchName'=>'Chi nhánh Mĩ Đình'
        ]);
         DB::table('branch')->insert([
            'banksid' => '2',
            'branchName'=>'Chi nhánh Cầu Diễn'
        ]);
         DB::table('branch')->insert([
            'banksid' => '2',
            'branchName'=>'Chi nhánh Nguyễn Trãi'
        ]);
         DB::table('branch')->insert([
            'banksid' => '2',
            'branchName'=>'Chi nhánh Hà Đông'
        ]);
         DB::table('branch')->insert([
            'banksid' => '2',
            'branchName'=>'Chi nhánh Cầu Giấy'
        ]);
          DB::table('branch')->insert([
            'banksid' => '3',
            'branchName'=>'Chi nhánh Hai Bà Trưng'
        ]);
          DB::table('branch')->insert([
            'banksid' => '3',
            'branchName'=>'Chi nhánh Cầu Giấy'
        ]);
           DB::table('branch')->insert([
            'banksid' => '3',
            'branchName'=>'Chi nhánh Bà Triệu'
        ]);
           DB::table('branch')->insert([
            'banksid' => '3',
            'branchName'=>'Chi nhánh Thanh Xuân'
        ]);
    }
}
