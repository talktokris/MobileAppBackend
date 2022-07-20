<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Validator;

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




        //Validate data
        $data = $request->only('user_id', 'language_name', 'language_level');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'language_name' => 'required',
            'language_level' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new product
        $language = Member_languages_data::create([
            'user_id' => $request->user_id,
            'language_name' => $request->language_name,
            'language_level' => $request->language_level,
            'status' => 1,
        ]);

        //Product created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Language added successfully',
            'data' => $language
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id=null)
    {
        //Validate data
        $data = $request->only('user_id', 'language_name', 'language_level');

        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'language_name' => 'required',
            'language_level' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, update product
        $language = $Member_languages_data::update([
            'user_id' => $request->user_id,
            'language_name' => $request->language_name,
            'language_level' => $request->language_level,
            'status' => 1
        ]);

        //Product updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Language updated successfully',
            'data' => $language
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member_languages_data $id)
    {
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Language deleted successfully'
        ], Response::HTTP_OK);
    }
}