@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header" style="background-color: #E8985E;">
                    <h1>Client List</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($accounts as $account)
                        <li class="list-group-item">
                            <div class="client-line">
                                <div class="client-info">
                                    <h2>{{$account->name}} {{$account->surname}}</h2>
                                    @if($account->client->count() > 0)
                                    <div class="clients-count">Cards: [{{$account->client->count()}}]</div>
                                    @endif

                                    {{-- <div class="clients-count">orders: [{{$account->ordersCount}}]
                                </div> --}}
                                @if($account->totalBalance > 0)
                                <p class="mb-1"style="margin-left:20px;"><strong><span style="color:#E8985E;font-weight: bold;letter-spacing: 0px;padding-left: 0px;">Total Balance:</span></strong> {{$account->totalBalance}} €</p>
                                @endif
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
                    <div class="client-line">No clients</div>
                </li>
                @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
