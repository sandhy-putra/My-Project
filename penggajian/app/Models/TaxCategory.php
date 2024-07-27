<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxCategory extends Model
{
    use HasFactory;
    protected $primaryKey = 'tax_category_id';
    public $incrementing = false;


    protected $fillable = [
        'tax_category_id',
        'min_gross_income',
        'max_gross_income',
        'tax_rate',
        'effective_average_tax_rate_category'
    ];


    public static function getTaxRate($effectiveAverageTaxRate, $grossIncome)
    {
        return self::where('effective_average_tax_rate_category', $effectiveAverageTaxRate)
                    ->where('min_gross_income', '>=', $grossIncome)
                    ->where('max_gross_income', '<=', $grossIncome)
                    ->get();
    }

    public static function generateTaxCategoryCode($tercategory)
    {
        $prefix = $tercategory;
        
        // Ambil jumlah data yang sudah ada di bulan dan tahun yang sama
        $count = TaxCategory::where('effective_average_tax_rate_category', $tercategory)
                         ->count() + 1;

        // Format urutan dengan 4 digit
        $sequence = sprintf('%04d', $count);

        return $prefix . $sequence;
    }
}
