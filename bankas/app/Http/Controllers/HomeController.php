<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalClients = Client::count();
        $totalAccounts = Account::count();
        
        $totalBalance = DB::table('clients')->sum('balance');

        return view('home', [
            'totalAccounts' => $totalAccounts,
            'totalBalance' => $totalBalance,
            'totalClients' => $totalClients,
        ]);
    }
}
