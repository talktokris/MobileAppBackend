<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_ads_list extends Model
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
}