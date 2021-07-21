<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'order_num',
       
    ];
}
