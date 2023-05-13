@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/profiles/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="img-thumbnail">
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $user->name }}</h3>
                            <p>Email: {{ $user->email }}</p>
                            <p>Phone: {{ $user->phone }}</p>
                            <p>Address: {{ $user->address }}</p>
                            <!-- Add any other profile information here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
