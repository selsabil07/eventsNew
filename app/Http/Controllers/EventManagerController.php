<?php

namespace App\Http\Controllers;

use App\Models\EventManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminController;

class EventManagerController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birthday' => 'required|date',
            'gender' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            'Cpassword' => 'required|string'
        ]);

        $EventManager = EventManager::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'birthday' => $fields['birthday'],
            'gender' => $fields['gender'],
            'email' => $fields['email'],
            'approved' => $fields['approved'] ?? '0',
            'phone' => $fields['phone'],
            'password' => bcrypt($fields['password']),
            'Cpassword' => bcrypt($fields['Cpassword'])
        ]);

        $token = $EventManager->createToken('myapptoken')->plainTextToken;

        $response = [
            'EventManager' => $EventManager,
            'token' => $token
        ];

        return redirect()->action('App\Http\Controllers\AdminController@pendingEventManager');
    
            // $EventManager = EventManager::where('status', EventManager::STATUS_PENDING)->get();
            // return ('wait till the your rejistration be approved');

    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $EventManager = EventManager::where('email', $fields['email'])->first();

        // Check password
        if(!$EventManager || !Hash::check($fields['password'], $EventManager->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $EventManager->createToken('myapptoken')->plainTextToken;

        $response = [
            'EventManager' => $EventManager,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->EventManager()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

     /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index(){
        return EventManager::all();
    }

    public function search($first_name){
        return EventManager::where('first_name', 'like', '%'.$first_name.'%')->get();
    }

    public function destroy($id){
        return EventManager::destroy($id);
    }
    
    public function update($id , Request $request ){
        $EventManager = EventManager::find($id);
        $EventManager->update($request->all());
        return $EventManager;
    }

    
}
