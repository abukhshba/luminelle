@extends('admin.Layouts.Dashboard')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <p style="align-content: center" class="card-header">This is {{ $product->name }}</p>
                <img src="{{ asset('storage/' . $product->image) }}" width="240" height="200" alt="{{ $product->name }}"></td>
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-8">
                            <h3>{{ $product->name }}</h3>
                            <p><span style="font-size: 20px">description</span>:  {{ $product->description }}</p>
                            <p><span style="font-size: 20px">price</span>: {{ $product->price }}</p>
                            <p><span style="font-size: 20px">category</span>: {{ $product->category->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        
        
        
    </div>
</div>

@endsection
