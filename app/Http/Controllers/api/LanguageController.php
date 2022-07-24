<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Member_languages_data;

class LanguageController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api');
    }




    public function store(Request $request)
    {
        $data = $request->only('user_id', 'language_name', 'language_level');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'language_name' => 'required|string|max:150',
            'language_level' => 'required|string|max:150',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }


        $todo = Member_languages_data::create([
            'user_id' => $request->user_id,
            'language_name' => $request->language_name,
            'language_level' => $request->language_level,
            'status' => 1
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Language created successfully',
            'todo' => $todo,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('user_id', 'language_name', 'language_level');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'language_name' => 'required|string|max:150',
            'language_level' => 'required|string|max:150',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }


        $todo = Member_languages_data::find($id);
        $todo->user_id = $request->user_id;
        $todo->language_name = $request->language_name;
        $todo->language_level = $request->language_level;

        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Language updated successfully',
            'todo' => $todo,
        ]);
    }

    public function destroy($id)
    {
        $todo = Member_languages_data::find($id);
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Language deleted successfully',
            'todo' => $todo,
        ]);
    }

        /*
    public function index()
    {
        $todos = Member_languages_data::all();
        return response()->json([
            'status' => 'success',
            'todos' => $todos,
        ]);
    }

    public function show($id)
    {
        $todo = Member_languages_data::find($id);
        return response()->json([
            'status' => 'success',
            'todo' => $todo,
        ]);
    }
*/
}