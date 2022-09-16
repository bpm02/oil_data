<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetroleumWeeklyStocks extends Model
{
    //use HasFactory;
    protected $table = 'petroleum_weekly_stocks';
    public $timestamps = false;

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function units()
    {
        return $this->belongsTo(Unit::class);
    }

}
