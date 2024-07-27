<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IncomeTax extends Model
{
    use HasFactory;
    protected $primaryKey = ['tax_period', 'employee_id','non_taxable_income_id'];

    public $incrementing = false;
    protected $fillable = [
        'tax_period',
        'employee_id',
        'non_taxable_income_id',
        'effective_average_tax_rate_category',
        'basic_salary',
        'bpjs_health',
        'bpjs_employment',
        'bonus',
        'other_deductions',
        'bonus_remark',
        'other_deductions_remark',
        'gross_income',
        'tax_rate',
        'income_tax_value',
        'difference',
        'is_last_periode'      
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','employee_id');
    }

    public function nonTaxableIncome()
    {
        return $this->belongsTo(NonTaxableIncome::class,'non_taxable_income_id','non_taxable_income_id');
    }

    public static function getIncomeTaxSummary($year, $month)
    {
        return DB::select(
            'Select data.employee_id, data.empname, data.ptkp, data.ptkpval, sum(data.sumgross_income) as sumgross_income,
            sum(data.sumbpjs_health) as sumbpjs_health, sum(data.summbpjs_employment) as summbpjs_employment, sum(data.sumincome_tax_value) as sumincome_tax_value,
            sum(data.sumdeductions) as sumdeductions, data.non_taxable_income_id, data.tercategory, 
            sum(data.basic_salary) as basic_salary, sum(data.bpjs_health) as bpjs_health, sum(data.bpjs_employment) as bpjs_employment, 
            sum(data.gross_income) as gross_income, sum(data.tax_rate) as tax_rate, sum(data.income_tax_value) as income_tax_value
             from(
                SELECT a.employee_id, c.name as empname, b.non_taxable_income_status_shortname as ptkp, b.non_taxable_income_status_value as ptkpval, 
                SUM(a.gross_income) as sumgross_income, SUM(a.bpjs_health) as sumbpjs_health, 
                SUM(a.bpjs_employment) as summbpjs_employment,SUM(a.income_tax_value) as sumincome_tax_value,sum(other_deductions) as sumdeductions,
                b.non_taxable_income_id,b.effective_average_tax_rate_category as tercategory, 0 as basic_salary, 0 as bpjs_health, 0 as bpjs_employment, 0 as gross_income, 0 as tax_rate, 0 as income_tax_value
                FROM income_taxes a 
                LEFT JOIN non_taxable_incomes b ON a.non_taxable_income_id = b.non_taxable_income_id 
                LEFT JOIN employees c ON a.employee_id = c.employee_id 
                WHERE LEFT(a.tax_period, 4) = ? 
                AND a.is_last_period = false
                AND c.is_employee_resign=false
                GROUP BY a.employee_id, c.name, b.non_taxable_income_status_shortname, 
                b.non_taxable_income_status_value,b.non_taxable_income_id, b.effective_average_tax_rate_category
                
                union all
            
                SELECT a.employee_id, c.name as empname, b.non_taxable_income_status_shortname as ptkp, b.non_taxable_income_status_value as ptkpval, 
                a.gross_income as sumgross_income, a.bpjs_health as sumbpjs_health, 
                a.bpjs_employment as summbpjs_employment,0 as sumincome_tax_value,other_deductions as sumdeductions,
                b.non_taxable_income_id,b.effective_average_tax_rate_category as tercategory, a.basic_salary, a.bpjs_health, a.bpjs_employment, a.gross_income, a.tax_rate, a.income_tax_value
                FROM income_taxes a 
                LEFT JOIN non_taxable_incomes b ON a.non_taxable_income_id = b.non_taxable_income_id 
                LEFT JOIN employees c ON a.employee_id = c.employee_id 
                WHERE LEFT(a.tax_period, 4) = ?
                AND RIGHT(a.tax_period, 2) =?
                AND a.is_last_period = false
                AND c.is_employee_resign=false
            ) as data
            group by data.employee_id, data.empname, data.ptkp, data.ptkpval,data.non_taxable_income_id, data.tercategory',
            [$year,$year,$month]
        );
    }
}
