<?php

namespace App\Http\Controllers;

use App\Account;
use App\TempAccount;
use App\Http\Requests\RegisterTempAccountRequest;
use App\Http\Requests\AccountUpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController  extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.index', [
            'admins' => Account::where([
                    ['role', '=', Account::ROLE_ADMIN],
                    ['id', '<>', auth()->user()->id]
                ])
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
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
        $tempAccount->role = TempAccount::ROLE_ADMIN;
        $tempAccount->save();

        session()->flash(
            'success', 
            'Account verification has been sent. Please inform the user for further instruction.'
        );
        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $account = Account::where('slug', $slug)->first();

        if (empty($account)) {
            session()->flash('error', 'No Record Found.');
            return redirect()->route('admins.index');
        }

        return view('admins.show', ['admin' => $account]);
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
            return redirect()->route('admins.index');
        }

        return view('admins.edit', ['admin' => $account]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(AccountUpdateRequest $request, $slug)
    {
        $account = Account::where('slug', $slug)->first();

        if (empty($account)) {
            session()->flash('error', 'No Record Found.');
            return redirect()->route('admins.index');
        }

        $validated = $request->validated();

        $account->update($validated);

        session()->flash('success', 'Account successfully updated.');
        return redirect()->route('admins.show', ['slug' => $account->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $account = Account::where('slug', $slug)->first();

        if (empty($account)) {
            session()->flash('error', 'No Record Found.');
            return redirect()->route('admins.index');
        }

        $account->update(['status' => Account::STATUS_INACTIVE]);

        session()->flash('error', 'Account Deactivated.');
        return redirect()->route('admins.index');
    }
}
