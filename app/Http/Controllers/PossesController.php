<?php

namespace App\Http\Controllers;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait;
use App\Models\Posses;
use App\Http\Resources\resourcepooses;



use Illuminate\Http\Request;

class PossesController extends Controller
{
  use GeneralTrait;
    public function store(Request $request)
    {

      
        $fileextension=$request->image->getclientoriginalExtension();
        $filename=time().'.'.$fileextension;
        $path='images/wears';
        $request->image->move($path,$filename);
        $meesage=[

        ];
         $validato=Validator::make($request->all(),[
            'name'=>'',
            'statr_tear'=>'',
            'image'=>'',

         ],$meesage);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }

       
        $poss=new Posses();
        $poss->uuid=Uuid::uuid4();
        $poss->name=$request->name;
        $poss->statr_tear=$request->statr_tear;
        $poss->image=$filename;
        $poss->save();
        return response()->json(['status'=>'succss']);

    }
    public function update(REQUEST $request,$id)
    {
        $fileextension=$request->image->getclientoriginalExtension();
        $filename=time().'.'.$fileextension;
        $path='images/wears';
        $request->image->move($path,$filename);

        $meesage=[

        ];
         $validato=Validator::make($request->all(),[
            'name'=>'',
            'statr_tear'=>'',
            'image'=>'',

         ],$meesage);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }

       
        $poss=Posses::find($id);
        $poss->uuid=Uuid::uuid4();
        $poss->name=$request->name;
        $poss->statr_tear=$request->statr_tear;
        $poss->image=$filename;
        $poss->save();
        return response()->json(['status'=>'succss']);

    }
    
    public function destore($id)
    {
        $exists=Posses::where('id',$id)->delete();
        
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
    public function index()
    {

        $sta=Posses::all();
        $data=resourcepooses::collection($sta);
         return $this->apiResponse($data);
        
    }
}
