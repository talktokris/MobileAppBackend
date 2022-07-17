<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'email',
        'password',
        'sex',
        'dob',
        'height',
        'weight',
        'nationality',
        'emailStatus',
        'mobileNo',
        'mobileStatus',
        'counryliveIn',
        'profileType',
        'profileTitle',
        'image',
        'status'
    ];



    public function getEducation(){

        return $this->hasMany(Member_educations_data::class, 'member_id', 'id');

    }

    public function getExperiences(){

        return $this->hasMany(Member_experiences_data::class, 'member_id', 'id');

    }

    public function getFavoriteJob(){

        return $this->hasMany(Member_favorite_job::class, 'member_id', 'id');

    }
    public function getJobPreferences(){

        return $this->hasMany(Member_job_preferences_data::class, 'member_id', 'id');

    }
    public function getLanguages(){

        return $this->hasMany(Member_languages_data::class, 'member_id', 'id');

    }
    public function getSkill(){

        return $this->hasMany(Member_skill_data::class, 'member_id', 'id');

    }
    public function getTranings(){

        return $this->hasMany(Member_tranings_data::class, 'member_id', 'id');

    }
    public function getUser(){

        return $this->belongsTo(Member::class, 'id', 'member_id');

    }
    public function getFavFind(){

        return $this->hasMany(Member_favorite_job::class, 'member_id', 'id');

    }
}
