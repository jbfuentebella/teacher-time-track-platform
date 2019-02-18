<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\AccountChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AccountChangePasswordController extends Controller
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $account = Account::where('slug', $slug)->first();

        if (empty($account)) {
            session()->flash('error', 'No Record Found.');
            return redirect()->route('accounts.index');
        }

        return view('change-password.edit', ['admin' => $account]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(AccountChangePasswordRequest $request, $slug)
    {
        $validated = $request->validated();

        $account = Account::where('slug', $slug)->first();

        if (empty($account)) {
            session()->flash('error', 'No Record Found.');
            return redirect()->route('accounts.index');
        }

        $account->password = Hash::make($validated['password']);
        $account->update();

        session()->flash('success', 'Account successfully change password.');
        return redirect()->route('admins.edit', ['slug' => $account->slug]);
    }
}
