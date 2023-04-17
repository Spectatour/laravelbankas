@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header"style="background-color: #E8985E;">
                    <h1>Clients List</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($clients as $client)
                        <li class="list-group-item">
                            <div class="client-line">
                                <div class="client-info">
                                    <h4 class="mb-1"style="margin-right:10px;">{{$client->name}} {{$client->surname}}</h4>
                                    <p class="mb-1"style="margin-right:10px;"><strong ><span style="color:#E8985E;font-weight: bold;letter-spacing: 0px;padding-left: 0px;">Balance:</span></strong> {{$client->balance}} €</p>
                                    <p class="mb-1"><strong><span style="color:#E8985E;font-weight: bold;letter-spacing: 0px;padding-left: 0px;">National ID:</span></strong>  {{$client->asmensKodas}}</p>
                                    <span class="mb-1" style="color:#262A10;margin-right: 30px;">{{$client->tt ? 'Premium' : 'Basic' }}</span>
                                </div>
                                <div class="buttons">
                                    <a href="{{route('clients-editAdd', $client)}}" class="btn btn-info"style="background-color:green;border:green;">Add</a>
                                    <a href="{{route('clients-editWithdraw', $client)}}" class="btn btn-info"style="background-color:red;border:red;">Withdraw</a>
                                    <a href="{{route('clients-show', $client)}}" class="btn btn-info"style="background-color:#E8985E;border:#E8985E;">Show</a>
                                    <a href="{{route('clients-edit', $client)}}" class="btn btn-success"style="background-color:blue;border:blue;">Edit</a>
                                    <form action="{{route('clients-delete', $client)}}" method="post">
                                        <button type="submit" class="btn btn-danger"style="background-color:#7F0000;">delete</button>
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