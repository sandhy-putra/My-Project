<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    use HasFactory;
    protected $primaryKey = 'employee_id';

    public $incrementing = false;

    protected $fillable = [
        'employee_id',
        'name',
        'id_card_number',
        'join_date',
        'birthdate',
        'tax_identification_number',
        'non_taxable_income_id',
        'is_employee_resign',
        'basic_salary',
        'bpjs_health',
        'bpjs_employment'
    ];

    public function nonTaxableIncome()
    {
        return $this->belongsTo(NonTaxableIncome::class,'non_taxable_income_id','non_taxable_income_id');
    }

    public static function getEmployees()
    {
        return self::where('is_employee_resign', false)->get();
    }

    public static function generateEmployeeCode($joindate)
    {
        $prefix = 'EMP';
        $date = Carbon::parse($joindate);
        $yearMonth = $date->format('ym'); // Format tahun dan bulan dari tanggal bergabung

        // Ambil jumlah karyawan yang sudah ada di bulan dan tahun yang sama
        $count = Employee::whereYear('join_date', $date->year)
                         ->whereMonth('join_date', $date->month)
                         ->count() + 1;

        // Format urutan dengan 5 digit
        $sequence = sprintf('%05d', $count);

        return $prefix . '-' . $yearMonth . '-' . $sequence;
    }
}
