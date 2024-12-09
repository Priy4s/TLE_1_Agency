<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waitlist extends Model
{
    use HasFactory;

    /**
     * Specifyy the table name if it's different from the default plural name.
     */
    protected $table = 'waitlist'; // Custom table name (singular)

    protected $fillable = [
        'job_id',
        'user_id',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
