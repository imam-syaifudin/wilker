<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Exception;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('authguard')->except('index','show');
    }

    public function checkToken($token){
        $token = PersonalAccessToken::findToken($token);
        if ( $token == NULL){
            return response()->json([
                'message' => 'Unauthorized user',
                'Response status' => 401
            ],401);
        }
    }

    public function checkAdmin($user){
        if ( $user->role !== 'admin'){
            return response()->json([
                'message' => 'Forbiden Access'
             ],403);
        }
    }
    
    public function index()
    {
        //
        $token = request('token');
        $checktoken = $this->checkToken($token);
        if ( $checktoken == TRUE ){
            return $checktoken;
        }
     

        $place = Place::all();
        
        return response()->json([
            'data' => $place,
            'Response status' => 200 
        ],200);
        
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $token = request('token');
        $checktoken = $this->checkToken($token);
        if ( $checktoken == TRUE ){
            return $checktoken;
        }
        
        $user = PersonalAccessToken::findToken($token)->tokenable;

        try {
            $request->validate([
                'name' => 'required|unique:places',
                'latitude' => 'required',
                'longitude' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'description' => 'required'
            ]);
    
            $place = Place::create([
                'name' => $request->name,
                'latitude' => floatval($request->latitude),
                'longitude' => floatval($request->longitude),
                'image' => $request->file('image')->store('placeImages'),
                'description' => $request->description
            ]);

        
            if ( $place ){
            return response()->json([
                    'message' => 'create success',
                    'Response status' => 200,
                ]);
            } 
        } catch (Exception $error){
            return response()->json([
                'message' => 'Data cannot be processed',
                'Response status' => 422,
            ],422);
        } 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        try {
            $place = Place::findOrFail($id);
            return response()->json([
                'data' => $place,
                'Response status' => 200
            ],200);

        } catch(Exception $error){
            return response()->json([
                'data' => NULL,
                'Response status' => 404
            ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $token = request('token');
        $checktoken = $this->checkToken($token);
        if ( $checktoken == TRUE ){
            return $checktoken;
        }
        
        $user = PersonalAccessToken::findToken($token)->tokenable;

        try {
            $place = Place::findOrFail($id);

            $validated = [
                'name' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'image' => 'image|mimes:png,jpg,jpeg',
                'description' => 'required'
            ];

            if ( $request->name !== $place->name ){
                $validated['name'] = 'required|unique:places';
            }

            
            $request->validate($validated);

        
            if ( empty($request->file('image')) ){
                $image = $place->image;   
            } else {
                Storage::delete($place->image);
                $image = $request->file('image')->store('placeImages');
            }
    
            $place->update([
                'name' => $request->name,
                'latitude' => floatval($request->latitude),
                'longitude' => floatval($request->longitude),
                'image' => $image,
                'description' => $request->description
            ]);

            
    
            if ( $place ){
                return response()->json([
                    'message' => 'update success',
                    'Response status' => 200,
                ]);
            } 
        } catch (Exception $error){
            return response()->json([
                'message' => 'Data cannot be updated',
                'Response status' => 400,
            ],400);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $token = request('token');
        $checktoken = $this->checkToken($token);
        if ( $checktoken == TRUE ){
            return $checktoken;
        }
        
        $user = PersonalAccessToken::findToken($token)->tokenable;
        
        if ( $user->role != 'admin'){
             return response()->json([
                'message' => 'Forbiden Access'
             ],403);
        }
        
        try {
            $place = Place::findOrFail($id);

            Storage::delete($place->image);
            $place->delete();

            return response()->json([
                'message' => 'delete success',
                'Response status' => 200
            ],200);

        } catch(Exception $error){
            return response()->json([
                'message' => 'Data cannot be deleted',
                'Response status' => 400
            ],400);
        }
    }
}
