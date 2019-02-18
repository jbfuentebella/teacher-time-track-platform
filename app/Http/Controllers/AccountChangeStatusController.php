<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountChangeStatusController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update($slug)
    {
        $account = Account::where('slug', $slug)->first();

        if (empty($account)) {
            session()->flash('error', 'No Record Found.');
            return redirect()->route('accounts.index');
        }

        $isStatusNotActive = in_array($account->status, [Account::STATUS_INACTIVE, Account::STATUS_LOCKED]);
        $status = $isStatusNotActive ? Account::STATUS_ACTIVE : Account::STATUS_INACTIVE;

        $account->status = $status;
        $account->update();

        if ($account->status == Account::STATUS_ACTIVE) {
            session()->flash('success', 'Admin successfully activated.');
        } else {
            session()->flash('error', 'Admin successfully deactivated.');
        }

        return redirect()->route('admins.show', ['slug' => $account->slug]);
    }
}
