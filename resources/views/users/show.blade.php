@extends('layouts.app')

@section('content')
<div class="container-profile">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <p style="align-content: center" class="card-header">Welcome {{ $user->name }}</p>
  
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <img src="{{ asset('images/users/' . $user->image) }}" width="200" height="200" alt="{{ $user->name }}" class="img-thumbnail">
              </div>
              <div class="col-md-8">
                <h3>{{ $user->name }}</h3>
                <p><span style="font-size: 20px">Email</span>:  {{ $user->email }}</p>
                <p><span style="font-size: 20px">Phone</span>: {{ $user->phone }}</p>
                <p><span style="font-size: 20px">Address</span>: {{ $user->address }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
@endsection
