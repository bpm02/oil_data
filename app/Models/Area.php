<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    // use HasFactory;

    protected $table = 'area';

    public $timestamps = false;
    public $incrementing = false;

    public function petroleum_weekly_stocks()
    {
        return $this->hasMany(PetroleumWeeklyStocks::class, 'area_id', 'id');
    }
}
