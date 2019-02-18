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
        return view('registration.create');
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

   /**
     * Show the form for editing the specified resource.
     *
     * @param  $token
     * @return \Illuminate\Http\Response
     */
    public function edit($token)
    {
        $tempAccount = TempAccount::where(['verification_token', $token])->first();

        if (empty($tempAccount)) {
            session()->flash('error', 'Your link looks like broken.');
        } else if (in_array($tempAccount->verification_status, [
            TempAccount::VERIFICATION_DONE, 
            TempAccount::VERIFICATION_VERIFIED
        ])) {
            session()->flash('error', 'Account has already been verified.');
        } else {
            $tempAccount->verification_status = TempAccount::VERIFICATION_VERIFIED;
            $tempAccount->verification_date = date('Y-m-d');
            $tempAccount->update();

            session()->flash('success', 'Your account has successfully verified.');   
        }

        return redirect()->route('login');
    }
}
