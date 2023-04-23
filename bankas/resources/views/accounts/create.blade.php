@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header"style="background-color: #E8985E;">
                    <h1>Add Account</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('accounts-store')}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Client Name</label>
                            <input type="text" class="form-control" name="name" value={{old('name')}}>
                            <div class="form-text">Please add your name here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Client Surname</label>
                            <input type="text" class="form-control" name="surname" value={{old('surname')}}>
                            <div class="form-text">Please add your surname here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">National identification number</label>
                            <input  required type="code" class="form-control" name="asmensKodas">
                            <div class="form-text">Please add your National identification number</div>
                        </div>
                        <button type="submit" class="btn btn-primary"style="background-color: #E8985E;border:#E8985E">Submit</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection