<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index()
    {
        $data['transactions'] = Transaction::with('account')->orderBy('name')
            ->where('user_id', Auth::id())
        ->paginate(10);
        return Inertia::render('Transaction/Index', $data);
    }

    public function create()
    {
        return Inertia::render('Transaction/Create', [
            'types' => TransactionType::get(),
            'accounts' => Account::orderBy('name')->where('user_id', Auth::id())->get(),
        ]);
    }

    public function store(Request $request)
    {
        FacadesRequest::validate([
            'transaction_name' => 'required',
            'transaction_total' => 'required',
            'transaction_type' => 'required',
            'transaction_account' => 'required',
        ]);

        Transaction::create([
            'name' => $request->transaction_name,
            'total' => $request->transaction_total,
            'user_id' => Auth::id(),
            'transaction_type' => $request->transaction_type,
            'account_id' => $request->transaction_account,
        ]);

        $account = Account::where('id', $request->transaction_account)->first();
        $trancationType = TransactionType::where('id', $request->transaction_type)->first()->name;
        if(strtolower($trancationType) == 'income'){
            $account->balance = $account->balance + floatval($request->transaction_total);
        }
        if(strtolower($trancationType) == 'expense'){
            $account->balance = $account->balance - floatval($request->transaction_total);
        }
        $account->save();

        $request->session()->flash('flash.banner', 'Transaction added');
        $request->session()->flash('flash.bannerStyle', 'success');
        return Redirect::route('transactions.create');
    }
}
