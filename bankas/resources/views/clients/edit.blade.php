@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header"style="background-color: #E8985E;">
                    <h1>Edit Client information</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('clients-update', $client)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Client Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $client->name) }}">
                            <div class="form-text">Please add client name here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Client Surname</label>
                            <input type="text" class="form-control" name="surname"  value="{{ old('surname', $client->surname) }}">
                            <div class="form-text">Please add client surname here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">National identification number</label>
                            <input  readonly type="code" style="background-color: #E8985E;" class="form-control" name="asmensKodas" value="{{ $client->asmensKodas }}">
                            <div class="form-text">This is your National identification number</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Account number</label>
                            <input  readonly class="form-control" style="background-color: #E8985E;" name="IBAN" value="{{$client->IBAN}}">
                            <div class="form-text">Your Account number is displayed here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Balance:</label>
                            <input readonly style="background-color: #E8985E;" class="form-control" style="width: 25%;" name='balance' value="{{$client->balance }}">
                            <div class="form-text">Your Account balance is displayed here</div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="tt" name="tt" {{  old('tt',  $client->tt ? 'checked' : '') }}>
                            <label class="form-check-label" for="tt">Upgrade to Premium account</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Town</label>
                            <select class="form-select" name="town_id">
                                <option value="0">Towns list</option>
                                @foreach($towns as $town)
                                <option value="{{$town->id}}" @if($town->id == $client->town_id) selected @endif>
                                    {{$town->name}} {{$town->surname}}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Please select town</div>
                        </div>
                        <button type="submit" class="btn btn-primary"style="background-color: #E8985E;border-color: #E8985E;">Submit</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection