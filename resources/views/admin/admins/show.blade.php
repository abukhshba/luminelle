@extends('admin.Layouts.Dashboard')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <p style="align-content: center" class="card-header">Welcome {{ $admin->name }}</p>

                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-8">
                            <h3>{{ $admin->name }}</h3>
                            <p><span style="font-size: 20px">Email</span>:  {{ $admin->email }}</p>
                            <p><span style="font-size: 20px">Phone</span>: {{ $admin->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        
        
        
    </div>
</div>

@endsection
