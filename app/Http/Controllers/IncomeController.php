<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class IncomeController extends Controller
{
    public function index()
    {
        $data['incomes'] = Transaction::with('account')->orderBy('name')->where('transaction_type', 'Income')->where('user_id', Auth::id())->paginate(10);
        return Inertia::render('Income/Index', $data);
    }

    public function create()
    {
        return Inertia::render('Income/Create', [
            'accounts' => Account::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        FacadesRequest::validate([
            'income_name' => 'required',
            'income_total' => 'required',
            'account' => 'required',
        ]);

        Transaction::create([
            'name' => $request->income_name,
            'total' => $request->income_total,
            'account_id' => $request->account,
            'user_id' => Auth::id(),
            'transaction_type' => 'Income',
        ]);

        $account = Account::where('id', $request->account)->first();
        $account->balance = $account->balance + floatval($request->income_total);
        $account->save();

        $request->session()->flash('flash.banner', 'Income added');
        $request->session()->flash('flash.bannerStyle', 'success');
        return Redirect::route('incomes.create');
    }

    public function edit(Transaction $income)
    {
        return Inertia::render('Income/Edit', [
            'accounts' => Account::orderBy('name')->get(),
            'income' => [
                'id' => $income->id,
                'income_name' => $income->name,
                'income_total' => $income->total,
                'account' => $income->account_id,
            ],
        ]);
    }

    public function update(Request $request, Transaction $income)
    {
        $request->validate([
            'income_name' => 'required',
            'account' => 'required',
        ]);

        $income->name = $request->income_name;
        $income->account_id = $request->account;
        $income->save();

        $request->session()->flash('flash.banner', 'Income updated');
        $request->session()->flash('flash.bannerStyle', 'success');
        return Redirect::back();
    }

    public function destroy(Transaction $income, Request $request)
    {
        $account = Account::where('id', $income->account_id)->first();
        $account->balance = $account->balance - $income->total;
        $account->save();

        $income->delete();

        $request->session()->flash('flash.banner', 'Income deleted');
        $request->session()->flash('flash.bannerStyle', 'success');

        return Redirect::route('incomes');
    }
}
