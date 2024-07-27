<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IncomeTax;

class IncomeTaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incomeTaxes = [
            [
                'tax_period' => '202301',
                'employee_id' => 'EMP-2404-00001',
                'non_taxable_income_id' => '00001',
                'effective_average_tax_rate_category' => 'A',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'gross_income' => 15000000,
                'bonus' => 0,
                'bonus_remark' => null,
                'other_deductions' =>0,
                'other_deductions_remark' =>null,                
                'tax_rate' => 6.00,
                'income_tax_value' => 900000,
                'difference' => 0,
                
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'tax_period' => '202302',
                'employee_id' => 'EMP-2404-00001',
                'non_taxable_income_id' => '00001',
                'effective_average_tax_rate_category' => 'A',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'gross_income' => 15000000,
                'bonus' => 0,
                'bonus_remark' => null,
                'other_deductions' =>0,
                'other_deductions_remark' =>null,                
                'tax_rate' => 6.00,
                'income_tax_value' => 900000,
                'difference' => 0,
                
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'tax_period' => '202303',
                'employee_id' => 'EMP-2404-00001',
                'non_taxable_income_id' => '00001',
                'effective_average_tax_rate_category' => 'A',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'gross_income' => 15000000,
                'bonus' => 0,
                'bonus_remark' => null,
                'other_deductions' =>0,
                'other_deductions_remark' =>null,                
                'tax_rate' => 6.00,
                'income_tax_value' => 900000,
                'difference' => 0,
                
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'tax_period' => '202304',
                'employee_id' => 'EMP-2404-00001',
                'non_taxable_income_id' => '00001',
                'effective_average_tax_rate_category' => 'A',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'gross_income' => 15000000,
                'bonus' => 0,
                'bonus_remark' => null,
                'other_deductions' =>0,
                'other_deductions_remark' =>null,                
                'tax_rate' => 6.00,
                'income_tax_value' => 900000,
                'difference' => 0,
                
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'tax_period' => '202305',
                'employee_id' => 'EMP-2404-00001',
                'non_taxable_income_id' => '00001',
                'effective_average_tax_rate_category' => 'A',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'gross_income' => 15000000,
                'bonus' => 0,
                'bonus_remark' => null,
                'other_deductions' =>0,
                'other_deductions_remark' =>null,                
                'tax_rate' => 6.00,
                'income_tax_value' => 900000,
                'difference' => 0,
                
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'tax_period' => '202306',
                'employee_id' => 'EMP-2404-00001',
                'non_taxable_income_id' => '00001',
                'effective_average_tax_rate_category' => 'A',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'gross_income' => 15000000,
                'bonus' => 0,
                'bonus_remark' => null,
                'other_deductions' =>0,
                'other_deductions_remark' =>null,                
                'tax_rate' => 6.00,
                'income_tax_value' => 900000,
                'difference' => 0,
                
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'tax_period' => '202307',
                'employee_id' => 'EMP-2404-00001',
                'non_taxable_income_id' => '00001',
                'effective_average_tax_rate_category' => 'A',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'gross_income' => 15000000,
                'bonus' => 0,
                'bonus_remark' => null,
                'other_deductions' =>0,
                'other_deductions_remark' =>null,                
                'tax_rate' => 6.00,
                'income_tax_value' => 900000,
                'difference' => 0,
                
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'tax_period' => '202308',
                'employee_id' => 'EMP-2404-00001',
                'non_taxable_income_id' => '00001',
                'effective_average_tax_rate_category' => 'A',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'gross_income' => 15000000,
                'bonus' => 0,
                'bonus_remark' => null,
                'other_deductions' =>0,
                'other_deductions_remark' =>null,                
                'tax_rate' => 6.00,
                'income_tax_value' => 900000,
                'difference' => 0,
                
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'tax_period' => '202309',
                'employee_id' => 'EMP-2404-00001',
                'non_taxable_income_id' => '00001',
                'effective_average_tax_rate_category' => 'A',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'gross_income' => 15000000,
                'bonus' => 0,
                'bonus_remark' => null,
                'other_deductions' =>0,
                'other_deductions_remark' =>null,                
                'tax_rate' => 6.00,
                'income_tax_value' => 900000,
                'difference' => 0,
                
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'tax_period' => '202310',
                'employee_id' => 'EMP-2404-00001',
                'non_taxable_income_id' => '00001',
                'effective_average_tax_rate_category' => 'A',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'gross_income' => 15000000,
                'bonus' => 0,
                'bonus_remark' => null,
                'other_deductions' =>0,
                'other_deductions_remark' =>null,                
                'tax_rate' => 6.00,
                'income_tax_value' => 900000,
                'difference' => 0,
                
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tax_period' => '202311',
                'employee_id' => 'EMP-2404-00001',
                'non_taxable_income_id' => '00001',
                'effective_average_tax_rate_category' => 'A',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'gross_income' => 15000000,
                'bonus' => 0,
                'bonus_remark' => null,
                'other_deductions' =>0,
                'other_deductions_remark' =>null,                
                'tax_rate' => 6.00,
                'income_tax_value' => 900000,
                'difference' => 0,
                
                'created_at' => now(),
                'updated_at' => now()
            ]
            

            ];

            foreach ($incomeTaxes as $taxin) {
                IncomeTax::create($taxin);
            }
    }
}
