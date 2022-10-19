<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Place;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
            $schedule = Schedule::all();
            $message = [];

            foreach( $schedule as $jadwal ){
                $message[] = [
                    'kendaraan' => $jadwal->object,
                    'jam berangkat' => $jadwal->departure_time,
                    'jam datang' => $jadwal->arrival_time,
                    'dari' => ( $jadwal->object == 'bus' ? 'Terminal ' : 'Stasiun ') . $jadwal->fromPlace->name,
                    'menuju' => ( $jadwal->object == 'bus' ? 'Terminal ' : 'Stasiun ') . $jadwal->toPlace->name,
                    'jarak tempuh' => $jadwal->distance . ' Km'
                ];
            }

            return response()->json($message);
        }
    }


    public function searchRoute($from_place_id,$to_place_id){
        $token = request('token');
        $checktoken = $this->checkToken($token);
        if ( $checktoken == TRUE ){
            return $checktoken;
        }
        
        try {
                $schedule = Schedule::where('from_place_id',$from_place_id)
                            ->where('to_place_id',$to_place_id)
                            ->paginate(5);
                $sortJadwal = $schedule->sortBy('arrival_time', SORT_NATURAL);
                foreach ( $sortJadwal as $jadwal ){
                    $message[] = [
                        'id' => $jadwal->id,
                        'type' => $jadwal->object,
                        'line' => $jadwal->line,
                        'departure_time' => $jadwal->departure_time,
                        'arival_time' => $jadwal->arrival_time,
                        'travel_time' => $jadwal->speed . " Jam",
                        'from_place' => $jadwal->fromPlace,
                        'to_place' => $jadwal->toPlace
                    ];
                }

                return response()->json([
                    'result' => $schedule->count(),
                    'schedules' => $message
                ],200);
        } catch(Exception $error){
            return response()->json([
                'result' => 0,
                'schedules' => null
            ],404);
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

        $user = PersonalAccessToken::findToken($token)->tokenable;

        if ( $this->checkAdmin($user) == TRUE){
            return $this->checkAdmin($user);
        } 

        $schedule = Schedule::all();

        return response()->json($schedule,200);
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
    public function hitungJarak($lat1,$long1,$lat2,$long2){
        $theta = $long1 - $long2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return round($kilometers,2); 
    }

    public function store(Request $request)
    {
        //
        $token = request('token');
        $checktoken = $this->checkToken($token);
        if ( $checktoken == TRUE ){
            return $checktoken;
        }

        $user = PersonalAccessToken::findToken($token)->tokenable;

        if ( $this->checkAdmin($user) == TRUE){
            return $this->checkAdmin($user);
        } 

        if ( !empty($request->distance ) ){
            return response()->json(['message' => 'Distance harus kosong']);
        }

        try {

            $scheduleValidated = $request->validate([
                'object' => 'required',
                'line' => 'required',
                'from_place_id' => 'required',
                'to_place_id' => 'required',
                'departure_time' => 'required',
                'arrival_time' => 'required',
            ]);

            $fromPlace = Place::where('id',$request->from_place_id)->first();
            $toPlace = Place::where('id',$request->to_place_id)->first();
            
            if ( empty($fromPlace) || empty($toPlace) ) {
                return false;
            }

            $schedule = Schedule::create([
                'object' => $request->object,
                'line' => $request->line,
                'from_place_id' => $request->from_place_id,
                'to_place_id' => $request->to_place_id,
                'departure_time' => $request->departure_time,
                'arrival_time' => $request->arrival_time,
                'distance' => $this->hitungJarak($fromPlace->latitude,$fromPlace->longitude,$toPlace->latitude,$toPlace->longitude),
                'speed' => $request->speed
            ]);
            if ( $schedule ){
                return response()->json(['message' => 'create success'],200);
            }
        } catch(Exception $error){
            return response()->json([
                'message' => 'Data cannot be processed',
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
        $token = request('token');
        $checktoken = $this->checkToken($token);

        $user = PersonalAccessToken::findToken($token)->tokenable;
        
        if ( $checktoken == TRUE ){
            return $checktoken;
        }

        if ( $this->checkAdmin($user) == TRUE){
            return response()->json([
                'message' => 'Unathorized user'
            ],401);

        } 

        try {
            $schedule = Schedule::findOrFail($id);
            $schedule->delete();

            if ( $schedule ){
                return response()->json([
                    'message' => 'delete success'
                ],200);
            }
        } catch(Exception $error){
            return response()->json([
                'message' => 'delete failed'
            ],422);
        }



    }
}
