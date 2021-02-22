<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense = Expense::with('account')->get()->toArray();
        return array_reverse($expense);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account = Account::where('id', $request->expense['account_id'])->first();

        if($account->balance < floatval($request->expense['total'])){
            return response()->json('The account balance is low');
        }

        if($account->balance >= floatval($request->expense['total'])){
            $expense = new Expense([
                'name' => $request->expense['name'],
                'total' => $request->expense['total'],
                'account_id' => $request->expense['account_id']
            ]);
            $expense->save();

            $account->balance = $account->balance - floatval($request->expense['total']);
            $account->save();

            return response()->json('The expense was successfully added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense, $id)
    {
        $account = Account::where('id', Expense::where('id', $id)->first()->account_id)->first();
        $account->balance = $account->balance + Expense::where('id', $id)->first()->total;
        $account->save();

        $expense->where('id', $id)->delete();
        return response()->json('The Account successfully deleted');
    }
}
