<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_ads_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subTitle',
        'vacancies',
        'salleryMin',
        'salleryMax',
        'jobCategory',
        'education',
        'skillRequire',
        'location',
        'date_expire',
        'fav',
        'image',
        'status',

    ];

    public function getJobDescription(){

        return $this->hasMany(Job_ads_job_description::class, 'job_ads_id', 'id');

    }

    public function getJobSpecification(){

        return $this->hasMany(Job_ads_job_specification::class, 'job_ads_id', 'id');

    }

    public function getFavList(){

        return $this->hasMany(Member_favorite_job::class, 'job_ads_id', 'id');

    }


    public function getFavInfo(){

        return $this->hasMany(Member_favorite_job::class, 'job_ads_id', 'id');

    }


}