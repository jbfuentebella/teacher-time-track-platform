<?php

namespace App\Http\Controllers;

use App\TempAccount;
use App\Http\Requests\RegisterTempAccountRequest;

use Illuminate\Support\Facades\Hash;

class TeacherRegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterTempAccountRequest $request)
    {
        $validated = $request->validated();
        
        $tempAccount = new TempAccount($validated);
        $tempAccount->password = Hash::make($validated['password']);
        $tempAccount->role = TempAccount::ROLE_TEACHER;
        $tempAccount->save();

        session()->flash(
            'success', 
            'Account verification has been sent. Please login to your email and verify your account.'
        );
        return redirect()->route('login');
    }
}
