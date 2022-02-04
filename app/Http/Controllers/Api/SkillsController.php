<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SkillResource;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\SkillRequest;
use Illuminate\Support\Facades\DB;
use App\Imports\SkillsImport;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillsController extends Controller
{
    public function index(){
        $skills = Skill::get();
        //dd($skills);
        return SkillResource::collection($skills);
    }

    public function store(SkillRequest $request){

    }

    public function uploadContent(Request $request){
        $file = $request->file('uploaded_file');
        if($file){
            Excel::import(new SkillsImport, $request->file('uploaded_file')->store('uploads'));
            return response()->json(['message' => "Successfully uploaded"]);
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

    public function update(SkillRequest $request, Skill $skill){

    }

    public function destroy(Skill $skill){

    }
}
