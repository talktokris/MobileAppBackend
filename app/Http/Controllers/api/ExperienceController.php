<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Member_experiences_data;

class ExperienceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $data = $request->only('user_id', 'post', 'company','country', 'startDate', 'endDate');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'post' => 'required|string|max:150',
            'company' => 'required|string|max:150',
            'country' => 'required|string|max:150',
            'startDate' => 'required|string|max:15',
            'endDate' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $todo = Member_experiences_data::create([
            'user_id' => $request->user_id,
            'post' => $request->post,
            'company' => $request->company,
            'country' => $request->country,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'status' => 1
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Experience created successfully',
            'todo' => $todo,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('user_id', 'post', 'company','country', 'startDate', 'endDate');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'post' => 'required|string|max:150',
            'company' => 'required|string|max:150',
            'country' => 'required|string|max:150',
            'startDate' => 'required|string|max:15',
            'endDate' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $todo = Member_experiences_data::find($id);
        $todo->user_id = $request->user_id;
        $todo->company = $request->company;
        $todo->country = $request->country;
        $todo->startDate = $request->startDate;
        $todo->endDate = $request->endDate;

        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Experience updated successfully',
            'todo' => $todo,
        ]);
    }

    public function destroy($id)
    {
        $todo = Member_experiences_data::find($id);
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Experience deleted successfully',
            'todo' => $todo,
        ]);
    }
}