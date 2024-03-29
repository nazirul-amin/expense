<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'accounts' => Account::orderBy('name')->where('user_id', Auth::id())->paginate(10),
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
            'user_id' => Auth::id(),
        ]);

        $request->session()->flash('flash.banner', 'Account Created');
        $request->session()->flash('flash.bannerStyle', 'success');
        return Redirect::route('account.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $data['transactions'] = Transaction::with('account')->orderBy('name')
            ->where('account_id', $account->id)
            ->where('user_id', Auth::id())
        ->paginate(10);
        return Inertia::render('Transaction/Index', $data);
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

        $request->session()->flash('flash.banner', 'Account updated');
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

        $request->session()->flash('flash.banner', 'Account deleted');
        $request->session()->flash('flash.bannerStyle', 'success');

        return Redirect::route('accounts');
    }
}
