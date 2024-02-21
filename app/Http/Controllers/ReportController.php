<?php

namespace App\Http\Controllers;
use App\Models\Books;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Mail\reportmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Activities;
use App\Models\Notification;

class ReportController extends Controller
{
    
    function index($type,$id){
        $arr=["type"=>'','name'=>'','id'=>$id];
        if($type=="User"){
            $series=User::where('id','=',$id)->get();
            $arr['type']="User";
            $arr['name']=$series['0']['name'];
        }else{
            $series=Books::where('id','=',$id)->get();
            $arr['type']="Book";
            $arr['name']=$series['0']['title'];
        }
      
        return view("reportConsole",['type'=>$arr]);
    }

    function store(Request $request){
        $credentials=$request->validate([
            'type'=>'required',
            'item'=>'required',
            'reason'=>'required',
        ]);
        Report::create([
            'reportee'=>auth()->user()['id'],
            'type'=>$credentials['type'],
            'item'=>$credentials['item'],
            'reason'=>$credentials['reason'],
            'item_id'=>$request['item_id'],
        ]);

        $data=[
            'subject'=>"A ".$credentials['type']." Was Reported",
            'content'=>$credentials['reason'],
            'name'=>$credentials['item'],
           ];
          
          //  Mail::to('okoloemeka37@gmail.com')->send(new reportmail($data));
            //noting activity
            Activities::create([
                'act_id'=>auth()->user()->id,
                'act'=>"Reported A Book"
            ]);
         
           
        if($credentials['type']=="user"){
            return redirect()->route('sortAuth',$request['item_id'])->with(['message'=>"Report Made Successfully"]);
        }elseif($credentials['type']=="book"){
            return redirect()->route('sin',$request['item_id'])->with(['message'=>"Report Made Successfully"]);
        }
        

    }


        function show(){
            $reports=Report::orderby('id','desc')->get();
            return view('admin.reports',['reports'=>$reports]);
        }

        function clear(){
            Report::truncate();
            return redirect()->route('report_show');
        }

        function remove($id){
           $report= Report::find($id);
           $report->delete();
            return response()->json(['message'=>"Report Removed Successfully"]);
        }
}
