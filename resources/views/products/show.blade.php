@extends('layouts.app')

@section('content')


    <section class="container">
      <h5 class="top-titles-route"><a  href="{{route('home')}}"><span>Home </span></a> 
        <span> / </span>
        <a href="{{ route('categories.products', [$categoryID]) }}"><span> {{ $categoryName }}</span></a>
        <span> / </span> <span>{{ $product->name }}</span></h5>
    </section>

    <section class="product-datails-show">
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
      
      <div class="products-info-details">
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
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">


            @elseif($averageRating>4.25 && $averageRating<=4.5)
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">


            @elseif($averageRating>4.5 && $averageRating<=4.75)
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">

            @elseif($averageRating>4.75 && $averageRating<=5)
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">

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
        </div>
      </div>
  </section>

  <section class="hashline">
------------------------------------------------------------------------------------
  </section>

  
  <section class="">
  <!-- Existing code -->
</section>

<section class="comments-reviews">
  <h1 class="coments-reviews-title">Comments and Reviews</h1>

  <!-- Display existing comments and reviews -->
  @foreach ($product->reviews as $review)
    <div class="comment">

   

        <div class="user-profile">
            <div class="profile-circle">
                <img src="{{ asset('images/users/' . $user->image) }}" alt="User Profile">
            </div>
            <div class="profile-dropdown">
                <h4 class="profile-name-review">{{ $review->user->name }}</h4>
                
            </div>
        </div>
    

     
      <div class="rating">
     

        <div class="product-rating">
          @if ($review->rating < 1.25)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">
          @elseif ($review->rating > 1.25 && $review->rating <= 1.5)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">
          @elseif ($review->rating > 1.5 && $review->rating <= 1.75)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">
          @elseif ($review->rating > 1.75 && $review->rating <= 2)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
          @elseif ($review->rating > 2 && $review->rating <= 2.25)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">
          @elseif ($review->rating > 2.25 & $review->rating <= 2.5)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">
          @elseif ($review->rating > 2.5 & $review->rating <= 2.75)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">
          @elseif ($review->rating > 2.75 && $review->rating <= 3)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
          @elseif ($review->rating > 3 && $review->rating <= 3.25)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">
          @elseif ($review->rating > 3.25 && $review->rating <= 3.5)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">
          @elseif ($review->rating > 3.5 && $review->rating <= 3.75)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">
          @elseif ($review->rating > 3.75 && $review->rating <= 4)
            Rating: {{ $review->rating }}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
       
            @elseif($review->rating>4 && $review->rating<=4.25)
              Rating: {{$review->rating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">


            @elseif($review->rating>4.25 && $review->rating<=4.5)
              Rating: {{$review->rating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">


            @elseif($review->rating>4.5 && $review->rating<=4.75)
              Rating: {{$review->rating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">

            @elseif($review->rating>4.75 & $review->rating<=5)
              Rating: {{$review->rating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">

            @endif

      
      </div>
    </div>
    <p><span>Comment:</span> {{ $review->comment }}</p>
    </div>
    <h6 class="dashline-under-reviews">ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ</h6>
  @endforeach

  <!-- Add comment and rating form -->
 
  <div class="add-comment">
    <h4>Add Your Comment and Rating</h4>
    <form class="form-inline" action="{{ route('reviews.store', [$product->id]) }}" method="POST">
      @csrf
      <input type="hidden" name="product_id" value="{{ $product->id }}">
      <div class="form-group">
        <label for="rating">Rating (1-5):</label>
        <input class="form-control" type="number" step="0.01" min="1" max="5" name="rating" id="rating" required>
      </div>
      
      <div class="form-group">
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
      </div>
      
      <button type="submit" class="btn btn-success">Submit Review</button>
    </form>
  </div>
</section>


@endsection




