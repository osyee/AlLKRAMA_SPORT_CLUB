<?php

namespace App\Http\Controllers;
use App\Models\Clubs;
use App\Models\Sessions;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Models\Standings;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait;
use PhpParser\PrettyPrinter\Standard;
use App\Http\Resources\resourcestanding;

class StandingsController extends Controller
{
    use GeneralTrait;
    public function store(Request $request)
    { 

         $mesaage=[
          'Clubs_id'=>'The club is in the rankings',

         ];
         $validato=Validator::make($request->all(),[
            'win'=>'required|numeric|min:0|max:26',
            'lose'=>'required|numeric|min:0|max:26',
            'draw'=>'required|numeric|min:0|max:26',
            'Standings.+/-'=>'required|numeric|min:0|max:75',
            'point'=>'required|numeric|min:0|max:100',
            'play'=>'required|numeric|min:0|max:50',
            'Clubs_id'=>'required|exists:clubs,id|unique:standings,Clubs_id ',
            'sessions_id'=>'required|exists:sessions,id|unique:standings,sessions_id',
         ],$mesaage);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }

        
        $Standing=new Standings();
        $Standing->uuid=Uuid::uuid4();
        $Standing->win=$request->win;
        $Standing->lose=$request->lose;
        $Standing->draw=$request->draw;
        $Standing['+/-']=$request->test;
        $Standing->point=$request->point;
        $Standing->play=$request->play;
        $Standing->Clubs_id=$request->Clubs_id;
        $Standing->sessions_id=$request->sessions_id;
        $Standing->save();
        return response()->json(['message'=>'successfull']);
    }

    public function update(REQUEST $request,$id)
    {
        
       
 
      $mesaage=[
        'Clubs_id'=>'The club is in the rankings',

      ];
         $validato=Validator::make($request->all(),[
            'win'=>'required|numeric|min:0|max:26',
            'lose'=>'required|numeric|min:0|max:26',
            'draw'=>'required|numeric|min:0|max:26',
            'Standings.+/-'=>'required|numeric|min:0|max:75',
            'point'=>'required|numeric|min:0|max:100',
            'play'=>'required|numeric|min:0|max:50',
            'Clubs_id'=>'required|exists:clubs,id|unique:standings,Clubs_id ',
            'sessions_id'=>'required|exists:sessions,id|unique:standings,sessions_id',
         ],$mesaage);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }


     
        $Standing=Standings::find($id);
        $Standing->uuid=Uuid::uuid4();
        $Standing->win=$request->win;
        $Standing->lose=$request->lose;
        $Standing->draw=$request->draw;
        $Standing['+/-']=$request->test;
        $Standing->point=$request->point;
        $Standing->play=$request->play;
        $Standing->Clubs_id=$request->Clubs_id;
        $Standing->sessions_id=$request->sessions_id;
        $Standing->save();
        return response()->json(['message'=>'Success']);

    }

    public function destore($id)
    {
        $exists=Standings::where('id',$id)->delete();
        
      //  $info=Information::find($id);
      //  $exists->delete();
      // return response()->json('successfull');
      if($exists)
      {
        return $this->apiResponse($exists,true);
      }
      else
      {
        return $this->apiResponse($exists,false);
      }

    }
    public function index($session_id)
    {
        $index=Standings::where('sessions_id',$session_id)->orderByDesc('point')->get();
        $data=resourcestanding::collection($index);
        return $this->apiResponse($data);

    }
    
}
