<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Traits\GeneralTrait ;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Sessions ;
 use App\Models\Sports ;
 use App\Models\Clubs ;
 use App\Models\Plans ;
 use App\Models\Statistics ;
 use App\Models\Matches ;


 class MatchesController extends Controller
 {
      use GeneralTrait ;
     
     public function index($id)
     {
        $data = Matches::find($id); 
         return $this->apiResponse($data, true, null, 200);
         
     }
     public function show()
     {
         $data =  $matches = Matches::get();
         return $this->apiResponse($data, true, null, 200);
       
     }
     public function store(Request $request)
     {
 
         $validator = Validator::make($request->all(),[
            'uuid'=>'string',
            'when'=>'required|string' , 
            'status'=>'required|in:not_started,finished' ,
            'plan'=>'required', 
            'channel'=>'required|string', 
            'round'=>'required|integer' , 
            'play_ground'=>'required|string' , 
            'sessions_id'=>'required|integer', 
            'club1_id'=>'required|integer' , 
            'club2_id'=>'required|integer' , 
         ]);
 
         if ($validator->fails()) {
             return $this->requiredField($validator->errors()->first());
         }
        else{
           
             $data = Matches::create([
                 'uuid'=> Str::uuid(), 
                 'when'=>$request->when , 
                 'status'=>$request->status,
                 'plan'=>$request->plan, 
                 'channel'=>$request->channel, 
                 'round'=>$request->round , 
                 'play_ground'=>$request->play_ground , 
                 'sessions_id'=>$request->sessions_id, 
                 'club1_id'=>$request->club1_id , 
                 'club2_id'=>$request->club2_id , 

     ]);
             
     return $this->apiResponse("Create Done", true, null, 200);
        }
     }
     public function destroy($id)
     {
         $player=Matches::find($id);
         $player->delete();
         return $this->apiResponse($data=Null, true, null, 200);
     }
 
    public function update(Request $request , $id )
     {
      
         $validator = Validator::make($request->all(),[
            'uuid'=>'string',
            'when'=>'required|string' , 
            'status'=>'required|in:not_started,finished' ,
            'plan'=>'required', 
            'channel'=>'required|string', 
            'round'=>'required|integer' , 
            'play_ground'=>'required|string' , 
            'sessions_id'=>'required|integer', 
            'club1_id'=>'required|integer' , 
            'club2_id'=>'required|integer' ,
 
         ]);
 
         if ($validator->fails()) {
             return $this->requiredField($validator->errors()->first());
         }
         else{
             
             $data=$match=Matches::find($id);
             $match->uuid = Str::uuid() ;
             $match->when = $request->when ;
             $match->status = $request->status ;
             $match->plan = $request->plan;
             $match->channel = $request->channel ;
             $match->round = $request->round;
             $match->play_ground = $request->play_ground ;
             $match->sessions_id = $request->sessions_id;
             $match->club1_id = $request->club1_id ;
             $match->club2_id = $request->club2_id ;
             $match->save();
 
             return $this->apiResponse($data, true, null, 200);
 
         }   
     }
 
 }
 
 ?>  