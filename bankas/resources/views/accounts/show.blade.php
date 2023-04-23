@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header" style="background-color: #E8985E;">
                    <h1>Account info</h1>
                </div>
                <div class="card-body">
                    <div class="client-line">
                        <div class="client-info">


                            <h4 class="mb-1" style="margin-right:0px;">{{$account->name}} {{$account->surname}}</h4>
                            <p class="mb-1"><strong><span style="color:#E8985E;font-weight: bold;letter-spacing: 0px;padding-left: 0px;">NID:</span></strong> {{$account->asmensKodas}}</p>
                            <p class="mb-1"><strong><span style="color:#E8985E;font-weight: bold;letter-spacing: 0px;padding-left: 0px;">Total Balance:</span></strong> {{$totalBalance}} €</p>
                            <div class="mb-1"><strong><span style="color:#E8985E;font-weight: bold;letter-spacing: 0px;padding-left: 0px;">Active Cards:</span></strong>[{{$account->client->count()}}]</div>

                        </div>
                        <div class="buttons">
                            <a href="{{route('orders-create', ['id' => $account])}}" class="btn btn-info">New order</a>
                            <a href="{{route('accounts-edit', $account)}}" class="btn btn-success">Edit order</a>
                            <form action="{{route('accounts-delete', $account)}}" method="post">
                                <button type="submit" class="btn btn-danger">Delete order</button>
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </div>

                    <h2>Credit cards</h2>
                    <ul class="list-group">
                        @forelse($account->client as $client)
                        <li class="list-group-item">
                            <div class="order-line">
                                <div class="client-info" style="margin-right: 20px;">
                                    <h4 class="mb-1" style="margin-right:10px;">{{$client->name}} {{$client->surname}}</h4>
                                    <span class="mb-1" style="color: {{ $client->tt ? 'gold' : 'black' }}; margin-right: 30px;">{{ $client->tt ? 'Premium' : 'Basic' }}</span>
                                    <p class="mb-1" style="margin-right:10px;"><strong><span style="color:#E8985E;font-weight: bold;letter-spacing: 0px;padding-left: 0px;">Balance:</span></strong> {{$client->balance}} €</p>
                                    <p class="mb-1"><strong><span style="color:#E8985E;font-weight: bold;letter-spacing: 0px;padding-left: 0px;">IBAN:</span></strong> {{$client->IBAN}}</p>
                                    <div class="orders-count" style="color:crimson;">Pending transactions: [{{$client->order->count()}}]
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="{{route('clients-editAdd', $client)}}" class="btn btn-info" style="background-color:green;border:green;">Add</a>
                                    <a href="{{route('clients-editWithdraw', $client)}}" class="btn btn-info" style="background-color:red;border:red;">Withdraw</a>
                                    <a href="{{route('clients-show', $client)}}" class="btn btn-info" style="background-color:#E8985E;border:#E8985E;">Show</a>
                                    <a href="{{route('clients-edit', $client)}}" class="btn btn-success" style="background-color:blue;border:blue;">Edit</a>
                                    <form action="{{route('clients-delete', $client)}}" method="post">
                                        <button type="submit" class="btn btn-danger" style="background-color:#7F0000;">delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>

                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                            <div class="client-line">No orders</div>
                        </li>
                        @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
