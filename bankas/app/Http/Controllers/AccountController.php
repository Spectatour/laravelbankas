<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;



class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();

        // nereiku, nes cia yra FRANKENSTEINAS
        $accounts->each(function($t) {
            $ordersCount = 0;
            $t->client->each(function($c) use(&$ordersCount) {
                $ordersCount += $c->order->count();
            });
            $t->ordersCount = $ordersCount;
        });
        
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
        Account::create([
            'name' => $request->name,
        ]);

        return redirect()->route('accounts-index');
    }

   
    public function show(Account $account)
    {
        return view('accounts.show', [
            'account' => $account
        ]);
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
        ]);

        return redirect()->route('accounts-index')
        ->with('ok', 'The account was updated');
    }

   
    public function destroy(Account $account)
    {
        if ($account->client->count()) {
            return redirect()->back()
            ->with('info', 'Account has active cards clients');
        }
        $account->delete();
        return redirect()->back()
        ->with('ok', 'Account was deleted');
    }
}
