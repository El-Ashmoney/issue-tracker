<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueOwnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('issue_owners')->delete();
        DB::table('issue_owners')->insert([
            ['owner_name' => 'Excellent Protection'],
            ['owner_name' => 'Eng. Hazem Alaa'],
            ['owner_name' => 'Eng. Ahmed Aboalfadl'],
            ['owner_name' => 'Eng. Asmaa Abdulrahman'],
            ['owner_name' => 'Eng. Mohammed Abdulrahman'],
            ['owner_name' => 'Eng. Abdulrahman Al Attar'],
            ['owner_name' => 'Eng. Mohammed Hamed'],
            ['owner_name' => 'Eng. Mahmoud Abdelhamed'],
            ['owner_name' => 'Eng. Moamen El Desoqi'],
            ['owner_name' => 'Eng. Mohammed Ragab'],
            ['owner_name' => 'Eng. Hassan Al Atabani'],
            ['owner_name' => 'Eng. Esraa Diaa'],
            ['owner_name' => 'Eng. Eman Hendam'],
            ['owner_name' => 'Mueen'],
            ['owner_name' => 'Sraco'],
            ['owner_name' => 'Tadbeer'],
            ['owner_name' => 'Etanmia'],
            ['owner_name' => 'Eitinaa'],
            ['owner_name' => 'Tamkeen'],
            ['owner_name' => 'Emdad'],
            ['owner_name' => 'HRBS'],
            ['owner_name' => 'RNR'],
        ]);
    }
}
