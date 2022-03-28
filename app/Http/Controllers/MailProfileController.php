<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailProfile;
use App\Jobs\SendMailJob;
use App\Models\Profile;
use App\Mail\NewEmail;
use Carbon\Carbon;

class MailProfileController extends Controller
{
    public function getMessages(){
        return MailProfile::orderBy('created_at', 'desc')->get();
    }

    public function sendMail(Request $request){
        $email = new MailProfile();
        $email->title = $request->title;
        $email->body = $request->body;
        //$email->save();
        if($request->item == "now") {

            $email->delivered = 'YES';
            $email->send_date = Carbon::now();
            
            //$ids = $request->profiles_ids;
            //$profiles = Profile::whereIn('id', $ids)->get();
            $ids = explode(",", $request->profiles_ids);
            $email->profile_ids = $request->profiles_ids;
            //$ids = explode(",", $request->email);
            $email->save();
            $profiles = Profile::whereIn('id', $ids)->get();
            foreach($profiles as $profile) {
                dispatch(new SendMailJob($profile->email, new NewEmail($profile, $email)));
            }
            return response()->json(['message' => "Email envoyé."], 201);
        } else { 
            $email->profile_ids = $request->profiles_ids;
            $email->date_string = date("Y-m-d H:i", strtotime($request->send_date));
            $email->save();   

            return response()->json(['message' => "Email sera envoyée plus tard."], 201);
        }
        /*$ids = $request->profiles_ids;
        //$members = implode(",", $request->profiles_ids);
        //$profiles = Profile::whereIn('id', $ids)->get();

        $ids = explode(",", $request->profiles_ids);
        $profiles = Profile::whereIn('id', $ids)->get();
        $now = date("Y-m-d H:i", strtotime(Carbon::now()->addHour()));
        return response()->json($now);*/
    }
}
