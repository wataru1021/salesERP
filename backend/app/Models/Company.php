<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'manager_name',
        'postal_code',
        'prefecture_id',
        'address1',
        'address2',
        'building_name',
        'tel',
        'status',
        'plan_id',
    ];
}
