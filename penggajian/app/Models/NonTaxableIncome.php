<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonTaxableIncome extends Model
{
    //protected $primaryKey = 'non_taxable_income_id';
    use HasFactory;
    protected $primaryKey = 'non_taxable_income_id';

    public $incrementing = false;

    protected $fillable=[
        'non_taxable_income_id',
        'non_taxable_income_status_shortname',
        'non_taxable_income_status_name',
        'effective_average_tax_rate_category',
        'non_taxable_income_status_value'
    ];

    public static function generateNonTaxableIncomeCode()
    {
        $prefix=null;
        // Ambil jumlah data yang sudah ada di bulan dan tahun yang sama
        $count = NonTaxableIncome::All()
                         ->count() + 1;

        // Format urutan dengan 5 digit
        $sequence = sprintf('%05d', $count);

        return $prefix . $sequence;
    }

   
}
