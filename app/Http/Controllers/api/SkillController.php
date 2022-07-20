<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Member_skill_data;

class SkillController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function store(Request $request)
    {
        $data = $request->only('user_id', 'skillName', 'skill_level');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'skillName' => 'required|string|max:150',
            'skill_level' => 'required|string|max:150',
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }


        $todo = Member_skill_data::create([
            'user_id' => $request->user_id,
            'skillName' => $request->skillName,
            'skill_level' => $request->skill_level,
            'status' => 1
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Skill created successfully',
            'todo' => $todo,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('user_id', 'skillName', 'skill_level');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'skillName' => 'required|string|max:150',
            'skill_level' => 'required|string|max:150',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }


        $todo = Member_skill_data::find($id);
        $todo->user_id = $request->user_id;
        $todo->skillName = $request->skillName;
        $todo->skill_level = $request->skill_level;

        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Skill updated successfully',
            'todo' => $todo,
        ]);
    }

    public function destroy($id)
    {
        $todo = Member_skill_data::find($id);
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Skill deleted successfully',
            'todo' => $todo,
        ]);
    }

}