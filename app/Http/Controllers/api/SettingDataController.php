<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country_list;
use App\Models\Education_list;
use App\Models\Experience_level_list;
use App\Models\Skill_list;
use App\Models\Skill_level_list;
use App\Models\Language_list;
use App\Models\Language_level_list;


class SettingDataController extends Controller
{
    //

    public function countryIndex(){

        return Country_list::where('status','=',1)->get();
    }


    public function educationIndex(){

        return Education_list::where('status','=',1)->get();
    }


    public function experienceIndex(){

        return Experience_level_list::where('status','=',1)->get();
    }


    public function skillIndex(){

        return Skill_list::where('status','=',1)->get();
    }


    public function skillLevelIndex(){

        return Skill_level_list::where('status','=',1)->get();
    }


    public function languageIndex(){

        return Language_list::where('status','=',1)->get();
    }


    public function languageLevelIndex(){

        return Language_level_list::where('status','=',1)->get();
    }


}