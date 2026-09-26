<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Company::create([
            'company_name' => 'コカ・コーラ',
            'street_address' => '東京都渋谷区',
            'representative_name' => 'コカ太郎',
        ]);

        Company::create([
            'company_name' => 'サントリー',
            'street_address' => '東京都港区',
            'representative_name' => 'サントリ次郎',
        ]);

        Company::create([
            'company_name' => 'アサヒ',
            'street_address' => '東京都墨田区',
            'representative_name' => 'アサヒ三郎',
        ]);
    }
}