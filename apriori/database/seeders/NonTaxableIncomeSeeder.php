<?php

namespace Database\Seeders;

use App\Models\NonTaxableIncome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NonTaxableIncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data karyawan
        $nontaxableincomes = [
            [
                'non_taxable_income_id' => '00001',
                'non_taxable_income_status_shortname' => 'TK/0',
                'non_taxable_income_status_name' => 'Tidak Kawin - Tidak Ada Tanggungan',
                'effective_average_tax_rate_category' => 'A',
                'non_taxable_income_status_value' => 54000000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'non_taxable_income_id' => '00002',
                'non_taxable_income_status_shortname' => 'TK/1',
                'non_taxable_income_status_name' => 'Tidak Kawin - Satu Orang Tanggungan',
                'effective_average_tax_rate_category' => 'A',
                'non_taxable_income_status_value' => 58500000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'non_taxable_income_id' => '00003',
                'non_taxable_income_status_shortname' => 'K/0',
                'non_taxable_income_status_name' => 'Kawin - Tidak Ada Tanggungan',
                'effective_average_tax_rate_category' => 'A',
                'non_taxable_income_status_value' => 58500000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'non_taxable_income_id' => '00004',
                'non_taxable_income_status_shortname' => 'TK/2',
                'non_taxable_income_status_name' => 'Tidak Kawin - Dua Orang Tanggungan',
                'effective_average_tax_rate_category' => 'B',
                'non_taxable_income_status_value' => 63000000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'non_taxable_income_id' => '00005',
                'non_taxable_income_status_shortname' => 'TK/3',
                'non_taxable_income_status_name' => 'Tidak Kawin - Tiga Orang Tanggungan',
                'effective_average_tax_rate_category' => 'B',
                'non_taxable_income_status_value' => 67500000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'non_taxable_income_id' => '00006',
                'non_taxable_income_status_shortname' => 'K/1',
                'non_taxable_income_status_name' => 'Kawin - Satu Orang Tanggungan',
                'effective_average_tax_rate_category' => 'B',
                'non_taxable_income_status_value' => 63000000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'non_taxable_income_id' => '00007',
                'non_taxable_income_status_shortname' => 'K/2',
                'non_taxable_income_status_name' => 'Kawin - Dua Orang Tanggungan',
                'effective_average_tax_rate_category' => 'B',
                'non_taxable_income_status_value' => 67500000,
                'created_at' => now(),
                'updated_at' => now()
            ]
            
            // Tambahkan data karyawan lainnya sesuai kebutuhan
        ];

        // Masukkan data karyawan ke dalam tabel
        foreach ($nontaxableincomes as $nti) {
            NonTaxableIncome::create($nti);
        }
    }
}
