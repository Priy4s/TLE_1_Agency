<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'position',
        'description',
        'length',
        'hours',
        'minutes',
        'salary',
        'type',
        'location_id',
        'location',
        'image',
        'video',
        'company_id',
        'company',
        'needed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'salary' => 'decimal:2',
        'needed' => 'boolean',
        'created_at' => 'datetime',
    ];
}
