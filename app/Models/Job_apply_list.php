<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_apply_list extends Model
{
    use HasFactory;


 protected $fillable = [
        'user_id',
        'job_ads_id',
        'responce_status',
        'status',

    ];

    public function getApplyIdInfo(){

        return $this->belongsTo(User::class, 'user_id', 'id');

    }


    public function getAdsApplyInfo(){

        return $this->belongsTo(Job_ads_list::class, 'job_ads_id', 'id');

    }


}