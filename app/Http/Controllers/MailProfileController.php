<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\MailProfile;
use App\Models\Historical;
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
        
        $historical = Historical::create([
            'title' => $request->historiqueTitle, 
            'profile_ids' => $request->profiles_ids, 
            'skills' => $request->competance,
            'user_id' => auth()->user()->id
        ]);//$email->orders()->attach($order);
        
        $email = new MailProfile();
        $email->title = $request->title;
        $email->body = $request->body;
        $email->user_id = auth()->user()->id;
        //$email->save();
        if($request->item == "now") {

            $email->delivered = 'YES';
            $email->send_date = Carbon::now();
            
            //$ids = $request->profiles_ids;
            //$profiles = Profile::whereIn('id', $ids)->get();
            $ids = explode(",", $request->profiles_ids);
            $email->profile_ids = $request->profiles_ids;
            if(isset($request->historiqueTitle)){
                $email->historical_id = $historical->id;
            }
            $email->save();
            
            $profiles = Profile::whereIn('id', $ids)->get();
            $mail = auth()->user()->email;
            /*config([

                'mail.mailers.smtp.host' => 'smtp.gmail.com',
                'mail.mailers.smtp.port' => 587,
                'mail.mailers.smtp.encryption' => 'tls',
                'mail.mailers.smtp.username' => $mail,
                'mail.mailers.smtp.password' => $request->password,
                'mail.from.address' => $mail
    
            ]);*/
            foreach($profiles as $profile) {
                dispatch(new SendMailJob($profile->email, new NewEmail($profile, $email, $email->user->email)));
                $email->profiles()->attach($profile);
            }
            $email->delivered = 'YES';
            $email->save();
            return response()->json(['message' => "Email envoyé."], 201);
        } else { 
            $email->profile_ids = $request->profiles_ids;
            if(isset($historical)){
                $email->historical_id = $historical->id;
            }
            $email->date_string = date("Y-m-d H:i", strtotime($request->send_date));
            $email->save();   

            return response()->json(['message' => "Email sera envoyée plus tard."], 201);
        }
    }
}
