<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Member_educations_data;

class EducationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }



    public function store(Request $request)
    {
        $data = $request->only('user_id', 'level', 'school','country', 'subject', 'startDate','endDate');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'level' => 'required|string|max:150',
            'school' => 'required|string|max:150',
            'country' => 'required|string|max:150',
            'subject' => 'required|string|max:150',
            'startDate' => 'required|string|max:15',
            'endDate' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $todo = Member_educations_data::create([

            'user_id' => $request->user_id,
            'level' => $request->level,
            'school' => $request->school,
            'country' => $request->country,
            'subject' => $request->subject,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'status' => 1
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Education created successfully',
            'todo' => $todo,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('user_id', 'level', 'school','country', 'subject', 'startDate','endDate');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'level' => 'required|string|max:150',
            'school' => 'required|string|max:150',
            'country' => 'required|string|max:150',
            'subject' => 'required|string|max:150',
            'startDate' => 'required|string|max:15',
            'endDate' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $todo = Member_educations_data::find($id);
        $todo->user_id = $request->user_id;
        $todo->level = $request->level;
        $todo->school = $request->school;
        $todo->country = $request->country;
        $todo->startDate = $request->startDate;
        $todo->endDate = $request->endDate;
        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Education updated successfully',
            'todo' => $todo,
        ]);
    }

    public function destroy($id)
    {
        $todo = Member_educations_data::find($id);
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Education deleted successfully',
            'todo' => $todo,
        ]);
    }
}