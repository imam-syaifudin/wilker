<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Route;
use App\Models\Schedule;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        try {

            $request->validate([
                'schedule_id' => 'required'
            ]);

            $schedule = Schedule::findOrFail((int)$request->schedule_id);

            Route::create([
                'user_id' => auth()->user()->id,
                'schedule_id' => (int)$request->schedule_id,
                'from_place_id' => (int)$request->from_place_id,
                'to_place_id' => (int)$request->to_place_id,

            ]);

            $route = Route::where('schedule_id',(int)$request->schedule_id);

            if ( $route ){
                return response()->json([
                    'message' => 'create success'
                ],200);
            }

        } catch(Exception $error){
            return response()->json([
                'message' => 'Data cannot be processed'
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
    }
}
