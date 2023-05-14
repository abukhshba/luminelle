@extends('admin.Layouts.Dashboard')

@section('content')

{{-- 
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
     
        
</div> --}}
        
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">لوحة التحكم</h4><span
                    class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{$page_title}}</span>
            </div>
        </div>

        <div class="d-flex my-xl-auto right-content">
            <a href="{{route('dashboard.orders.index')}}" class="btn btn-danger mb-1 me-1">العودة للطلبات</a>
            
        </div>
    </div>
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$page_title}}</h3>
            </div>

            <div class="card-body">
                @include('messages')

                <div class="table-responsive">
                    <table class="table table-striped mg-b-0 text-md-nowrap dl-table" id="basic-datatable">

                        <thead>
                        <tr>
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0">Item</th>
                            <th class="border-bottom-0">Amount</th>
                            <th class="border-bottom-0">Price</th>
                            <th class="border-bottom-0">Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderItems as $item)
                            <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->item_price }}</td>
                            <td>{{ $item->item_total_price }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="1"><strong>Total</strong></td>
                            <td  class="border-bottom-0"><strong>{{ $order->total_price }}</strong></td>
                        </tr>
                        </tbody>
                    </table>
  

@endsection
