@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header" style="background-color: #E8985E;;">
                    <h1 >Client</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">  
                        <li class="list-group-item"style="background-color: #E8985E;;"><strong>Name:</strong> {{$client->name}} {{$client->surname}}</li>
                        <li class="list-group-item"><strong>Balance:</strong> {{$client->balance}} €</li>
                        <li class="list-group-item"style="background-color: #E8985E;;"><strong>National identification number:</strong> {{$client->asmensKodas}}</li>
                        <li class="list-group-item"><strong>IBAN:</strong> {{$client->IBAN}}</li>
                        <li class="list-group-item"style="background-color: #E8985E;"><strong>Social Media:</strong> <span class="badge badge-primary">{{$client->tt ? 'Premium' : 'Basic'}}</span></li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection