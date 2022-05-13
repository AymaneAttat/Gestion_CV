<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\MailProfile;
use App\Jobs\SendMailJob;
use App\Models\Profile;
use App\Mail\NewEmail;
use App\Models\Order;
use Carbon\Carbon;

class MailProfileController extends Controller
{
    public function getMessages(){
        return MailProfile::orderBy('created_at', 'desc')->get();
    }

    public function sendMail(Request $request){
        if(isset($request->orderTitle)){
            $order = Order::create([
                'title' => $request->orderTitle, 
                'profile_ids' => $request->profiles_ids, 
                'skills' => $request->competance,
                'user_id' => auth()->user()->id
            ]);
            //$email->orders()->attach($order);
        }
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
            if(isset($request->orderTitle)){
                $email->order_id = $order->id;
            }
            //$ids = explode(",", $request->email);$request->password
            $email->save();
            //$email->profiles()->attach([$ids]);
            
            $profiles = Profile::whereIn('id', $ids)->get();
            $mail = auth()->user()->email;
            //env('MAIL_USERNAME', $mail);
            //$pass = Crypt::decryptString(auth()->user()->password_gmail);
            //config(['MAIL_USERNAME' => $mail]);
            //env('MAIL_PASSWORD', $pass);
            //config(['MAIL_PASSWORD' => $pass ]);
            config([

                'mail.mailers.smtp.host' => 'smtp.gmail.com',
                'mail.mailers.smtp.port' => 587,
                'mail.mailers.smtp.encryption' => 'tls',
                'mail.mailers.smtp.username' => $mail,
                'mail.mailers.smtp.password' => $request->password,
                'mail.from.address' => $mail
    
            ]);/**/
            foreach($profiles as $profile) {
                dispatch(new SendMailJob($profile->email, new NewEmail($profile, $email)));
                $email->profiles()->attach($profile);
            }
            return response()->json(['message' => "Email envoyé."], 201);
        } else { 
            $email->profile_ids = $request->profiles_ids;
            if(isset($order)){
                $email->order_id = $order->id;
            }
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
