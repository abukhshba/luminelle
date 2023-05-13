@extends('admin.Layouts.app')

@section('content')
  <div class="container-fluid">
    <h1>Welcome, {{ $admin->name }}</h1>
    <p>This is your dashboard. From here, you can manage your website's content.</p>
  </div>
@endsection
