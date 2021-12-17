<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\dignoses;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    static $token = "";
    public function index(){

        $res = Http::get('https://sandbox-healthservice.priaid.ch/symptoms?token='.'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImJpZ2RhZGR5MjAzMEBnbWFpbC5jb20iLCJyb2xlIjoiVXNlciIsImh0dHA6Ly9zY2hlbWFzLnhtbHNvYXAub3JnL3dzLzIwMDUvMDUvaWRlbnRpdHkvY2xhaW1zL3NpZCI6IjEwMDUwIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy92ZXJzaW9uIjoiMjAwIiwiaHR0cDovL2V4YW1wbGUub3JnL2NsYWltcy9saW1pdCI6Ijk5OTk5OTk5OSIsImh0dHA6Ly9leGFtcGxlLm9yZy9jbGFpbXMvbWVtYmVyc2hpcCI6IlByZW1pdW0iLCJodHRwOi8vZXhhbXBsZS5vcmcvY2xhaW1zL2xhbmd1YWdlIjoiZW4tZ2IiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL2V4cGlyYXRpb24iOiIyMDk5LTEyLTMxIiwiaHR0cDovL2V4YW1wbGUub3JnL2NsYWltcy9tZW1iZXJzaGlwc3RhcnQiOiIyMDIxLTEyLTE2IiwiaXNzIjoiaHR0cHM6Ly9zYW5kYm94LWF1dGhzZXJ2aWNlLnByaWFpZC5jaCIsImF1ZCI6Imh0dHBzOi8vaGVhbHRoc2VydmljZS5wcmlhaWQuY2giLCJleHAiOjE2Mzk3NjExODUsIm5iZiI6MTYzOTc1Mzk4NX0.SxvxH_1rjRtJ1FE89haZpGG2o6A0NbGpXkeSZIkmSCk'.'&format=json&language=en-gb');
        $res_json = $res->json();
        return view('welcome')->with('symtoms', $res_json);
    }
    public function GetToken(){
        return "";
   }
    public function GetDiagnosis(Request $request){
        $res = Http::get('https://sandbox-healthservice.priaid.ch/diagnosis', [
            'symptoms' => "[".$request->get('sym')."]",
            'gender' => $request->get('gender'),
            'year_of_birth' => $request->get('year'),
            'format' =>'json',
            'language' =>'en-gb',
            'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImJpZ2RhZGR5MjAzMEBnbWFpbC5jb20iLCJyb2xlIjoiVXNlciIsImh0dHA6Ly9zY2hlbWFzLnhtbHNvYXAub3JnL3dzLzIwMDUvMDUvaWRlbnRpdHkvY2xhaW1zL3NpZCI6IjEwMDUwIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy92ZXJzaW9uIjoiMjAwIiwiaHR0cDovL2V4YW1wbGUub3JnL2NsYWltcy9saW1pdCI6Ijk5OTk5OTk5OSIsImh0dHA6Ly9leGFtcGxlLm9yZy9jbGFpbXMvbWVtYmVyc2hpcCI6IlByZW1pdW0iLCJodHRwOi8vZXhhbXBsZS5vcmcvY2xhaW1zL2xhbmd1YWdlIjoiZW4tZ2IiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL2V4cGlyYXRpb24iOiIyMDk5LTEyLTMxIiwiaHR0cDovL2V4YW1wbGUub3JnL2NsYWltcy9tZW1iZXJzaGlwc3RhcnQiOiIyMDIxLTEyLTE2IiwiaXNzIjoiaHR0cHM6Ly9zYW5kYm94LWF1dGhzZXJ2aWNlLnByaWFpZC5jaCIsImF1ZCI6Imh0dHBzOi8vaGVhbHRoc2VydmljZS5wcmlhaWQuY2giLCJleHAiOjE2Mzk3NjExODUsIm5iZiI6MTYzOTc1Mzk4NX0.SxvxH_1rjRtJ1FE89haZpGG2o6A0NbGpXkeSZIkmSCk',
        ]);
        $res_json = $res->json();
        return view('diagnosis')->with('diagnosis', $res_json);
        //dd($res_json[0]['Issue']['ID']);
        //dd($res_json);
    }

    public function MarkDiagnosis($id,$status){
        $count = DB::table('dignoses')
        ->where('diagnosis_id', $id)
        ->count();
        if($count==0){
            //add it to DB for first timne
            dignoses::create([
                'diagnosis_id' => $id,
                'status'=>$status
            ]);
        }
        else{
            //update whatevr is in db
            $diagnoses = dignoses::where('diagnosis_id', $id)->first();

            $diagnoses->status =$status;
            
            $diagnoses->save();
        }
        return view('status')->with('success',"Diagnosis with id ".$id." has been marked as ".$status);
    }
}
