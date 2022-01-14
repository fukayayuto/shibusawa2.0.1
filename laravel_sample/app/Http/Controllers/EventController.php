<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('reserves')->select('id', 'start_date')->get();

            var_dump($data);
            die();
            return response()->json($data);
        }

        return view('/entry/reschedule/index');
    }

  

}
