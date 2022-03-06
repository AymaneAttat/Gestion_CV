<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProfilesImport;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Pdf;
use DB;

class ProfilesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index(){
        $this->authorize('viewAny', Profile::class);
        $profiles = Profile::with(['pdf'])->paginate(25);
        return ProfileResource::collection($profiles);
        //if (Auth::user()->isAdmin) {}auth()->user()   pdf
        //return  response()->json(["message" => "Forbidden"], 403);
    }
    
    public function uploadContent(Request $request){
        $this->authorize('create', Profile::class);
        $file = $request->file('uploaded_file');
        if($file){
            config(['excel.import.startRow' => 2]);
            Excel::import(new ProfilesImport, $request->file('uploaded_file')->store('uploads'));
            return response()->json(['message' => "Successfully uploaded"]);
        }else {
            //no file was uploaded ->limit(false, 1)
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Profile $profile){
        $this->authorize('view', Profile::class);
        $pro = Profile::with(['pdf'])->findOrFail($profile->id);
        //$pro->pdf->path;;
        //$cv = Pdf::where('pdfable_id', $pro->id);
        //return new ProfileResource($profile);
        return response()->json($pro);
        //return response()->json(['pro'=> $pro, 'cv'=> $cv], 200);
    }

    public function update(Request $request, Profile $profile){
        //$pro = Profile::findOrFail($profile);with(['pdf'])->
        $this->authorize('update', Profile::class);
        $profile->nom = $request->nom;
        $profile->prenom = $request->prenom;
        $profile->telephone = $request->telephone;
        $profile->email = $request->email;
        $profile->date_debut_experience = $request->date_debut_experience;
        $profile->skill1 =$request->skill1;
        $profile->skill2 =$request->skill2;
        $profile->skill3 =$request->skill3;
        $profile->skill4 =$request->skill4;
        $profile->skill5 =$request->skill5;
        $profile->save();
        return new ProfileResource($profile);
    }

    public function destroy(Profile $profile){
        $this->authorize('delete', Profile::class);
        $profile->delete();
        return response()->noContent();
    }

    /*public function searchProfile($id){
        /*$data = DB::table('profiles')
            ->whereIn('skill1', $request->selectedMembers)
            ->where(function ($query) {
                $query->whereIn('skill2', $request->selectedMembers)
                      ->whereIn('skill3', $request->selectedMembers)
                      ->whereIn('skill4', $request->selectedMembers)
                      ->whereIn('skill5', $request->selectedMembers);
            })->get();
        $members = implode(",", $id);
        $data = DB::table('profiles')->whereIn('skill1', $members)->get();
        return response()->json($data); 
    }*/

    public function searchProfile(Request $request){
        
        //$members = implode(",", $request->select_members);
        $members = $request->select_members;
        /*$profiles = DB::table('profiles')->where('skill1', $members)
        ->orWhere('skill2', $members)->orWhere('skill3', $members)
        ->orWhere('skill4', $members)->orWhere('skill5', $members)->get();*/

        $profiles = DB::table('profiles')->whereIn('skill1', $members)
        ->orWhereIn('skill2', $members)->orWhereIn('skill3', $members)
        ->orWhereIn('skill4', $members)->orWhereIn('skill5', $members)->get();//Success
        
        /*$members = explode(",", $request->select_members);
        $members1 = json_decode( $request->select_members, true );
        foreach($members1 as $member){
            $profile = DB::table('profiles')->whereIn('skill1', $member)->orWhere('skill2', $member)->orWhere('skill3', $member)->orWhere('skill4', $member)->orWhere('skill5', $member)->get();
            $profiles += $profile;
        }*/
        //$profiles = DB::function ($query) use ($prices)
        //return ProfileResource::collection($profiles);
        /*foreach($request->select_members as $members){
            $member = explode(",", $members);
            $profile = DB::table('profiles')->where('skill1', $member)->orWhere('skill2', $member)->orWhere('skill3', $member)->orWhere('skill4', $member)->orWhere('skill5', $member)->get();
            $profiles += $profile; 
        }*/
        return response()->json($profiles);
    }

    public function getCountProfiles(){
        $nbr = Profile::all()->count();
        return response()->json($nbr);
    }

    public function getSearchProfiles(Request $request){
        if(isset($request->keyword)){
            //$profiles = DB::table('profiles')->where('nom', 'LIKE','%'.$request->keyword.'%')->orWhere('prenom', 'LIKE','%'.$request->keyword.'%')->orWhere('email', 'LIKE','%'.$request->keyword.'%')->orWhere('skill1', 'LIKE','%'.$request->keyword.'%')->orWhere('skill2', 'LIKE','%'.$request->keyword.'%')->orWhere('skill3', 'LIKE','%'.$request->keyword.'%')->orWhere('skill4', 'LIKE','%'.$request->keyword.'%')->orWhere('skill5', 'LIKE','%'.$request->keyword.'%')->get();
            $profiles = Profile::with(['pdf'])->where('nom', 'LIKE','%'.$request->keyword.'%')->orWhere('prenom', 'LIKE','%'.$request->keyword.'%')->orWhere('email', 'LIKE','%'.$request->keyword.'%')->orWhere('skill1', 'LIKE','%'.$request->keyword.'%')->orWhere('skill2', 'LIKE','%'.$request->keyword.'%')->orWhere('skill3', 'LIKE','%'.$request->keyword.'%')->orWhere('skill4', 'LIKE','%'.$request->keyword.'%')->orWhere('skill5', 'LIKE','%'.$request->keyword.'%')->get();
            return new ProfileResource($profiles);
        }else{
            $profiles = Profile::with(['pdf'])->paginate(25);
            return ProfileResource::collection($profiles);
        }
        
    }

    public function uploadCV(Request $request){
        $request->validate([
            'file' => 'required|file',
        ]);
        if($request->hasFile('file')){//Upload picture for current Poststore('CV')
            $filenameWithExt = $request->file('file')->getClientOriginalname();
            //$extension = $request->file('file')->getClientOriginalExtension();
            //$fileNameToStore = $filename.'.'.$extension;
            $path = $request->file('file')->storeAs('CV', $filenameWithExt);
            $cv = new Pdf(['path' => $path]); //or $post->image()->save(Image::make(['path' => $path]))
            $profile = Profile::findOrFail($request->id);
            $profile->pdf()->save($cv);
            return response()->json([
                'message' => 'CV uploaded successfully'
            ], 201);
        }
    }

    public function uploadAllCV(Request $request){
        /*if($request->hasFile('pics')){
            $files = $request->file('pics');
            foreach ($files as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $profile = Profile::where('email', $filename);
                if($profile){
                    $path = $request->file('file')->storeAs('CV', $filenameWithExt);
                    $cv = new Pdf(['path' => $path]);
                    $profile->pdf()->save($cv);
                }
                //$path = $file->store($contract->id,'uploads');
            }
            return response()->json([
                'message' => 'Toutes les CV enregistrer avec succes'
            ], 201);
            return response()->json($request->pics);
        }*/

        if($request->hasFile('pics')){
            $files = $request->pics;
            foreach ($files as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $profile = Profile::where('email', $filename)->first();
                /*return response()->json($profile);*/
                if($profile){
                    $path = $file->storeAs('CV', $filenameWithExt);
                    $cv = new Pdf(['path' => $path]);
                    $profile->pdf()->save($cv);
                }
                //$path = $file->store($contract->id,'uploads');
            }
            return response()->json([
                'message' => 'Toutes les CV enregistrer avec succes'
            ], 201);
            /*return response()->json($request->pics);*/
        }
    }
}
