@extends('layouts.app')

@section('content')


    <div class="container">
      <h5 class="top-titles-route"><a  href="{{route('home')}}"><span>Home </span></a> 
        <span> / </span>
        <a href="{{ route('categories.products', [$categoryID]) }}"><span> {{ $categoryName }}</span></a>
        <span> / </span> <span>{{ $product->name }}</span></h5>
        

        <div class="product-datails-show">
          <div class="product-images">
            <div class="carousel-container">
              <!-- Add your carousel implementation here -->
              @foreach ($product->images as $image)
                <img class="carousel-item" src="{{ asset('storage/' . $image->image) }}" alt="Product Image">
              @endforeach
            </div>
            
            <div class="thumbnail-grid">
              <!-- Iterate over product images and display thumbnails -->
              @foreach ($product->images as $image)
                <div class="thumbnail">
                  <img src="{{ asset('storage/' . $image->image) }}"  width="200px" height="200px" alt="Product Image">
                </div>
              @endforeach
            </div>
          </div>
          <div >
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>



            {{-- rating --}}
             <div class="product-rating">

            @if($averageRating<1.25)
            <div class="product-rating">
              Rating: {{$averageRating}}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">

            </div>
            @elseif($averageRating>1.25 && $averageRating<=1.5)
            <div class="product-rating">
              Rating: {{$averageRating}}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">

            </div>


            @elseif($averageRating>1.5 && $averageRating<=1.75)
            <div class="product-rating">
              Rating: {{$averageRating}}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">

            </div> 
            
            @elseif($averageRating>1.75 && $averageRating<=2)
            <div class="product-rating">
              Rating: {{$averageRating}}
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">

            </div> 
            
            @elseif($averageRating>2 && $averageRating<=2.25)
            <div class="product-rating">
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">

            </div> 
            
            @elseif($averageRating>2.25 && $averageRating<=2.5)
            <div class="product-rating">
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">

            </div> 
            
            @elseif($averageRating>2.5 && $averageRating<=2.75)
            <div class="product-rating">
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">

            </div>
            
            @elseif($averageRating>2.75 && $averageRating<=3)
            <div class="product-rating">
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">

            </div>
            
            @elseif($averageRating>3 && $averageRating<=3.25)
            <div class="product-rating">
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star025.png') }}" height="15px" width="4px" class="main-logo" alt="logo">

            </div>
            
            @elseif($averageRating>3.25 && $averageRating<=3.5)
            <div class="product-rating">
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star05.png') }}" height="15px" width="8px" class="main-logo" alt="logo">

            </div>
            
            @elseif($averageRating>3.5 && $averageRating<=3.75)
            <div class="product-rating">
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star075.png') }}" height="15px" width="12px" class="main-logo" alt="logo">

            </div>
            @elseif($averageRating>3.75 && $averageRating<=4)
            <div class="product-rating">
              Rating: {{$averageRating}}
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">
              <img src="{{ asset('assets/images/brand/star1.png') }}" height="15px" width="15px" class="main-logo" alt="logo">

            </div>
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
            
            
            {{-- end rating --}}
          
          @endif
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
              <a href="#" class="btn btn-danger">Book Now</a>
            </div>
          </div>

        
        </div>
    </div>
    <script>
      // Add your carousel implementation JavaScript code here

      function initCarousel() {
        const carouselContainer = document.querySelector('.carousel-container');
        const carouselItems = document.querySelectorAll('.carousel-item');
        const totalItems = carouselItems.length;
        const itemWidth = carouselItems[0].offsetWidth;
        let currentIndex = 0;
      
        carouselContainer.style.width = `${totalItems * itemWidth}px`;
      
        // Function to slide the carousel to the next item
        function slideNext() {
          if (currentIndex === totalItems - 1) {
            currentIndex = 0;
          } else {
            currentIndex++;
          }
      
          carouselContainer.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
        }
      
        // Function to slide the carousel to the previous item
        function slidePrev() {
          if (currentIndex === 0) {
            currentIndex = totalItems - 1;
          } else {
            currentIndex--;
          }
      
          carouselContainer.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
        }
      
        // Attach event listeners to the next and previous buttons
        document.getElementById('carousel-next').addEventListener('click', slideNext);
        document.getElementById('carousel-prev').addEventListener('click', slidePrev);
      }
      
      // Call the initCarousel function to initialize the carousel
      initCarousel();



      // You can use a library like Slick, Flickity, or implement your own solution
    
      // Function to calculate the average rating
      function calculateAverageRating(productId) {
        // Make an AJAX request or use your backend logic to fetch the reviews for the product
        // Calculate the average rating based on the fetched reviews
        // Return the average rating value
      }
    </script>
@endsection




