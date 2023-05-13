@extends('admin.Layouts.Dashboard')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <p style="align-content: center" class="card-header">This is {{ $user->name }}</p>

                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-8">
                            <h3>{{ $user->name }}</h3>
                            <p><span style="font-size: 20px">Email</span>:  {{ $user->email }}</p>
                            <p><span style="font-size: 20px">Phone</span>: {{ $user->phone }}</p>
                            <p><span style="font-size: 20px">Phone</span>: {{ $user->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        
        
        
    </div>
</div>

@endsection
