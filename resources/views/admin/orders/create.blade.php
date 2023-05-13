@extends('admin.Layouts.Dashboard')

@section('content')

<div class="breadcrumb-header justify-content-between">
    

    <div class="d-flex my-xl-auto right-content">
        <a href="{{route('dashboard.orders.index')}}" class="btn btn-danger mb-1 me-1">العودة للطلبات</a>
        
    </div>
</div>



<div style="margin: 50px">
  
  
    <form action="{{ route('dashboard.orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user">User</label>
            <select class="form-control" id="user" name="user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product">Product</label>
            <select class="form-control" id="product" name="product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount') }}">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
        </div>
        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="text" name="discount" id="discount" class="form-control" value="{{ old('discount') }}">
        </div>
        {{-- <div class="form-group">
            <label for="total_price">Total Price</label>
            <input type="text" name="total_price" id="total_price" class="form-control" value="{{ old('total_price') }}">
        </div> --}}
        
        <div class="form-group ">
            <label for="item_price">Reservation Date:</label>
            <input type="date" name="item_price" id="reservation_date" class="form-control" value="{{ old('reservation_date') }}">
        </div>
        <button type="submit" class="form-group btn btn-primary">Submit</button>
    </form>
    
    
  
    {{-- <form action="{{ route('dashboard.orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user">user</label>
            <select class="form-control" id="user" name="user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product">product</label>
            <select class="form-control" id="product" name="product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <div class="form-group ">
            <label for="item_price">Item Price:</label>
            <input type="text" name="item_price" id="item_price" class="form-control" value="{{ old('item_price.0') }}">
        </div>
        <div class="form-group ">
            <label for="amount">Amount:</label>
            <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount.0') }}">
        </div>

        <button type="submit" class="form-group btn btn-primary">Submit</button>
      
    </form> --}}

</div>
@endsection
