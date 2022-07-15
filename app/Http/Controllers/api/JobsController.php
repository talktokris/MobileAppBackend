<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Job_ads_list;
use App\Models\Job_ads_job_description;
use App\Models\Job_ads_job_specification;

class JobsController extends Controller
{
    //

    public function activeJobList(){

        return Job_ads_list::where('status','=',1)->with('getJobDescription')->with('getJobSpecification')->get();
    }

}