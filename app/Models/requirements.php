<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirements extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id',
        'belongsTo',
        'drivers_license',
        'walking',
        'hands',
        'standing',
        'talking',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'drivers_license' => 'boolean',
        'walking' => 'boolean',
        'hands' => 'boolean',
        'standing' => 'boolean',
        'talking' => 'boolean',
        'created_at' => 'datetime',
    ];
}
