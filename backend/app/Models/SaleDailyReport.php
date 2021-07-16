<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class SaleDailyReport extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'sale_daily_reports';

    protected $fillable = [
        'user_id',
        'report_date',
        'ping_pong_num',
        'meet_num',
        'deal_num',
        'acquisitions_num',
        'sale_time',
        'conscious_point',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getContractRateAttribute()
    {
        return $this->acquisitions_num / $this->ping_pong_num * 100;
    }

    public function getProductivityAttribute()
    {
        return $this->acquisitions_num / $this->sale_time;
    }

    protected $appends = ['contract_rate', 'productivity'];
}
