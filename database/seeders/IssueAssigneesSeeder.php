<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IssueAssigneesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('issue_assignees')->delete();
        DB::table('issue_assignees')->insert([
            ['assignee_name' => 'Excellent Protection'],
            ['assignee_name' => 'Eng. Hazem Alaa'],
            ['assignee_name' => 'Eng. Ahmed Aboalfadl'],
            ['assignee_name' => 'Eng. Asmaa Abdulrahman'],
            ['assignee_name' => 'Eng. Mohammed Abdulrahman'],
            ['assignee_name' => 'Eng. Mohammed Hamed'],
            ['assignee_name' => 'Eng. Mahmoud Abdelhamed'],
            ['assignee_name' => 'Eng. Moamen El Desoqi'],
            ['assignee_name' => 'Eng. Mohammed Ragab'],
            ['assignee_name' => 'Eng. Hassan Al Atabani'],
            ['assignee_name' => 'Eng. Esraa Diaa'],
            ['assignee_name' => 'Eng. Eman Hendam'],
            ['assignee_name' => 'Eng. Abdullah Magdy'],
            ['assignee_name' => 'Eng. Eman Shahin'],
            ['assignee_name' => 'Eng. Ayman Kamel'],
        ]);
    }
}