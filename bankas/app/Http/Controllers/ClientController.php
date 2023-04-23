<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Order;
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
    
    public function index(Request $request)
    {
        $sort = $request->sort ?? '';
        $filter = $request->filter ?? '';
        $per = (int) ($request->per ?? 10);
        $page = $request->page ?? 1;

        $clients = match($filter) {
            'tt' => Client::where('tt', 1),
            'fb' => Client::where('tt', 0),
            default => Client::where('tt', 0)->orWhere('tt', 1)
        };

        $clients = match($sort) {
            'name_asc' => $clients->orderBy('name'),
            'name_desc' => $clients->orderBy('name', 'desc'),
            // 'surname_asc' => $clients->orderBy('surname'),
            // 'surname_desc' => $clients->orderBy('surname', 'desc'),
            default => $clients
        };

        $request->session()->put('last-client-view', [
            'sort' => $sort,
            'filter' => $filter,
            'page' => $page,
            'per' => $per
        ]);

        $clients = $clients->paginate($per)->withQueryString();

        return view('clients.index', [
            'clients' => $clients,
            'sortSelect' => Client::SORT,
            'sort' => $sort,
            'filterSelect' => Client::FILTER,
            'filter' => $filter,
            'perSelect' => Client::PER,
            'per' => $per,
            'page' => $page
        ]);

    }


    public function create()
    {
        $accounts = Account::all();
        
        return view('clients.create',[
            'accounts' => $accounts
        ]);
    }


    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3',
    ], []);

    if ($validator->fails()) {
        $request->flash();
        return redirect()
            ->back()
            ->withErrors($validator);
    }
        
        $client = new Client;
        $client->name = $request->name;
        $client->balance = 0;
        $client->IBAN = 'LT' . substr(str_shuffle(str_repeat('0123456789', 18)), 0, 18);
        $client->tt = isset($request->tt) ? 1 : 0;
        $client->account_id = $request->account_id;
        $client->save();
        return redirect()
        ->route('accounts-index')
        ->with('ok', 'New card was added successfully');

    }


    public function show(Client $client)
    {
        return view('clients.show', [
            'client' => $client
        ]);
    }


    public function edit(Request $request, Client $client)
    {
        $accounts = Account::all();
       
        return view('clients.edit', [
            'client' => $client,
            'accounts' => $accounts
        ]);
    }


    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            // 'surname' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        
        $client->name = $request->name;
        // $client->surname = $request->surname;
        $client->balance = $request->balance;
        // $client->asmensKodas = $request->asmensKodas;
        $client->IBAN = $request->IBAN;
        $client->tt = isset($request->tt) ? 1 : 0;
        $client->save();
        return redirect()
        ->route('clients-index', $request->session()->get('last-client-view', []))
        ->with('ok', 'The card name was updated')
        ->with('light-up', $client->id);
    }


    public function destroy(Client $client)
{

    // if (!$request->confirm && $client->order->count()) {
    //     return redirect()
    //     ->back()
    //     ->with('delete-modal', [
    //         'This client has orders. Do you really want to delete?',
    //         $client->id
    //     ]);
    // }

    if ($client->balance > 0) {
        return redirect()
            ->route('clients-index')
            ->with('info', 'You cannot delete a card with a balance');
    }

    $client->delete();
    return redirect()
        ->route('clients-index')
        ->with('ok', 'The card was deleted successfully');
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
        'title' => 'Withdraw from Card Balance',
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