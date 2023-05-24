@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $category->name }} Dresses</h1>

        <section class="projects" id="projects">   


            <div class="contentproduct">
                @foreach ($products->chunk(3) as $row)
                <div class="row">
                    @foreach ($row as $product)
                    <div class="col-md-4">
                        <div class="project-cardproduct"> 
                            <div class="project-image">
                                @if ($product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image) }}" height="300px" class="card-img-top" alt="{{ $product->name }}">
                                @endif
                            </div>
                            <div class="project-info">
                                <h2 class="card-title">{{ $product->name }}</h2>
                                <p class="card-text">{{ $product->description }}</p>
                                <div class="price-action">
                                    <h3 class="card-text">{{ $product->price }} EGP</h3>
                                    <a href="#" class="btn btn-danger">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>

        </section>


    </div>
@endsection
