@extends('layouts.app')

@section('content')


    <div class="container">
      <h5 class="top-titles-route"><a  href="{{route('home')}}"><span>Home </span></a> 
        <span> / </span>
        <a href="{{ route('categories.products', [$categoryID]) }}"><span> {{ $categoryName }}</span></a>
        <span> / </span> <span>{{ $product->name }}</span></h5>


        <div class="product-datails-show">
          <div class="product-images">
            <div class="thumbnail-grid">

              <div class="thumbnail">
                @foreach ($product->images as $index => $image)
                  @if ($index === 2)
                    <img src="{{ asset('storage/' . $image->image) }}"
                         width="200px" height="200px"
                         alt="Product Image"><br>
                  @else
                  
                    <img src="{{ asset('storage/' . $image->image) }}"
                         width="110px" height="110px"
                         alt="Product Image"> 
                  @endif
                  
                @endforeach
              </div>
            </div>
          </div>
          
          <div>
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>
        
            {{-- Rating --}}
            <div class="product-rating">
              @if ($averageRating < 1.25)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">
              @elseif ($averageRating > 1.25 && $averageRating <= 1.5)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">
              @elseif ($averageRating > 1.5 && $averageRating <= 1.75)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">
              @elseif ($averageRating > 1.75 && $averageRating <= 2)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              @elseif ($averageRating > 2 && $averageRating <= 2.25)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">
              @elseif ($averageRating > 2.25 && $averageRating <= 2.5)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">
              @elseif ($averageRating > 2.5 && $averageRating <= 2.75)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">
              @elseif ($averageRating > 2.75 && $averageRating <= 3)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              @elseif ($averageRating > 3 && $averageRating <= 3.25)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">
              @elseif ($averageRating > 3.25 && $averageRating <= 3.5)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">
              @elseif ($averageRating > 3.5 && $averageRating <= 3.75)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">
              @elseif ($averageRating > 3.75 && $averageRating <= 4)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              @elseif ($averageRating > 4)
                Rating: {{ $averageRating }}
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">
              
                @elseif($averageRating>4 && $averageRating<=4.25)
                <div class="product-rating">
                  Rating: {{$averageRating}}
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">
                </div>


                @elseif($averageRating>4.25 && $averageRating<=4.5)
                <div class="product-rating">
                  Rating: {{$averageRating}}
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">
                </div>


                @elseif($averageRating>4.5 && $averageRating<=4.75)
                <div class="product-rating">
                  Rating: {{$averageRating}}
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">
                </div>

                @elseif($averageRating>4.75 && $averageRating<=5)
                <div class="product-rating">
                  Rating: {{$averageRating}}
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
                </div>

                @endif
            </div>
        
            
            {{-- end rating --}}
          
         
            <div class="price-action">
              @if($product->is_discounted)
              <div class="price-details">
                <span class="real">{{ $product->price - $product->discount}} EGP</span>
                <span class="off">{{ $product->price }} EGP</span>
             </div>
              @else
              <div class="price-details">
                <span class="real">{{ $product->price }} EGP</span>
             </div>
              @endif
              <a href="{{route('orders.bookNow' , [$product->id])}}" class="btn btn-success">Book Now</a>

              <form action="{{ route('orders.create') }}" method="POST">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">
                @if ($product->is_discounted)
                    <input type="hidden" name="price" value="{{ $product->price - $product->discount }}">
                @else
                  <input type="hidden" name="price" value="{{ $product->price }}">
                @endif
                <input type="hidden" name="status" value="تم الطلب وبإنتظار دفع العربون">
               

              </form>
            </div>
          </div>

@endsection




