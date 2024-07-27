<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxableIncomeRate extends Model
{
    protected $fillable = [
        'min_taxable_income',
        'max_taxable_income',
        'taxable_income_rate'
    ];
}
