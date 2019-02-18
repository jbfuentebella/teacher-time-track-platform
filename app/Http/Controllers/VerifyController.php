<?php

namespace App\Http\Controllers;

use App\TempAccount;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  $token
     * @return \Illuminate\Http\Response
     */
    public function edit($token)
    {
        Auth::logout();

        $tempAccount = TempAccount::where('verification_token', $token)->first();

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
