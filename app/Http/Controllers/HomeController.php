<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $url = 'admins.index';
        
        if (@auth()->user()->isTeacher()) {
            $latestLogRecord = @auth()->user()->getLogLatestRecordStatus(); 
            $url = 'clock-out.edit';
            
            if (empty($latestLogRecord) || $latestLogRecord == \App\Log::STATUS_CLOCK_OUT) {
                $url = 'clock-in.create';
            }

            return redirect()->route($url);
        } else {
            return redirect()->route($url);
        }

        return view('home');
    }
}
