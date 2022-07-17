<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member_job_preferences_data extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'industry',
        'function',
        'country',
        'city',
        'type',
        'status'
    ];

    public function getJobsInfo(){

        return $this->belongsTo(Member::class, 'id', 'member_id');

    }
}
