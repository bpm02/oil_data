<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    // use HasFactory;

    protected $table = 'units';
    public $timestamps = false;
    public $incrementing = false;

    public function petroleum_weekly_stocks()
    {
        return $this->hasOne(PetroleumWeeklyStocks::class, 'units_id', 'id');
    }
}
