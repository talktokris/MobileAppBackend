<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Job_ads_list;
use App\Models\Job_ads_job_description;
use App\Models\Job_ads_job_specification;
use App\Models\Member_favorite_job;

class JobsController extends Controller
{
    //

    public function activeJobList(){

        return Job_ads_list::where('status','=',1)->with('getJobDescription')->with('getJobSpecification')->get();
    }

    public function activeJobSingle($id=null){
      //  return $id;

        return Job_ads_list::where([['status','=',1],['id','=',$id]])->with('getJobDescription')->with('getJobSpecification')->get();
    }

    public function activeJobSearch($word=null){
        //  return $id;

          return Job_ads_list::where([['status','=',1],['title','Like','%'.$word.'%']])->with('getJobDescription')->with('getJobSpecification')->get();
      }

      public function activeJobFav($user_id=null){
        //  return $id;
          return Member_favorite_job::where([['status','=',1],['member_id','=',$user_id]])->with('getFavList')->with('getFavJobDescription')->with('getFavJobSpecification')->get();
      }


}