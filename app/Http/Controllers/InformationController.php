<?php

namespace App\Http\Controllers;

use App\Models\Clubs;
use App\Models\Matches;
use App\Models\Sessions;
use App\Models\Information;
use App\Models\Statistics;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Storage;
use App\Models\Sports;
use App\Http\Traits\GeneralTrait;
use illuminate\Support\Str;
use App\Http\Resources\resourcesinfo;
use Carbon\Carbon;
use App\Http\Traits\FileUploader;
use GrahamCampbell\ResultType\Success;

class InformationController extends Controller
{ use GeneralTrait;
  
    public function store(Request $request)
    { 
      $fileextension=$request->image->getclientoriginalExtension();
      $filename=time().'.'.$fileextension;
      $path='images/information';
      $request->image->move($path,$filename);
      
       // $spor=Sports::find(2);
       // $club=Clubs::find(1);
       /* $session=Sessions::find();
        $match=Matches::find();*/
        $stat=Statistics::find(1);
       
 
         $validato=Validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'image'=>'required|file|mimes:jpg,png,jpeg,jfif',
            'content'=>'required|string',
            'reads'=>'required',
            'type'=>'required|in:stategy,news,regular,slider',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }

   
        
        $info=new Information();
        $info->uuid=Uuid::uuid4();
        $info->title=$request->title;
        $info->image=$filename;
        $info->content=$request->content;
        $info->reads=$request->reads;
        $info->type=$request->type;
        $info->information_able()->associate($stat);
        $info->save();
        return response()->json(['message'=>'successfull']);
    }


    public function index($type)
    {
     $news=Information::with('information_able')->where('type',$type)->get();
    // $data=resourcesinfo::collection($news);
     return $this->apiResponse($news);
    }

 

    public function destore($id)
    {
        $exists=Information::where('id',$id)->delete();
        
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

    public function update(REQUEST $request,$id)
    {
      $fileextension=$request->image->getclientoriginalExtension();
      $filename=time().'.'.$fileextension;
      $path='images/information';
      $request->image->move($path,$filename);
       // $spor=Sports::find(1);
       $stat=Statistics::find(1);
       
 
         $validato=Validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'image'=>'required|file|mimes:jpg,png,jpeg,jfif',
            'content'=>'required|string',
            'reads'=>'required',
            'type'=>'required|in:stategy,news,regular,slider',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }


       
        $info=Information::find($id);
        $info->uuid=Uuid::uuid4();
        $info->title=$request->title;
        $info->image=$filename;
        $info->content=$request->content;
        $info->reads=$request->reads;
        $info->information_able()->associate($stat);
        $info->type='news';
        
        $info->save();
        return response()->json(['message'=>'successfull']);

    }
  
}
