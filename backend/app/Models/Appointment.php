<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'appointments';

    protected $fillable = [
        'user_id',
        'appointee_name',
        'appointment_address',
        'appointment_date',
        'appointment_time',
        'appointment_memo',
    ];
}
