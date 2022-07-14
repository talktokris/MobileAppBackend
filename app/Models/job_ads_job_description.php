<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_ads_job_description extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_ads_id',
        'title',
        'status'
    ];
}