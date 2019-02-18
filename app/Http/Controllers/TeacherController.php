<?php

namespace App\Http\Controllers;

use App\Account;
use App\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $latestLog = Account::getLastestLogRecord();
        $isLatestLogClockOut = true;

        if (!empty($latestLog)) {
            $isLatestLogClockOut = (
                $latestLog->status == Log::STATUS_CLOCK_OUT &&
                !empty($latestLog->logout_dt) && 
                !empty($latestLog->logout_time)
            );
        }

        if ($isLatestLogClockOut) {
            $log = new Log();
            $log->save();

            Auth::logout();
            return redirect()->route('clock-success.show', [
                'slug' => $log->slug
            ]);
        }

        session()->flash('error', 'Action Forbidden.');
        return redirect()->route('clock-out.edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $log = Log::where('slug', $slug)->first();

        if (empty($log)) {
            session()->flash('error', 'Opps! No Log Record Found.');
            return redirect()->route('login');
        }

        return view('teacher.success', [
            'log' => $log
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('teacher.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $latestLog = Account::getLastestLogRecord();
        $isLatestLogClockIn = false;

        if (!empty($latestLog)) {
            $isLatestLogClockIn = (
                $latestLog->status == Log::STATUS_CLOCK_IN &&
                empty($latestLog->logout_dt) && 
                empty($latestLog->logout_time)
            );
        }

        if ($isLatestLogClockIn) {
            $latestLog->status = Log::STATUS_CLOCK_OUT;
            $latestLog->logout_dt = date('Y-m-d');
            $latestLog->logout_time = date('H:i:s');
            $latestLog->update();

            Auth::logout();
            return redirect()->route('clock-success.show', [
                'slug' => $latestLog->slug
            ]);
        }

        session()->flash('error', 'Action Forbidden.');
        return redirect()->route('clock-in.create');
    }
}
