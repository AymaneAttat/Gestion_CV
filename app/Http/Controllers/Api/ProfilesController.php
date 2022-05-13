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
        //if (Auth::user()->isAdmin) {}auth()->user()   pdf
        //return  response()->json(["message" => "Forbidden"], 403);
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
        $profile->formation = $request->formation;
        $profile->date_debut_experience = $request->date_debut_experience;
        $profile->skill1 =$request->skill1;
        $profile->skill2 =$request->skill2;
        $profile->skill3 =$request->skill3;
        $profile->skill4 =$request->skill4;
        $profile->skill5 =$request->skill5;
        //$profile->pdf()->path = file; Storage::delete('CV/'. $filenameWithExt); $path = $file->storeAs('CV', $filenameWithExt); $profile->pdf->path = $path;
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

        /*$profiles = DB::table('profiles')->whereIn('skill1', $members)
        ->orWhereIn('skill2', $members)->orWhereIn('skill3', $members) orWhereIn
        ->orWhereIn('skill4', $members)->orWhereIn('skill5', $members)->get();//Success*/

        //$profiles = Profile::with(['pdf'])->whereIn('skill1', $members)->orWhereIn('skill2', $members)->orWhereIn('skill3', $members)->orWhereIn('skill4', $members)->orWhereIn('skill5', $members)->get();
        
        /*$profiles1 = Profile::with(['pdf'])->whereIn('skill1', $members)->get();
        $profiles2 = Profile::with(['pdf'])->whereIn('skill2', $members)->get();
        $profiles3 = Profile::with(['pdf'])->whereIn('skill3', $members)->get();
        $profiles4 = Profile::with(['pdf'])->whereIn('skill4', $members)->get();
        $profiles5 = Profile::with(['pdf'])->whereIn('skill5', $members)->get();
        $profiles = $profiles2->union($profiles1);*/

        /*$profiles = Profile::with(['pdf'])->where(function($q) use ($members){
            $q->whereIn('skill1', $members)->orWhereIn('skill2', $members)->orWhereIn('skill3', $members)->orWhereIn('skill4', $members)->orWhereIn('skill5', $members);
        })->orWhere(function($q) use ($members){
            $q->whereIn('skill2', $members)->orWhereIn('skill3', $members)->orWhereIn('skill4', $members)->orWhereIn('skill5', $members);
        })->orWhere(function($q) use ($members){
            $q->whereIn('skill3', $members)->orWhereIn('skill4', $members)->orWhereIn('skill5', $members);
        })->orWhere(function($q) use ($members){
            $q->whereIn('skill4', $members)->orWhereIn('skill5', $members);
        })->orWhere(function($q) use ($members){
            $q->whereIn('skill5', $members);
        })->distinct()->get();

        $profiles = Profile::with(['pdf'])->whereIn('skill1', $members)->orWhere(function ($query) use ($members){
            $query->whereIn('skill2', $members)
                  ->whereIn('skill3', $members)
                  ->whereIn('skill4', $members)
                  ->whereIn('skill5', $members);
        })->distinct()->get();*/

        /*$profilesWithSkill = Profile::with(['pdf'])->whereIn('skill1', $members)->orWhereIn('skill2', $members)->orWhereIn('skill3', $members)->orWhereIn('skill4', $members)->orWhereIn('skill5', $members)->get();
        $profiles = $profilesWithSkill->search($members);

        $profiles = $profilesWithSkill->filter(function ($profile, $key) use($members) {
            if (sizeof($members) == 1) {
                return $profile->skill1->intersect($members) || $profile->skill2->intersect($members) || $profile->skill3->intersect($members) || $profile->skill4->intersect($members) || $profile->skill5->intersect($members);
            } else  if(sizeof($members) == 2){
                return ( ($profile->skill1->intersect($members) || $profile->skill2->intersect($members) || $profile->skill3->intersect($members) || $profile->skill4->intersect($members) || $profile->skill5->intersect($members)) && ($profile->skill1->intersect($members) || $profile->skill2->intersect($members) || $profile->skill3->intersect($members) || $profile->skill4->intersect($members) || $profile->skill5->intersect($members)) );
            } else  if(sizeof($members) == 3){
                return ( ($profile->skill1->intersect($members) || $profile->skill2->intersect($members) || $profile->skill3->intersect($members) || $profile->skill4->intersect($members) || $profile->skill5->intersect($members)) && ($profile->skill1->intersect($members) || $profile->skill2->intersect($members) || $profile->skill3->intersect($members) || $profile->skill4->intersect($members) || $profile->skill5->intersect($members)) && ($profile->skill2->intersect($members) || $profile->skill3->intersect($members) || $profile->skill4->intersect($members) || $profile->skill5->intersect($members)) );
            }
        });*/
        if(sizeof($members) == 1){
            $profiles = Profile::with(['pdf'])->where('skill1', $members)->orWhere('skill2', $members)->orWhere('skill3', $members)->orWhere('skill4', $members)->orWhere('skill5', $members)->get();
        }elseif (sizeof($members) == 2) {
            $tmp1 = $members[0];
            $tmp2 = $members[1];
            $profiles1 = Profile::with(['pdf'])->where('skill1', $tmp1)->orWhere('skill2', $tmp1)->orWhere('skill3', $tmp1)->orWhere('skill4', $tmp1)->orWhere('skill5', $tmp1)->get();
            //$profiles2 = Profile::with(['pdf'])->where('skill1', $tmp2)->orWhere('skill2', $tmp2)->orWhere('skill3', $tmp2)->orWhere('skill4', $tmp2)->orWhere('skill5', $tmp2)->get();
            //$profiles = $profiles2->union($profiles1);
            /*$profiles2 = $profiles1->filter(function ($profile, $key) use($tmp2) {
                return $profile->skill1 == $tmp2 || $profile->skill2 == $tmp2 || $profile->skill3 == $tmp2 || $profile->skill4 == $tmp2 || $profile->skill5 == $tmp2;
            });
            $profiles = $profiles2->all();
            $profiles = $profiles1->where(function ($query) use($tmp2) {
                return $query->where('skill1', $tmp2)->orWhere('skill2', $tmp2)->orWhere('skill3', $tmp2)->orWhere('skill4', $tmp2)->orWhere('skill5', $tmp2);
            });*/
            //$profiles = $profiles2->intersectByKeys($profiles1);
            $profiles = Profile::with(['pdf'])->where(function($query) use($tmp1) {
                    return $query->where('skill1', $tmp1)->orWhere('skill2', $tmp1)->orWhere('skill3', $tmp1)->orWhere('skill4', $tmp1)->orWhere('skill5', $tmp1);
                })->where(function($query) use($tmp2) {  return $query->where('skill1', $tmp2)->orWhere('skill2', $tmp2)->orWhere('skill3', $tmp2)->orWhere('skill4', $tmp2)->orWhere('skill5', $tmp2);  })->get();/**/
        }elseif (sizeof($members) == 3) {
            $tmp1 = $members[0];
            $tmp2 = $members[1];
            $tmp3 = $members[2];
            /*$profiles1 = Profile::with(['pdf'])->where('skill1', $tmp1)->orWhere('skill2', $tmp1)->orWhere('skill3', $tmp1)->orWhere('skill4', $tmp1)->orWhere('skill5', $tmp1)->get();
            $profiles2 = Profile::with(['pdf'])->where('skill1', $tmp2)->orWhere('skill2', $tmp2)->orWhere('skill3', $tmp2)->orWhere('skill4', $tmp2)->orWhere('skill5', $tmp2)->get();
            $profiles3 = Profile::with(['pdf'])->where('skill1', $tmp3)->orWhere('skill2', $tmp3)->orWhere('skill3', $tmp3)->orWhere('skill4', $tmp3)->orWhere('skill5', $tmp3)->get();
            $profiles4 = $profiles1->intersectByKeys($profiles2);
            $profiles = $profiles4->intersectByKeys($profiles3);*/

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
        //$profiles = Profile::with(['pdf'])->whereIn(['skill1' => $members, 'skill2' => $members, 'skill3' => $members, 'skill4' => $members, 'skill5' => $members ])->get();
        /*$profiles = $profilesWithSkill->intersectByKeys($members); return $profile->intersectByKeys($members);*/
        /*$members = explode(",", $request->select_members); contains
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

        /*for ($i=0; $i < sizeof($members) ; $i++) {
            $j = 0;
            $tmp1 = Profile::with(['pdf'])->where('skill1', $members[$i])->orWhere('skill2', $members[$i])->orWhere('skill3', $members[$i])->orWhere('skill4', $members[$i])->orWhere('skill5', $members[$i])->get();
            while ($j < sizeof($members) && $j != $i) {
                $tmp2 = Profile::with(['pdf'])->where('skill1', $members[$j])->orWhere('skill2', $members[$j])->orWhere('skill3', $members[$j])->orWhere('skill4', $members[$j])->orWhere('skill5', $members[$j])->get();
                $tmp3 = $tmp1->union($tmp2);
            }
        }*/

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
                /*if($profile){
                    $path = $file->storeAs('CV', $filenameWithExt);
                    $cv = new Pdf(['path' => $path]);
                    $profile->pdf()->save($cv);
                    $save = true;
                }*///$path = $file->store($contract->id,'uploads');
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

    public function downloadCV($id){//Request $request
        /*$pdfData = Pdf::findOrFail($request->id);
        $path = substr($pdfData->path,22);
        $path1 = str_replace("/","\*",$path);
        $path2 = str_replace("*","",$path1);
        //$pdf = public_path('storage/'.$pdfData->path);
        $pdf = public_path($path2);
        return response()->download($pdf);*/
        /*$pdf = public_path($path2);
        return response()->download($pdf);
        $pdf = public_path('storage/CV/3Daissaoui@Gmail.com.pdf');
        return response()->download($pdf);*/

        /*$file = public_path() . "/storage/CV/3Daissaoui@Gmail.com.pdf";
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return response()->download($file, '3Daissaoui@Gmail.com.pdf.pdf', $headers);*/

        $pdfData = Pdf::findOrFail($id);
        $path = substr($pdfData->path,21);
        $pdfNom = substr($path,12);
        $file = public_path() . $path;
        $headers = [ 'Content-Type' => 'application/pdf', ];
        return response()->download($file, $pdfNom, $headers);
        /*$file = public_path() . "/storage/CV/3Daissaoui@Gmail.com.pdf";
        $headers = [
            'Content-Type' => 'application/pdf',
        ];*/
        /*return response()->download($file, '3Daissaoui@Gmail.com.pdf.pdf', $headers);
        return response()->json($pdfNom);*/
    }
}
