@extends('layouts.app')

@section('content')
    <div class="container">

        <h5  class="top-titles-route"><a href="{{route('home')}}"><span>Home </span></a> <span> / </span><a href="{{ route('categories.products', [$category->id]) }}"><span> {{ $category->name }} Dresses</span></a></h5>

        <section class="projects" id="projects">   


            <div class="contentproduct">
                <div class="row">
                    @foreach ($products as $product)
                    <div style="align-items: center" class="col-md-4">
                        <div class="project-cardproduct"> 
                            <a href="{{ route('products.show', [$product->id]) }}" class="product-show-card">
                                <div class="project-image">
                                    @if ($product->images->count() > 0)
                                    <img src="{{ asset('storage/' . $product->images->first()->image) }}" height="300px" class="card-img-top" alt="{{ $product->name }}">
                                    @endif
                                </div>
                                <div class="project-info">
                                    <h2 class="card-title">{{ $product->name }}</h2>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <div class="price-action">
                                        @if($product->is_discounted)
                                        <div class="price-details">
                                          <span class="real">{{ $product->price - $product->discount}} EGP</span>
                                          <span class="off-card">{{ $product->price }} EGP</span>
                                       </div>
                                        @else
                                        <div class="price-details">
                                          <span class="real">{{ $product->price }} EGP</span>
                                       </div>
                                        @endif
                                        <a href="#" class="btn btn-danger">Book Now</a>
                                      </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div>
            
        </section>


    </div>
@endsection
