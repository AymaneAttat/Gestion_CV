<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleManager extends Controller
{
    public function index(){
        $permissions = Permission::all(); //Get all permissions
        return response()->json($permissions, 200);
    }

    public function store(Request $request){
        $request->validate([
            'select_permissions' => 'required',
            'user_id' => 'required',
        ]);/**/
        $id = $request->user_id;
        //$select_permissions = $request->select_permissions;
        $select_permissions = explode(",", $request->select_permissions);
        $user = User::findOrFail($id);
        if($user->hasAnyPermission(['ajouter_profiles', 'voir_profiles', 'ajouter_CV', 'ajouter_competences', 'ajouter_competence', 'telecharger_cv', 'ajouter_utilisateur'])){
            $user->syncPermissions([$select_permissions]);
        }else{
            $user->givePermissionTo([$select_permissions]);
        }/**/
        return response()->json(['message' => 'Autorisation modifier avec succès!'], 201);
        //return response()->json($request, 201);
        //return response()->json($select_permissions, 201); ->select_permissions[0]
    }
}
