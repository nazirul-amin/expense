<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Account/Index', [
            'filters' => FacadesRequest::all('search', 'trashed'),
            'accounts' => Account::orderBy('name')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Account/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FacadesRequest::validate([
            'account_name' => 'required',
            'account_balance' => 'required',
            'account_type' => 'required',
        ]);

        Account::create([
            'name' => $request->account_name,
            'balance' => $request->account_balance,
            'type_id' => $request->account_type,
        ]);

        $request->session()->flash('flash.banner', 'Account Created');
        $request->session()->flash('flash.bannerStyle', 'success');
        return Redirect::route('accounts.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return Inertia::render('Account/Edit', [
            'account' => [
                'id' => $account->id,
                'account_name' => $account->name,
                'account_balance' => $account->balance,
                'account_type' => $account->type_id,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'account_name' => 'required',
            'account_balance' => 'required',
            'account_type' => 'required',
        ]);

        $account->name = $request->account_name;
        $account->balance = $request->account_balance;
        $account->type_id = $request->account_type;
        $account->save();

        $request->session()->flash('flash.banner', 'Account Updated');
        $request->session()->flash('flash.bannerStyle', 'success');
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account, Request $request)
    {
        $account->delete();

        $request->session()->flash('flash.banner', 'Account Deleted');
        $request->session()->flash('flash.bannerStyle', 'success');

        return Redirect::route('accounts');
    }
}
