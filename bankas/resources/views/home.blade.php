@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"style="background-color: #E8985E;">Welcome to SBH</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <img src="{{ url('/../image.png') }}" alt="Image" style="max-width: 100%;">
            </div>
        </div>
    </div>
</div>
@endsection