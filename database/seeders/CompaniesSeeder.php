<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('issue_assignees')->delete();
        DB::table('companies')->insert([
            ['company_name' => 'Excellent Protection'],
            ['company_name' => 'Sraco'],
            ['company_name' => 'Tadbeer'],
            ['company_name' => 'Mueen'],
            ['company_name' => 'Etanmia'],
            ['company_name' => 'Eitinaa'],
            ['company_name' => 'Tamken'],
            ['company_name' => 'Emdad'],
            ['company_name' => 'HRBS'],
            ['company_name' => 'RNR'],
        ]);
    }
}
