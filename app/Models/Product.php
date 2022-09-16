<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // use HasFactory;
    protected $table = 'product';
    public $timestamps = false;
    public $incrementing = false;

    public function petroleum_weekly_stocks()
    {
        return $this->hasOne(PetroleumWeeklyStocks::class, 'product_id', 'id');
    }
}
