<?php


namespace App\Http\Controllers;


class MenuController extends Controller
{
    public function index(){
        return view('menu/index');
    }

    public function test(){

        session()->put('test', 'test');

        $test = session()->get('test');

        var_dump($test);
        die();

        return view('menu/index');
    }

    
}
