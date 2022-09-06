<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Member_educations_data;
use App\Models\Member_experiences_data;
use App\Models\Member_favorite_job;
use App\Models\Member_job_preferences_data;
use App\Models\Member_languages_data;
use App\Models\Member_skill_data;
use App\Models\Member_tranings_data;
use Intervention\Image\Facades\Image;
//use Validator;

class ResumeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['activeResumeGet']]);
    }


    public function imageUpload(Request $request, $id=null){

      /*  return response()->json([
            'status' => 'error',
            'message' => $request->all(),
        ]);

*/
        $savingPath='assets/images/members';

        if ('POST' === $request->getMethod()){


            if(!$request->hasFile('image_name')) {
                return response()->json(['upload_file_not_found'], 400);
            }



            $data = $request->only('id','image_name');
            $validator = Validator::make($data, [
            'id' => 'required|integer|min:1|max:20',
            'image_name'=>'required|mimes:png,jpg,jpeg|max:8048',

            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            $data = $request->all();

            $imageName = $data['image_name'];

           // $get_id = $next_ID;
            $maxOriginalNameSize=20;
            $ImageNameOrg=$imageName->getClientOriginalName();
            if(strlen($ImageNameOrg) > $maxOriginalNameSize){ $ImageNewNameSet=substr($ImageNameOrg, 0, $maxOriginalNameSize);
                $ImageNewName= $ImageNewNameSet.'.'.$imageName->getClientOriginalExtension();
             }
            else { $ImageNewName = $ImageNameOrg;}// shorting the image name;

            $getImageName= date('Y-m-d-His').'-'.$ImageNewName;

            /* Saving the images Start */

            $thumbImgName='thumb-'.$getImageName;
            $largeImgName='large-'.$getImageName;

            $get_id = $id;

            $newPath= $savingPath.'/'.$get_id;

          if (!file_exists($newPath)) {  mkdir($newPath, 0777, true);  }

            $img = Image::make($imageName)->fit(400, 400, function ($constraint) {
                    $constraint->upsize();
            });

            $img->save($newPath.'/'.$thumbImgName, 60);

            $imageSave = User::where("id", $get_id)->update(["image" => $thumbImgName]);


            return response()->json([
                'status' => 'success',
                'message' => 'Image upload successfully',
                'todo' => $imageSave,
            ]);

        } else {

               return response()->json([
                    'status' => 'error',
                    'message' => 'unauthorized method ',
                ]);

        }



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

    public function basicUpdate(Request $request, $id)
    {
        $data = $request->only('name','profile_type', 'sex', 'dob'.'mobileNo');
        $validator = Validator::make($data, [
            'name' => 'required|string|max:150',
            'profile_type' => 'nullable|string|max:100',
            'sex' => 'nullable|string|max:15',
            'dob' => 'nullable|string|max:25',
            'mobileNo' => 'nullable|integer|min:8|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $todo = User::find($id);
        $todo->name = $request->name;
        $todo->profile_type = $request->profile_type;
        $todo->sex = $request->sex;
        $todo->dob = $request->dob;
        $todo->mobileNo = $request->mobileNo;

        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Basic information updated successfully',
            'todo' => $todo,
        ]);
    }




    public function personalUpdate(Request $request, $id)
    {
        $data = $request->only('nationality', 'countryLiveIn', 'maritalStatus','religion', 'weight', 'height');
        $validator = Validator::make($data, [
            'nationality' => 'required|string|max:150',
            'countryLiveIn' => 'required|string|max:150',
            'maritalStatus' => 'nullable|string|max:60',
            'religion' => 'nullable|string|max:100',
            'weight' => 'nullable|string|max:15',
            'height' => 'nullable|string|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $todo = User::find($id);
        $todo->nationality = $request->nationality;
        $todo->countryLiveIn = $request->countryLiveIn;
        $todo->maritalStatus = $request->maritalStatus;
        $todo->religion = $request->religion;
        $todo->weight = $request->weight;
        $todo->height = $request->height;

        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Personal information updated successfully',
            'todo' => $todo,
        ]);
    }

}
