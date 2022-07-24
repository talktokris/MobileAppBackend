<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;  // jwt auth

//use Laravel\Sanctum\HasApiTokens;

//class User extends Authenticatable // before jwt

class User extends Authenticatable implements JWTSubject
{
   // use HasApiTokens, HasFactory, Notifiable;
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */



    protected $fillable = [
        'role',
        'firstName',
        'middleName',
        'lastName',
        'name',
        'email',
        'device_id',
        'emailStatus',
        'email_verified_at',
        'password',
        'remember_token',
        'sex',
        'dob',
        'height',
        'weight',
        'religion',
        'maritalStatus',
        'nationality',
        'mobileNo',
        'mobileStatus',
        'countryLiveIn',
        'profile_type',
        'image',
        'status',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    ///<============= Krishna Added for API Start==================>

    use Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

       ///<============= Krishna Added for API End==================>


       /// <============= Krishna Relation database Start ====================>



    public function getEducation(){

        return $this->hasMany(Member_educations_data::class, 'user_id', 'id');

    }

    public function getExperiences(){

        return $this->hasMany(Member_experiences_data::class, 'user_id', 'id');

    }

    public function getFavoriteJob(){

        return $this->hasMany(Member_favorite_job::class, 'user_id', 'id');

    }
    public function getJobPreferences(){

        return $this->hasMany(Member_job_preferences_data::class, 'user_id', 'id');

    }
    public function getLanguages(){

        return $this->hasMany(Member_languages_data::class, 'user_id', 'id');

    }
    public function getSkill(){

        return $this->hasMany(Member_skill_data::class, 'user_id', 'id');

    }
    public function getTranings(){

        return $this->hasMany(Member_tranings_data::class, 'user_id', 'id');

    }
    public function getUser(){

        return $this->belongsTo(Member::class, 'id', 'user_id');

    }
    public function getFavFind(){

        return $this->hasMany(Member_favorite_job::class, 'user_id', 'id');

    }

    public function getJobsApply(){

        return $this->hasMany(Job_apply_list::class, 'user_id', 'id');

    }

    public function getPushMessages(){

        return $this->hasMany(Push_message_list::class, 'user_id', 'id');

    }

      /// <============= Krishna Relation database End ====================>
}
