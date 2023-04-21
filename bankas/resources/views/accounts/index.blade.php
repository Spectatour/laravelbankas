@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Client List</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($accounts as $account)
                        <li class="list-group-item">
                            <div class="client-line">
                                <div class="client-info">
                                    <h2>{{$account->name}}</h2>
                                    <div class="clients-count">clients: [{{$account->client->count()}}]</div>
                                    <div class="clients-count">orders: [{{$account->ordersCount}}]</div>
                                </div>
                                <div class="buttons">
                                    <a href="{{route('accounts-show', $account)}}" class="btn btn-info">Show</a>
                                    <a href="{{route('accounts-edit', $account)}}" class="btn btn-success">Edit</a>
                                    <form action="{{route('accounts-delete', $account)}}" method="post">
                                        <button type="submit" class="btn btn-danger">delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                            <div class="client-line">No towns</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection