<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    // use HasFactory;

    protected $table = 'process';
    protected $primaryKey = 'process_id';
    public $timestamps = false;
    public $incrementing = false;

    public function petroleum_weekly_stocks()
    {
        return $this->hasOne(PetroleumWeeklyStocks::class, 'process_id', 'id');
    }
}
