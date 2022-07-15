<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_ads_job_specification extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_ads_id',
        'title',
        'status'
    ];


    public function getJobList(){

        return $this->belongsTo(Job_ads_list::class, 'id', 'job_ads_id');

    }
}