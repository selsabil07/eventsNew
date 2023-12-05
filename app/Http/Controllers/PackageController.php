<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Package;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return Package::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string',
            'service' => 'required|array', 
            'price' => 'required|string',
        ]);
        
        $Package = Package::create([
            'title' => $fields['title'],
            'service' => json_encode($fields['service']),
            'price' => $fields['price'],
        ]);
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $Package = Package::find($id);
        $Package->update($request->all());
        return $Package;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       return Package::destroy($id);

    }
}
