<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member_favorite_job extends Model
{
    use HasFactory;

    protected $fillable = [

        'member_id',
        'job_ads_id',
        'status',
    ];
}