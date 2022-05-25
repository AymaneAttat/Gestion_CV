<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Storage;
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

    public function index(Request $request){
        $this->authorize('viewAny', Profile::class);
        $sort_direction = $request->has('sort_direction') ? $request->input('sort_direction') : 'desc';
        $sort_field = $request->has('sort_field') ? $request->input('sort_field') : 'created_at';
        $profiles = Profile::with(['pdf'])->orderBy($sort_field, $sort_direction)->paginate(25);
        return ProfileResource::collection($profiles);
    }
    
    public function uploadContent(Request $request){
        $this->authorize('create', Profile::class);
        $file = $request->file('uploaded_file');
        if($file){
            config(['excel.import.startRow' => 2]);
            Excel::import(new ProfilesImport, $request->file('uploaded_file')->store('uploads'));
            return response()->json(['message' => "Fichier Excel télécharger avec succès !"]);
        }else {
            //no file was uploaded ->limit(false, 1)
            throw new \Exception(['message' => 'Fichier Excel non téléchargé'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Profile $profile){
        $this->authorize('view', Profile::class);
        $pro = Profile::with(['pdf'])->findOrFail($profile->id);
        return response()->json($pro);
    }

    public function update(Request $request, Profile $profile){
        $this->authorize('update', Profile::class);
        $profile->nom = $request->nom;
        $profile->prenom = $request->prenom;
        $profile->telephone = $request->telephone;
        $profile->email = $request->email;
        $profile->formation = $request->formation;
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

    public function searchProfile(Request $request){
        $members = $request->select_members;
        if(sizeof($members) == 1){
            $profiles = Profile::with(['pdf'])->where('skill1', $members)->orWhere('skill2', $members)->orWhere('skill3', $members)->orWhere('skill4', $members)->orWhere('skill5', $members)->get();
        }elseif (sizeof($members) == 2) {
            $tmp1 = $members[0];
            $tmp2 = $members[1];
            $profiles1 = Profile::with(['pdf'])->where('skill1', $tmp1)->orWhere('skill2', $tmp1)->orWhere('skill3', $tmp1)->orWhere('skill4', $tmp1)->orWhere('skill5', $tmp1)->get();
            $profiles = Profile::with(['pdf'])->where(function($query) use($tmp1) {
                    return $query->where('skill1', $tmp1)->orWhere('skill2', $tmp1)->orWhere('skill3', $tmp1)->orWhere('skill4', $tmp1)->orWhere('skill5', $tmp1);
                })->where(function($query) use($tmp2) {  return $query->where('skill1', $tmp2)->orWhere('skill2', $tmp2)->orWhere('skill3', $tmp2)->orWhere('skill4', $tmp2)->orWhere('skill5', $tmp2);  })->get();/**/
        }elseif (sizeof($members) == 3) {
            $tmp1 = $members[0];
            $tmp2 = $members[1];
            $tmp3 = $members[2];
            $profiles = Profile::with(['pdf'])->where(function($query) use($tmp1) {
                return $query->where('skill1', $tmp1)->orWhere('skill2', $tmp1)->orWhere('skill3', $tmp1)->orWhere('skill4', $tmp1)->orWhere('skill5', $tmp1);
            })->where(function($query) use($tmp2) {  return $query->where('skill1', $tmp2)->orWhere('skill2', $tmp2)->orWhere('skill3', $tmp2)->orWhere('skill4', $tmp2)->orWhere('skill5', $tmp2);  })
            ->where(function($query) use($tmp3) {  return $query->where('skill1', $tmp3)->orWhere('skill2', $tmp3)->orWhere('skill3', $tmp3)->orWhere('skill4', $tmp3)->orWhere('skill5', $tmp3);  })->get();
        }elseif (sizeof($members) == 4) {
            $tmp1 = $members[0];
            $tmp2 = $members[1];
            $tmp3 = $members[2];
            $tmp4 = $members[3];
            $profiles = Profile::with(['pdf'])->where(function($query) use($tmp1) {
                return $query->where('skill1', $tmp1)->orWhere('skill2', $tmp1)->orWhere('skill3', $tmp1)->orWhere('skill4', $tmp1)->orWhere('skill5', $tmp1);
            })->where(function($query) use($tmp2) {  return $query->where('skill1', $tmp2)->orWhere('skill2', $tmp2)->orWhere('skill3', $tmp2)->orWhere('skill4', $tmp2)->orWhere('skill5', $tmp2);  })
            ->where(function($query) use($tmp3) {  return $query->where('skill1', $tmp3)->orWhere('skill2', $tmp3)->orWhere('skill3', $tmp3)->orWhere('skill4', $tmp3)->orWhere('skill5', $tmp3);  })
            ->where(function($query) use($tmp4) {  return $query->where('skill1', $tmp4)->orWhere('skill2', $tmp4)->orWhere('skill3', $tmp4)->orWhere('skill4', $tmp4)->orWhere('skill5', $tmp4);  })->get();
        }elseif (sizeof($members) == 5) {
            $tmp1 = $members[0];
            $tmp2 = $members[1];
            $tmp3 = $members[2];
            $tmp4 = $members[3];
            $tmp5 = $members[4];
            $profiles = Profile::with(['pdf'])->where(function($query) use($tmp1) {
                return $query->where('skill1', $tmp1)->orWhere('skill2', $tmp1)->orWhere('skill3', $tmp1)->orWhere('skill4', $tmp1)->orWhere('skill5', $tmp1);
            })->where(function($query) use($tmp2) {  return $query->where('skill1', $tmp2)->orWhere('skill2', $tmp2)->orWhere('skill3', $tmp2)->orWhere('skill4', $tmp2)->orWhere('skill5', $tmp2);  })
            ->where(function($query) use($tmp3) {  return $query->where('skill1', $tmp3)->orWhere('skill2', $tmp3)->orWhere('skill3', $tmp3)->orWhere('skill4', $tmp3)->orWhere('skill5', $tmp3);  })
            ->where(function($query) use($tmp4) {  return $query->where('skill1', $tmp4)->orWhere('skill2', $tmp4)->orWhere('skill3', $tmp4)->orWhere('skill4', $tmp4)->orWhere('skill5', $tmp4);  })
            ->where(function($query) use($tmp5) {  return $query->where('skill1', $tmp5)->orWhere('skill2', $tmp5)->orWhere('skill3', $tmp5)->orWhere('skill4', $tmp5)->orWhere('skill5', $tmp5);  })->get();
        }else {
            $profiles = Profile::with(['pdf'])->whereIn('skill1', $members)->orWhereIn('skill2', $members)->orWhereIn('skill3', $members)->orWhereIn('skill4', $members)->orWhereIn('skill5', $members)->get();
        }
        return response()->json($profiles);
    }

    public function getCountProfiles(){
        $nbr = Profile::all()->count();
        return response()->json($nbr);
    }

    public function getSearchProfiles(Request $request){
        if(isset($request->keyword)){
            $sort_direction = $request->has('sort_direction') ? $request->input('sort_direction') : 'desc';
            $sort_field = $request->has('sort_field') ? $request->input('sort_field') : 'created_at';
            //$profiles = DB::table('profiles')->where('nom', 'LIKE','%'.$request->keyword.'%')->orWhere('prenom', 'LIKE','%'.$request->keyword.'%')->orWhere('email', 'LIKE','%'.$request->keyword.'%')->orWhere('skill1', 'LIKE','%'.$request->keyword.'%')->orWhere('skill2', 'LIKE','%'.$request->keyword.'%')->orWhere('skill3', 'LIKE','%'.$request->keyword.'%')->orWhere('skill4', 'LIKE','%'.$request->keyword.'%')->orWhere('skill5', 'LIKE','%'.$request->keyword.'%')->get();
            $profiles = Profile::with(['pdf'])->where('nom', 'LIKE','%'.$request->keyword.'%')->orWhere('prenom', 'LIKE','%'.$request->keyword.'%')->orWhere('email', 'LIKE','%'.$request->keyword.'%')->orWhere('skill1', 'LIKE','%'.$request->keyword.'%')->orWhere('skill2', 'LIKE','%'.$request->keyword.'%')->orWhere('skill3', 'LIKE','%'.$request->keyword.'%')->orWhere('skill4', 'LIKE','%'.$request->keyword.'%')->orWhere('skill5', 'LIKE','%'.$request->keyword.'%')->orderBy($sort_field, $sort_direction)->get();
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
        if($request->hasFile('pics')){
            $files = $request->pics;
            $count = 0;
            $save = false;
            foreach ($files as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $profile = Profile::where('email', $filename)->first();
                /*return response()->json($profile);*/
                if(isset($profile->pdf->pdfable_id)){//isset()
                    $count++;
                    //continue;
                    Storage::delete('CV/'. $filenameWithExt);
                    $path = $file->storeAs('CV', $filenameWithExt);
                    $profile->pdf->path = $path;
                    $profile->pdf->save();
                }else{
                    if($profile){
                        $path = $file->storeAs('CV', $filenameWithExt);
                        $cv = new Pdf(['path' => $path]);
                        $profile->pdf()->save($cv);
                        $save = true;
                    }//$path = $file->store($contract->id,'uploads');
                }
            }
            /**/if($count > 0 && $save == true){
                return response()->json(['message' => "Toutes les CV enregistrer avec succes, et ".$count." fichiers ont été mis à jour avec succès."]);
            }
            if($count > 0 && $save == false){
                return response()->json(['message' => "Ces ".$count." CV ont été mis à jour avec succès.", 413]);//throw new \Exception("Toutes ces ".$count." profiles on déja un CV.", 413);
            }
            return response()->json(['message' => 'Toutes les CV enregistrer avec succes'], 201);/*return response()->json($request->pics);*/
        }
    }

    public function downloadCV($id){
        $pdfData = Pdf::findOrFail($id);
        $path = substr($pdfData->path,21);
        $pdfNom = substr($path,12);
        $file = public_path() . $path;
        $headers = [ 'Content-Type' => 'application/pdf', ];
        return response()->download($file, $pdfNom, $headers);
    }
}
