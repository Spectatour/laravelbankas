@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header"style="background-color: #E8985E;">
                    <h1>Edit name</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('accounts-update', $account)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Client name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $account->name) }}">
                            <div class="form-text">Please add your name here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Client surname</label>
                            <input type="text" class="form-control" name="surname" value="{{ old('surname', $account->surname) }}">
                            <div class="form-text">Please add your surname here</div>
                        </div>
                        <button type="submit" class="btn btn-primary"style="background-color: #E8985E;border:#E8985E;">Submit</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection