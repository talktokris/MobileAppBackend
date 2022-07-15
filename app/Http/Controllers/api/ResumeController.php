<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\Member_educations_data;
use App\Models\Member_experiences_data;
use App\Models\Member_favorite_job;
use App\Models\Member_job_preferences_data;
use App\Models\Member_languages_data;
use App\Models\Member_skill_data;
use App\Models\Member_tranings_data;

class ResumeController extends Controller
{
    //





    public function activeResume(){

        return Member::where('status','=',1)->with('getEducation')->with('getExperiences')->with('getJobPreferences')->with('getTranings')->with('getSkill')->with('getLanguages')->get();
       // return Member::where('status','=',1)->with('getEducation')->get();
    }
}