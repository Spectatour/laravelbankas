@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Account info</h1>
                </div>
                <div class="card-body">
                    <div class="client-line">
                        <div class="client-info">
                            {{$account->name}}
                            {{$account->surname}}
                        </div>
                        <div class="buttons">
                            <a href="{{route('orders-create', ['id' => $account])}}" class="btn btn-info">new order</a>
                            <a href="{{route('accounts-edit', $account)}}" class="btn btn-success">Edit</a>
                            <form action="{{route('accounts-delete', $account)}}" method="post">
                                <button type="submit" class="btn btn-danger">delete</button>
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
                                <div class="order-info">
                                    {{$client->name}}
                                    {{$client->surname}}
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