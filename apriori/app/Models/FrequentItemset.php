<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrequentItemset extends Model
{
    use HasFactory;
 //   protected $primaryKey = 'period';

    protected $fillable = ['itemset', 'support_count','period'];
}
