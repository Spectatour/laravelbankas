@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header"style="background-color: #E8985E;">
                    <h1>Add Card</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('clients-store')}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Card Name</label>
                            <input type="text" class="form-control" name="name" value={{old('name')}}>
                            <div class="form-text">Please add cards name here</div>
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">Client Surname</label>
                            <input type="text" class="form-control" name="surname" value={{old('surname')}}>
                            <div class="form-text">Please add client surname here</div>
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label class="form-label">National identification number</label>
                            <input  required type="code" class="form-control" name="asmensKodas">
                            <div class="form-text">Please add your National identification number</div>
                        </div> --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input"
                             @if(old('tt')) checked @endif id="tt" name="tt">
                            <label class="form-check-label" for="tt">Create Premium card</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Accounts</label>
                            <select class="form-select" name="account_id">
                                <option value="0">Account list</option>
                                @foreach($accounts as $account)
                                <option value="{{$account->id}}">
                                    {{$account->name}} {{$account->surname}}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Please select account to add card</div>
                        </div>
                        <button type="submit" class="btn btn-primary"style="background-color: #E8985E;border-color: #E8985E;">Submit</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection