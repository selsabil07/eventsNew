<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\EventManager;
use App\Models\Admin;
use App\Http\Controllers\EventManagerController;



class AdminController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'AdminName' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if the admin exists
        $admin = Admin::where('AdminName', $fields['AdminName'])->first();

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


    public function pendingEventManager()
{
        $EventManagers = EventManager::where('approved',0)->get();
        return "you are pending";

}
    public function approveEventManager($id) 
    {
        $EventManager = EventManager::find($id);
        if($EventManager)
    {
            $EventManager->approved = 1;
            $EventManager->save();
            return "the event manager approved";
    }
}
    public function rejectEventManager($id) 
    {
        $EventManager = EventManager::find($id);
        if($EventManager)
    {
            $EventManager->approved = 0;
            $EventManager->save();
            return EventManager::destroy($id);
    }
}
//     public function approveEventManager(EventManager $EventManager)
// {
//         $EventManager->status = EventManager::STATUS_APPROVED;
//         $EventManager->save();
//         return 'you are approved';
//         //redirect()->route('admin.pendingEventManagers');
// }





}
