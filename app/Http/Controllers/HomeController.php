<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Session;
use Auth;

class HomeController extends Controller
{
    public function index(){
        if(!Session::has('reportsCount')){
            $factory = new Factory();

            $database = $factory->createDatabase();

            $reference = $database->getReference('pollution-tracker/reports');
        
            $reports = $reference->getValue();

            $counter = 0;
            foreach($reports as $report){
                $all_reports []= $report;
                $counter++;
            }
            session(['reportsCount' => $counter]);
        }

        return view('home');
    }

    public function profile(){
        $user = Auth::user();
        // print($user->id);
        // print($user->name);
        // print($user->email);

        return view('pages.profile',compact('user'));
    }

    public function landing(){
        return view('landing');
    }
}
