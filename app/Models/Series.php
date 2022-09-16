<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    // use HasFactory;

    protected $table = 'series';
    public $timestamps = false;
    public $incrementing = false;

    public function petroleum_weekly_stocks()
    {
        return $this->hasOne(PetroleumWeeklyStocks::class, 'series_id', 'id');
    }
}
