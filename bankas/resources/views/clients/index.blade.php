@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header" style="background-color: #E8985E;">
                    <h1>Card List</h1>

                    <form action="{{route('clients-index')}}" method="get">

                        <div class="container">
                            <div class="row">

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Sort</label>
                                        <select class="form-select" name="sort">
                                            @foreach($sortSelect as $value => $text)
                                            <option value="{{$value}}" @if($value===$sort) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Please select your sort preferences</div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Filter</label>
                                        <select class="form-select" name="filter">
                                            @foreach($filterSelect as $value => $text)
                                            <option value="{{$value}}" @if($value===$filter) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Please select your filter preferences</div>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="mb-3">
                                        <label class="form-label">Results per page</label>
                                        <select class="form-select" name="per">
                                            @foreach($perSelect as $value => $text)
                                            <option value="{{$value}}" @if($value===$per) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">View preferences</div>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="sort-filter-buttons">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{route('clients-index')}}" class="btn btn-danger">clear</a>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </form>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($clients as $client)
                        <li class="list-group-item">
                            <div class="client-line @if(Session::has('light-up') && Session::get('light-up') ==  $client->id) active @endif">
                                <div class="client-info" style="margin-right: 20px;">
                                    <h4 class="mb-1" style="margin-right:10px;">{{$client->name}} {{$client->surname}}</h4>
                                    <p class="mb-1" style="margin-right:10px;"><strong><span style="color:#267F00;font-weight: bold;letter-spacing: 0px;padding-left: 0px;">Balance:</span></strong> {{$client->balance}} €</p>
                                    <p class="mb-1"><strong><span style="color:#267F00;font-weight: bold;letter-spacing: 0px;padding-left: 0px;">IBAN:</span></strong> {{$client->IBAN}}</p>
                                    {{-- <span class="mb-1" style="color:#262A10;margin-right: 30px;">{{$client->tt ? 'Premium' : 'Basic' }}</span> --}}
                                    {{-- <div class="orders-count">orders: [{{$client->order->count()}}]
                                </div> --}}
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
                    <div class="client-line">No clients</div>
                </li>
                @endforelse
                </ul>
            </div>
        </div>
        <div class="m-2">
            {{ $clients->links() }}
        </div>

    </div>

    @endsection
