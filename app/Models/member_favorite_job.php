<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member_favorite_job extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'job_ads_id',
        'status',
    ];

    public function getMemberInfo(){

        return $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function getFavList(){

        return $this->belongsTo(Job_ads_list::class, 'job_ads_id', 'id');

    }


    public function getFavLists(){

        return $this->hasMany(User::class, 'id', 'user_id');

    }





    public function getFavJobDescription(){

        return $this->hasMany(Job_ads_job_description::class, 'job_ads_id', 'job_ads_id');

    }

    public function getFavJobSpecification(){

        return $this->hasMany(Job_ads_job_specification::class, 'job_ads_id', 'job_ads_id');

    }

}
