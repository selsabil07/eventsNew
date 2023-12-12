<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\EventManager;
use App\Models\Admin;
use App\Models\Event;
use App\Http\Controllers\EventManagerController;
use App\Http\Controllers\EventController;



class AdminController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'AdminName' => 'required|string',
            'password' => 'required|string',
        ]);

        //Check if the admin exists
        $admin = Admin::where('AdminName', $fields['AdminName'])->first();

        // $admin = Admin::where(AdminName, $request->AdminName)->first();
        // return dd($request->all);
        // Check if the admin exists and password is correct
        if (!$admin || !Hash::check($fields['password'], $admin->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Generate a new token for the admin
        $token = $admin->createToken('apptoken')->plainTextToken;

        $response = [
            'admin' => $admin,
            'token' => $token,
        ];

        return response($response, 201);
    }


    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }


    public function pendingEvent()
{
        $Events = Event::where('approved',0)->get();
        return "your event is pending";

}
    public function approveEvent($id) 
    {
        $Event = Event::find($id);
        if($Event)
    {
            $Event->approved = 1;
            $Event->save();
            return "the event approved";
    }
}
    public function rejectEventManager($id) 
    {
        $Event = Event::find($id);
        if($Event)
    {
            $Event->approved = 0;
            $Event->save();
            return Event::destroy($id);
    }
}
//     public function approveEventManager(EventManager $EventManager)
// {
//         $EventManager->status = EventManager::STATUS_APPROVED;
//         $EventManager->save();
//         return 'you are approved';
//         //redirect()->route('admin.pendingEventManagers');
// }

public function index(){
    return Admin::all();
}
}