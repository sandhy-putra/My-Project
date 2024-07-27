<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaxableIncomeRate;

class TaxableIncomeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taxIn=[
            ['min_taxable_income'=>0,'max_taxable_income'=>60000000,'taxable_income_rate'=>5],
            ['min_taxable_income'=>60000000,'max_taxable_income'=>250000000,'taxable_income_rate'=>15],
            ['min_taxable_income'=>250000000,'max_taxable_income'=>500000000,'taxable_income_rate'=>25],
            ['min_taxable_income'=>500000000,'max_taxable_income'=>5000000000,'taxable_income_rate'=>30],
            ['min_taxable_income'=>5000000000,'max_taxable_income'=>5000000000,'taxable_income_rate'=>35]
        ];

        // Masukkan data karyawan ke dalam tabel
        foreach ($taxIn as $nti) {
            TaxableIncomeRate::create($nti);
        }
    }
}
