@extends('layouts.app')

@section('content')

        <section class="cover-photo-title">
            <div class="cover-text">
              <h1>Welcome to our Store</h1>
              <p>Discover a wide range of products and enjoy shopping with us!</p>
            </div>
        </section>

        <section class="projects" id="projects">

          {{-- <h1 class="title">Dresses Categories</h1>

          @foreach ($categories as $category)
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">{{ $category->name }}</h5>
                      <a href="{{ route('categories.products', ['id' => $category->id]) }}" class="btn btn-primary">View Products</a>
                  </div>
              </div>
          @endforeach --}}

          <h1 class="title">Dresses Categories</h1>
              <div class="content">
                
                @foreach ($categories as $category)
      
                <a href="{{ route('categories.products', [$category->id]) }}" class="project-card">
                    @if($category->id == 1)
                    <div class="project-image">
                        <img src="{{ asset("assets/images/brand/soiree2.jpeg") }}"/>
                    </div>
                    <div class="project-info">
                        <strong class="project-title">
                            <span>Soiree</span>
                        </strong>
                    </div>

                    @elseif($category->id == 2)
                        <div class="project-image">
                            <img src="{{ asset("assets/images/brand/wedding4.jpg") }}" />
                        </div>
                           
                        <div class="project-info">
                            <strong class="project-title">
                                <span>Wedding</span>
                            </strong>
                        </div>

                    

                    @elseif($category->id == 3)
                        <div class="project-image">
                            <img src="{{ asset("assets/images/brand/handmade.jpeg") }}" />
                        </div>
                           
                        <div class="project-info">
                            <strong class="project-title">
                                <span>Hand Made</span>
                            </strong>
                        </div>

                    @endif
                  </a>
                  @endforeach

                  {{-- <a href="{{ route('categories.products', ['id' => 1]) }}" class="project-card">
                      <div class="project-image">
                          <img src="{{ asset("assets/images/brand/soiree2.jpeg") }}"/>
                      </div>
                      <div class="project-info">
                          <strong class="project-title">
                              <span>Soiree</span>
                          </strong>
                      </div>
                    </a>
   --}}
          </div> 
      </section>

       
        
        

  
   
@endsection