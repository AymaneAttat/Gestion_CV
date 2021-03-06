<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Validator;
use Hash;

class AuthController extends Controller
{
    use SendsPasswordResetEmails, ResetsPasswords {
        SendsPasswordResetEmails::broker insteadof ResetsPasswords;
        ResetsPasswords::credentials insteadof SendsPasswordResetEmails;
    }

    /**
     * Create a new AuthController instance.  
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'sendPasswordResetLink', 'callResetPassword', 'CreateRolePermission']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->only('email', 'password'), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {// regex:/(.*)@(bitdyne|gmail)\.com/i'
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:3,100',
            'email' => 'required|string|email|max:100|unique:users|ends_with:bitdyne.com,gmail.com',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)],
                    //['password_gmail' => Crypt::encryptString($request->password)],
                    //['role_id' => $request->role_id]
                ));
        $role_id = $request['role_id']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($role_id)) {
            $role_r = Role::where('id', '=', $role_id)->firstOrFail();            
            $user->assignRole($role_r); //Assigning role to user
        }

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json([ 'user' => auth()->user(), 'roles' => auth()->user()->getRoleNames(), 'permissions' => auth()->user()->getPermissionNames()]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'role' => auth()->user()->role_id,
            'expires_in' => auth()->factory()->getTTL(),
            'user' => auth()->user()
        ]);
    }

    /**
     * Send password reset link. 
    */
    public function sendPasswordResetLink(Request $request){
        return $this->sendResetLinkEmail($request);
    }
    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response){
        return response()->json([ 'message' => 'E-mail de r??initialisation du mot de passe envoy??.', 'data' => $response ]);
    }
    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response){
        return response()->json(['message' => "Email n'a pas pu ??tre envoy?? ?? cette adresse e-mail."]);
    }
    /**
     * Handle reset password 
     */
    public function callResetPassword(Request $request){
        return $this->reset($request);
    }
    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password){
        $user->password = Hash::make($password);
        $user->save();
        event(new PasswordReset($user));
    }
    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response){
        return response()->json(['message' => 'Mot de passe r??initialis?? avec succ??s.']);
    }
    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response){
        return response()->json(['message' => '??chec, Token non valide.']);
    }

    /*public function CreateRolePermission(){
        //dd(auth('middleware')->user());
        //$role_r = Role::where('name', '=', 'Administrator')->firstOrFail();
        //$user = $this->userProfile();
        try {
            $user = auth()->user();
            $user->assignRole('Administrator');
            auth()->user()->givePermissionTo(['ajouter_profiles', 'voir_profiles', 'ajouter_CV', 'ajouter_competences', 'ajouter_competence', 'telecharger_cv', 'ajouter_utilisateur']);
            return response()->json(["message" => "Vous Avez access d'administrateur."]);
        } catch (\Throwable $th) {
            return response()->json([$th]);
        }

    }*/
}
