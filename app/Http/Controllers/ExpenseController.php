<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class ExpenseController extends Controller
{
    public function index()
    {
        return Inertia::render('Expense/Index', [
            'expenses' => Expense::orderBy('name')->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('Expense/Create', [
            'accounts' => Account::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        FacadesRequest::validate([
            'expense_name' => 'required',
            'expense_total' => 'required',
            'pay_with' => 'required',
        ]);

        $account = Account::where('id', $request->pay_with)->first();

        if($account->balance < floatval($request->expense_total)){
            $request->session()->flash('flash.banner', 'Account balance is low');
            $request->session()->flash('flash.bannerStyle', 'danger');
            return Redirect::route('expenses.create');
        }

        if($account->balance >= floatval($request->expense_total)){
            Expense::create([
                'name' => $request->expense_name,
                'total' => $request->expense_total,
                'account_id' => $request->pay_with,
            ]);

            $account->balance = $account->balance - floatval($request->expense_total);
            $account->save();

            $request->session()->flash('flash.banner', 'Expense added');
            $request->session()->flash('flash.bannerStyle', 'success');
            return Redirect::route('expenses.create');
        }
    }

    public function edit(Expense $expense)
    {
        return Inertia::render('Expense/Edit', [
            'accounts' => Account::orderBy('name')->get(),
            'expense' => [
                'id' => $expense->id,
                'expense_name' => $expense->name,
                'expense_total' => $expense->total,
                'pay_with' => $expense->account_id,
            ],
        ]);
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'expense_name' => 'required',
            'pay_with' => 'required',
        ]);

        $expense->name = $request->expense_name;
        $expense->account_id = $request->pay_with;
        $expense->save();

        $request->session()->flash('flash.banner', 'Expense updated');
        $request->session()->flash('flash.bannerStyle', 'success');
        return Redirect::back();
    }

    public function destroy(Expense $expense, Request $request)
    {
        $account = Account::where('id', $expense->account_id)->first();
        $account->balance = $account->balance + $expense->total;
        $account->save();

        $expense->delete();

        $request->session()->flash('flash.banner', 'expense Deleted');
        $request->session()->flash('flash.bannerStyle', 'success');

        return Redirect::route('expenses');
    }
}
