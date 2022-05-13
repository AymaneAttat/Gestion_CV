<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\OrderResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MailProfile;
use App\Models\Profile;
use App\Models\Order;
use App\Models\User;
use DB;

class OrdersController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index(){
        $orders = Order::with(['mailProfiles','mailProfiles.profiles','user'])->orderBy('created_at', 'desc')->paginate(6);
        return response()->json($orders);
    }

    public function getSearchHistoriques(Request $request){
        if(isset($request->keyword)){
            $orders = Order::with(['mailProfiles','mailProfiles.profiles'])->where('title', 'LIKE','%'.$request->keyword.'%')->orWhere('skills', 'LIKE','%'.$request->keyword.'%')->get();
            //return response()->json($orders);
            return new OrderResource($orders);
        }else{
            $orders = Order::with(['mailProfiles','mailProfiles.profiles'])->orderBy('created_at', 'desc')->paginate(6);
            //return response()->json($orders);
            return OrderResource::collection($orders);
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

        $order = new Order();
        $order->title = $title;
        $order->profile_ids = $profile_ids;
        $order->skills = $skills;
        $order->email_id = $email->id;
        $order->save(); 
        /*Order::create([
            'title' => $title, 
            'profile_ids' => $request->profiles_ids, 
            'skills' => $skills, 
            'email_id' => $email_id,
        ]);*/
        return response()->json(['title' => $title, 'profile_ids' => $profile_ids, 'skills' => $skills, 'email_id' => $email_id]);
    }
}
