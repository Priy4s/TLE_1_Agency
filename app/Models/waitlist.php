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
    protected $table = 'waitlists'; // Custom table name (singular)

    protected $fillable = [
        'job_id',
        'user_id',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
    public function job()
    {
        return $this->belongsTo(JobListing::class, 'job_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
