@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header"style="background-color: #E8985E;">
                    <h1>Add Order</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('orders-store')}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value={{old('title')}}>
                            <div class="form-text">Please add title of goods or products you want to buy</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" name="price" value={{old('price')}}>
                            <div class="form-text">Please add price to pay</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Card</label>
                            <select class="form-select" name="client_id">
                                <option value="0">Clients list</option>
                                @foreach($clients as $client)
                                <option value="{{$client->id}}" @if($client->id == $id) selected @endif>
                                {{$client->name}} {{$client->surname}}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Please select card you wish to add this order to</div>
                        </div>
                        <button type="submit" class="btn btn-primary"style="background-color: #E8985E;border:#E8985E;">Submit</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection