<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SkillResource;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\SkillRequest;
use Illuminate\Support\Facades\DB;
use App\Imports\SkillsImport;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Order;

class SkillsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index(){
        $skills = Skill::get();
        //dd($skills);
        return SkillResource::collection($skills);
    }

    public function store(Request $request){
        //$skill = Skill::create($request->validated());
        $skill = new Skill();
        $skill->skill = $request->skill;
        $skill->save();
        return new SkillResource($skill);
    }

    public function uploadContent(Request $request){
        
        $file = $request->file('uploaded_file');
        $filename = $file->getClientOriginalName();
        // Upload file
        //$file->move('uploads', $filename);
        if($file){
            config(['excel.import.startRow' => 2]);
            Excel::import(new SkillsImport, $request->file('uploaded_file')->store('uploads'));
            return response()->json(['message' => "Fichier Excel télécharger avec succès !"]);
        }else {
            //no file was uploaded
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function checkUploadedFileProperties($extension, $fileSize) {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if(in_array(strtolower($extension), $valid_extension)) {
            if($fileSize <= $maxFileSize) {
            }else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        }else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }

    public function getSkills(Request $request)
    {
        if(isset($request->keyword)){
            $data = Skill::where('skill', 'LIKE','%'.$request->keyword.'%')->get();
            return response()->json($data);//return new SkillResource($data);
        }else{
            $skills = Skill::get();
            return response()->json($skills);//return SkillResource::collection($skills);
        }
    }

    public function getCountSkills(){
        $nbrSkills = Skill::all()->count();
        $nbrProfiles = Profile::all()->count();
        $nbrHistoriques = Order::all()->count();
        return response()->json(['nbrSkills' => $nbrSkills, 'nbrProfiles' => $nbrProfiles, 'nbrHistoriques' => $nbrHistoriques]);
    }

    public function update(Request $request, Skill $skill){
        
    }

    public function destroy(Skill $skill){

    }
}
