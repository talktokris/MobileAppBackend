<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Member_tranings_data;

class TraningController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }




    public function store(Request $request)
    {
        $data = $request->only('user_id', 'name', 'org','country','startDate','endDate');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'name' => 'required|string|max:150',
            'org' => 'required|string|max:150',
            'country' => 'required|string|max:150',
            //'startDate' => 'string|max:15',
            //'endDate' => 'string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $todo = Member_tranings_data::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'org' => $request->org,
            'country' => $request->country,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'status' => 1
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Traning created successfully',
            'todo' => $todo,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('user_id', 'name', 'org','country','startDate','endDate');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'name' => 'required|string|max:150',
            'org' => 'required|string|max:150',
            'country' => 'required|string|max:150',
           // 'startDate' => 'string|max:15',
           // 'endDate' => 'string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $todo = Member_tranings_data::find($id);
        $todo->user_id = $request->user_id;
        $todo->name = $request->name;
        $todo->org = $request->org;
        $todo->country = $request->country;
        $todo->startDate = $request->startDate;
        $todo->endDate = $request->endDate;
        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Traning updated successfully',
            'todo' => $todo,
        ]);
    }

    public function destroy($id)
    {
        $todo = Member_tranings_data::find($id);
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Traning deleted successfully',
            'todo' => $todo,
        ]);
    }

}