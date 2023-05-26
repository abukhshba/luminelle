@extends('layouts.app')

@section('content')


    <div class="container">
      <h5 class="top-titles-route"><a  href="{{route('home')}}"><span>Home </span></a> 
        <span> / </span>
        <a href="{{ route('categories.products', [$categoryID]) }}"><span> {{ $categoryName }}</span></a>
        <span> / </span> 
        <a href="{{ route('products.show', [$product->id]) }}">
        <span>{{ $product->name }}</span></a>

        <a class="backtoproduct" href="{{ route('products.show', [$product->id]) }}">
          <button type="button" class="btn">Back to the product</button>
        </a>
      </h5>
 
        
        <table class="table table-bordered">
          <thead>
            <tr class="table-fields">
              <th scope="col">Product Name</th>
              <th scope="col">Price</th>
              <th scope="col">Deposit</th>
            </tr>
          </thead>
          <tbody>
            <tr class="table-secondary">
              <td>{{ $product->name }}</td>
              <td>
                
                @if ($product->is_discounted)
                    {{ $product->price - $product->discount }} EGP

                @else
                  {{ $product->price}} EGP
                @endif

              </td>
              <td>{{ $product->deposit }} EGP</td>
            </tr>
          </tbody>
        </table>
        

          <form class="formbookingconfirmation" action="{{ route('orders.create' ) }}" method="POST">
              @csrf
              


                <input type="hidden" name="product_id" value="{{ $product->id }}">
              

              @if ($product->is_discounted)
          
                  <input type="hidden" name="price" value="{{ $product->price - $product->discount }}">
              

              @else
             
                <input type="hidden" name="price" value="{{ $product->price }}">
             
              @endif

                <input type="hidden" name="deposit" value="{{ $product->deposit }}">
             

              <input type="hidden" name="status" value="تم الطلب وبإنتظار دفع العربون">

              <div class="form-group">
                <label class="text-dark" for="exampleCheck1"><span style="font-size: 20px">Enter The reservation date</label>

                <input type="date" name="reservation_date" class="form-control" placeholder="Reservation Date">
              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label-check" for="exampleCheck1">I read the instructions and I will communicate with the management to confirm the payment</label>
              </div>
              <div class="confirmButton">
              <button type="submit" class="btn btn-primary" id="confirmButton" disabled>Confirm Reservation</button>
              </div>
            </form>
    </div>
    <script>
      const checkbox = document.getElementById('exampleCheck1');
      const confirmButton = document.getElementById('confirmButton');

      checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
          confirmButton.disabled = false;
        } else {
          confirmButton.disabled = true;
        }
      });

    </script>
         
   
@endsection




