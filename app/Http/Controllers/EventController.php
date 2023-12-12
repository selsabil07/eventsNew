<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventManager;
use App\Http\Controllers\EventManagerController;
use App\Http\Controllers\AdminController;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return response()->json(Event::all());
    }

    public function approvedEvents()
    {
        // Use Eloquent to select events with approved equal to 1
        $approvedEvents = Event::where('approved', 1)->get();

        // You can return the result or perform additional actions
        return response()->json($approvedEvents);
    }

    /**
     * Show the form for creating a new resource.
     */
 
     public function create(Request $request)
     {
         $fields = $request->validate([
             'eventTitle' => 'required|string',
             'country' => 'required|string',
             'sector' => 'required|string',
             'photo' => '',
             'tags' => 'required|string',
             'summary' => 'required|string',
             'description' => 'required|string',
             'startingDate' => 'required|date',
             'endingDate' => 'required|date',
            //  'eventManagerId' => 'required|exists:event_managers,id', // Ensure the existence of the event manager
         ]);
     
         // Create the event with the provided fields
         $event = Event::create([
             'eventTitle' => $fields['eventTitle'],
             'country' => $fields['country'],
             'sector' => $fields['sector'],
             'photo' => $fields['photo'] ?? null,
             'tags' => $fields['tags'],
             'summary' => $fields['summary'],
             'description' => $fields['description'],
             'startingDate' => $fields['startingDate'],
             'endingDate' => $fields['endingDate'],
            //  'EventManager_id' => $fields['eventManagerId'], // Set the event manager ID
         ]);
     
         return response()->json($event, 200);
     }
     
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Event = Event::find($id);
        $EventManager = $Event->EventManager;
        $eventTitle = $Event->eventTitle;
        $country = $Event->country;
        $tags = $Event->tags;
        $sector = $Event->sector;
        $summary = $Event->summary;
        $description = $Event->description;
        $startingDate = $Event->startingDate;
        $endigDate = $Event->endigDate;


        return response()->json($Event);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id , Request $request ){
        $Event = Event::find($id);
        $Event->update($request->all());
        return response()->json($Event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        return Event::destroy($id);
    }

    public function EventCount() {
        $count = Event::count();
        return response()->json($count);
    }

    public function nonApprovedEvents(){
        $nonApprovedEvents = Event::where('approved', 0)->count();
        // You can return the result or perform additional actions
        return response()->json($nonApprovedEvents);
    }

    public function showEvent(){
        $Events = Event::where('approved', 0)->get();
        return response()->json($Events);
    }
}



