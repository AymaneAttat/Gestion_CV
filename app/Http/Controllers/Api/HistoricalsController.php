<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\HistoricalResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MailProfile;
use App\Models\Profile;
use App\Models\Historical;
use App\Models\User;
use DB;

class HistoricalsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index(){
        $historicals = Historical::with(['mailProfiles','mailProfiles.profiles','user'])->orderBy('created_at', 'desc')->paginate(6);
        return response()->json($historicals);
    }

    public function getSearchHistoriques(Request $request){
        if(isset($request->keyword)){
            $historicals = Historical::with(['mailProfiles','mailProfiles.profiles','user'])->where('title', 'LIKE','%'.$request->keyword.'%')->orWhere('skills', 'LIKE','%'.$request->keyword.'%')->get();
            //return response()->json($historicals);
            return new HistoricalResource($historicals);
        }else{
            $historicals = Historical::with(['mailProfiles','mailProfiles.profiles','user'])->orderBy('created_at', 'desc')->paginate(6);
            //return response()->json($orders);
            return HistoricalResource::collection($historicals);
        }
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'profiles_ids' => 'required',
            'competance' => 'required',
        ]);
        $title = $request->title;
        $profile_ids = $request->profiles_ids;
        $skills = $request->competance;
        $email = MailProfile::where('profile_ids', $profile_ids)->first('id');
        //$email_id = $email->id;

        $historical = new Historical();
        $historical->title = $title;
        $historical->profile_ids = $profile_ids;
        $historical->skills = $skills;
        $historical->email_id = $email->id;
        $historical->save(); 
        /*Order::create([
            'title' => $title, 
            'profile_ids' => $request->profiles_ids, 
            'skills' => $skills, 
            'email_id' => $email_id,
        ]);*/
        return response()->json(['title' => $title, 'profile_ids' => $profile_ids, 'skills' => $skills, 'email_id' => $email_id]);
    }
}
