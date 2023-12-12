<?php

namespace App\Http\Controllers;

use App\Models\EventManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminController;
use Auth;

class EventManagerController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birthday' => 'required|date',
            'gender' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'organization' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            // 'password_confirmation' => 'required|string|min:8',
        ]);
    
        $eventManager = EventManager::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'birthday' => $fields['birthday'],
            'gender' => $fields['gender'],
            'email' => $fields['email'],
            'organization' => $fields['organization'],
            'phone' => $fields['phone'],
            'password' => bcrypt($fields['password']),
            // 'password_confirmation' => bcrypt($fields['password_confirmation']),
            // 'Cpassword' => bcrypt($fields['Cpassword']), // Remove this line, as 'Cpassword' is not part of the EventManager model
        ]);
    
        // Your other logic...
    
        return response()->json(['message' => 'User created successfully']);
    
    
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

    public function index(){
        return EventManager::all();
    }

    public function search($first_name){
        return EventManager::where('first_name', 'like', '%'.$first_name.'%')->get();
    }

    public function destroy($id){
        return EventManager::destroy($id);
    }
    
    public function update(string $id , Request $request ){
        $EventManager = EventManager::find($id);
        $EventManager->update($request->all());
        return response()->json($EventManager);
    }

    public function EventManagerCount() {
        $count = EventManager::count();
        return response()->json($count);
    }

    public function showEventManager(Request $request)
    {
        // Check if a user is authenticated
        $user = $request->user();
    
        if ($user) {
            // Get the currently authenticated user's ID
            $id = $user->id;
    
            // Find the EventManager by ID
            $eventManager = EventManager::find($id);
    
            // You can directly return the user data as JSON
            return response()->json($eventManager);
        } else {
            // If no user is authenticated, return an appropriate response (e.g., error)
            return response()->json(['error' => 'User not authenticated'], 401);
        }
    }

    
        public function upload(Request $request)
        {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $photo = $request->file('photo');
            $path = $photo->store('photos', 'public');
    
            // You can save $path in the database or perform other actions
    
            return back()->with('success', 'Photo uploaded successfully');
        }
    }
    

    

