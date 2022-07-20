<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Member_educations_data;
use App\Models\Member_experiences_data;
use App\Models\Member_favorite_job;
use App\Models\Member_job_preferences_data;
use App\Models\Member_languages_data;
use App\Models\Member_skill_data;
use App\Models\Member_tranings_data;
//use Validator;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['activeResumeGet']]);
    }



    public function activeResumePost(Request $request){

       // return "Hi";



        $validatedData = Validator::make($request->all(),[
            'id' => 'required|integer|min:3|max:20',

            ]);

            $id=$request->id;

        return User::where([['id','=',$id],['status','=',1]])->with('getEducation')->with('getExperiences')->with('getJobPreferences')->with('getTranings')->with('getSkill')->with('getLanguages')->get();
       // return Member::where('status','=',1)->with('getEducation')->get();

    }

    public function activeResumeGet(Request $request, $id=null){

/*
        $validatedData = Validator::make($request->all(),[
            'id' => 'required|integer|min:3|max:20',

            ]);

            $id=$request->id;
*/
        return User::where([['id','=',$id],['status','=',1]])->take(1)->get();
      //  return User::where([['id','=',$id],['status','=',1]])->with('getEducation')->with('getExperiences')->with('getJobPreferences')->with('getTranings')->with('getSkill')->with('getLanguages')->take(1)->get();

       // return Member::where('status','=',1)->with('getEducation')->get();
    }
}