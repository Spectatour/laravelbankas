@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #E8985E;">Welcome to SBH</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="card-body">
                        <h1 style="color:gold;;display:flex;justify-content:center;align-items:center;height: 10vh;">{{ __('You are logged in!') }}</h1>
                        <p style="color: #E8985E;font-size: 35px;">We have a total of: <span style="color:#267F00">{{ $totalAccounts }} </span>accounts</p>
                        <p style="color: #E8985E;font-size: 20px;">Our clients have over: <span style="color:#267F00">{{ $totalClients }}</span> cards created</p>
                        <p style="color: #E8985E;font-size: 40px;">With total balance of: <span style="color:#267F00">{{ $totalBalance }} €</span></p>
                        
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-center">
                <img src="{{ url('/../image.png') }}" alt="Image" style="max-width: 100%;">
            </div>

        </div>
    </div>
</div>
@endsection
