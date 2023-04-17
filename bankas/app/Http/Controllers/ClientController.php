<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\Validator as V;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $clients = Client::all()->sortBy('name');

        return view('clients.index', [
            'clients' => $clients
        ]);

    }


    public function create()
    {
        return view('clients.create');
    }


    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3',
        'surname' => 'required|min:3',
        'asmensKodas' => 'required|digits:11|unique:clients,asmensKodas',
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
        
        $client = new Client;
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->balance = 0;
        $client->asmensKodas = $request->asmensKodas;
        $client->IBAN = 'LT' . substr(str_shuffle(str_repeat('0123456789', 18)), 0, 18);
        $client->tt = isset($request->tt) ? 1 : 0;
        $client->save();
        return redirect()
        ->route('clients-index')
        ->with('ok', 'New client was created');

    }


    public function show(Client $client)
    {
        return view('clients.show', [
            'client' => $client
        ]);
    }


    public function edit(Client $client)
    {
        return view('clients.edit', [
            'client' => $client
        ]);
    }


    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->balance = $request->balance;
        $client->asmensKodas = $request->asmensKodas;
        $client->IBAN = $request->IBAN;
        $client->tt = isset($request->tt) ? 1 : 0;
        $client->save();
        return redirect()
        ->route('clients-index')
        ->with('ok', 'The client was updated');
    }


    public function destroy(Client $client)
{
    if ($client->balance > 0) {
        return redirect()
            ->route('clients-index')
            ->with('info', 'You cannot delete an account with a balance');
    }

    $client->delete();
    return redirect()
        ->route('clients-index')
        ->with('ok', 'The client was deleted successfully');
}

public function editAdd(Client $client)
{
    return view('clients.editAdd', [
        'title' => 'Add to Client Balance',
        'client' => $client
    ]);
}

public function editWithdraw(Client $client)
{
    return view('clients.editWithdraw', [
        'title' => 'Withdraw from Client Balance',
        'client' => $client
    ]);
}

public function updateAdd(Request $request, Client $client)
{
    $this->validate($request, [
        '_token' => 'required'
    ]);

    $amount = $request->input('amount');
    $balance = $client->balance + $amount;

    $client->balance = $balance;
    $client->save();

    return redirect()->route('clients-editAdd', ['client' => $client->id])
        ->with('ok', 'Balance was updated');
}

public function updateWithdraw(Request $request, Client $client)
{
    $withdrawAmount = $request->amount;
    $currentBalance = $client->balance;
    
    if ($withdrawAmount > $currentBalance) {
        return redirect()->route('clients-editWithdraw', ['client' => $client->id])
            ->with('ok', 'You cannot withdraw more money than you have available');
    }
    
    $balance = $currentBalance - $withdrawAmount;
    $client->balance = $balance;
    $client->save();
    
    return redirect()->route('clients-editWithdraw', ['client' => $client->id])
        ->with('ok', 'Withdrawal was successful');
}


}