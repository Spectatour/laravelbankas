@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header"style="background-color: #E8985E;">
                    <h1>Spend money</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('clients-updateWithdraw', $client)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Client Name</label>
                            <input readonly type="text" class="form-control" name="name"style="background-color: #E8985E;" value="{{$client->name}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Client Surname</label>
                            <input readonly type="text" style="background-color: #E8985E;" class="form-control" name="surname"  value="{{$client->surname}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">National identification number</label>
                            <input  readonly type="code" style="background-color: #E8985E;" class="form-control" name="asmensKodas" value="{{$client->asmensKodas}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Account number</label>
                            <input  readonly class="form-control" style="background-color: #E8985E;" name="IBAN" value="{{$client->IBAN}}">
                        <div class="mb-3">
                            <label class="form-label">Balance:</label>
                            <input readonly style="background-color: #E8985E;" class="form-control" style="width: 25%;" name='balance' value="{{$client->balance }} €">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">How much do you want to spend:</label>
                            <input  class="form-control" style="width: 25%;" name='amount'>
                        </div>      
                        <div style="display: flex; justify-content:space-between;">
                                <button type="submit" class="btn btn-primary"style="background-color: #E8985E;border-color:#E8985E;margin-top: 20px;">Spend money</button>
                                <a href="{{route('clients-index', $client)}}" class="btn btn-secondary"style="background-color: #54442B;border-color:#54442B;margin-top: 20px;">Back to Clients</a>
                        </div>
                        @csrf
                        @method('put')                  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection