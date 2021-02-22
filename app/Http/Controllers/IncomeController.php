<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income = Income::with('account')->get()->toArray();
        return array_reverse($income);
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
        $income = new Income([
            'name' => $request->income['name'],
            'total' => $request->income['total'],
            'account_id' => $request->income['account_id']
        ]);
        $income->save();

        $account = Account::where('id', $request->income['account_id'])->first();
        $account->balance = $account->balance + floatval($request->income['total']);
        $account->save();

        return response()->json('The income was successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income, $id)
    {
        $account = Account::where('id', Income::where('id', $id)->first()->account_id)->first();
        $account->balance = $account->balance - Income::where('id', $id)->first()->total;
        $account->save();

        $income->where('id', $id)->delete();
        return response()->json('The record was successfully deleted');
    }
}
