<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exposant;

class exposantController extends Controller
{
    public function exposantCount() {
        $count = Exposant::count();
        return response()->json($count);
    }

    public function exposantShow() {
        return response()->json(Exposant::all());
    }
}
