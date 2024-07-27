<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;



class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Contoh data karyawan
         $employees = [
            [
                'employee_id' => 'EMP-2404-00001',
                'name' => 'John Doe',
                'id_card_number' => '3204110000000001',
                'join_date' => '2020-01-15',
                'birthdate' => '1990-05-20',
                'tax_identification_number' => '1234567890000001',
                'non_taxable_income_id' => '00001',
                'basic_salary' => 14900000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 'EMP-2404-00002',
                'name' => 'Jane Smith',
                'id_card_number' => '3204110000000001',
                'join_date' => '2020-01-15',
                'birthdate' => '1990-05-20',
                'tax_identification_number' => '1234567890000002',
                'non_taxable_income_id' => '00001',
                'basic_salary' => 20000000,
                'bpjs_health' => 35000,
                'bpjs_employment' => 65000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data karyawan lainnya sesuai kebutuhan
        ];

        // Masukkan data karyawan ke dalam tabel
        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
