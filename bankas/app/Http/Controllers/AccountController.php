<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $accounts = Account::all();

    foreach ($accounts as $account) {
        $totalBalance = $account->client->sum('balance');
        $account->totalBalance = $totalBalance;
    }

    return view('accounts.index', [
        'accounts' => $accounts,
    ]);
}


    
    public function create()
    {
        return view('accounts.create');
    }

  
    public function store(Request $request)
{   
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3',
        'surname' => 'required|min:3',
        'asmensKodas' => 'required|digits:11|unique:accounts,asmensKodas',
    ], [
        'asmensKodas.required' => 'The national identification number field is required.',
        'asmensKodas.digits' => 'The national identification number field must contain exactly :digits digits.',
        'asmensKodas.unique' => 'The national identification number already exists.',
    ]);

    if ($validator->fails()) {
        $request->flash();
        return redirect()
            ->back()
            ->withErrors($validator);
    }

    $account = new Account;
    $account->name = $request->name;
    $account->surname = $request->surname;
    $account->balance = 0;
    $account->asmensKodas = $request->asmensKodas;
    $account->save();
    return redirect()
    ->route('accounts-index')
    ->with('ok', 'New client was created');

    return redirect()->route('accounts-index');
}


   
    public function show(Account $account)
{
    $totalBalance = Client::where('account_id', $account->id)->sum('balance');
    return view('accounts.show', compact('account', 'totalBalance'));
}

   
    public function edit(Account $account)
    {
        return view('accounts.edit', [
            'account' => $account
        ]);
    }

    
    public function update(Request $request, Account $account)
    {

        
        $account->update([
            'name' => $request->name,
            'surname' => $request->surname,
        ]);

        return redirect()->route('accounts-index')
        ->with('ok', 'The account was updated');
    }

   
    public function destroy(Account $account)
    {
        if ($account->client->count()) {
            return redirect()->back()
            ->with('info', 'Account has active cards');
        }
        $account->delete();
        return redirect()->back()
        ->with('ok', 'Account was deleted');
    }

    public function getTotalBalance(Account $account)
{
    $totalBalance = DB::table('clients')
        ->where('account_id', $account->id)
        ->sum('balance');
    
    return $totalBalance;
}

}

