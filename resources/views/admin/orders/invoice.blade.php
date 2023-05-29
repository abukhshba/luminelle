@extends('admin.Layouts.Dashboard')

@section('content')


<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">لوحة التحكم</h4><span
                class="text-muted mt-1 tx-13 ms-2 mb-0">/ فاتورة  </span>
        </div>
    </div>

    <div class="d-flex my-xl-auto right-content">
        <a href="{{route('dashboard.orders.index')}}"><button  type="button" class="btn btn-danger">العودة للطلبات</button></a>

    </div>

</div>




<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">فاتورة رقم {{ $order->code }}</h3>
                <p class="card-title">Order date: {{ $order->created_at }}</p>
            </div>

            <div class="card-body">
                @include('messages')

                <div class="table-responsive">
                    <table class="table table-striped mg-b-0 text-md-nowrap dl-table" id="basic-datatable">
                        <thead>
                            <tr style="text-align: center">
                                <th class="border-bottom-0">ID</th>
                                <th class="border-bottom-0">Code</th>
                                <th class="border-bottom-0">User</th>
                                <th class="border-bottom-0">Product</th>
                                <th class="border-bottom-0">Price</th>
                                <th class="border-bottom-0">Deposit</th>
                                <th class="border-bottom-0">Status </th>
                                <th class="border-bottom-0">Date Reservation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align: center">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->code }}</td>
                                <td><span style="color: #00ae0f">{{ $order->user->name }} </span><br><span style="color: #ff4000"> {{ $order->user->phone }} </span> </td>
                                <td><span style="color: #00ae0f">{{ $order->product->name ?? 'N/A' }} </span><br> <span style="color: #ff4000"> {{ $order->product->category->name ?? 'N/A'}} </span></td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->deposit }}</td>
                                <td>
                                <div
                                style="padding: 7px ; background-color: 
                                @if ($order->status == 'تم الطلب وبإنتظار دفع العربون')
                                    #ff6d6d;
                                @elseif ($order->status == 'تم الحجز ودفع العربون')
                                    #4cec5c;
                                @elseif ($order->status == 'تم التسليم وانتهاء الحجز')
                                    #ecec4c;
                                @endif
                                ">{{ $order->status }}</div>
                                    {{-- {{ $order->status }} --}}
                                </td>
                            
                                <td>{{ $order->reservation_date}}</td>
                            
                            </tr>
                        </tbody>
                       
                    </table>
                    <div style="padding: 5px; margin-left: 500px ;margin-top: 20px ; font-size: 25px">
                           
                        <span ><strong>Total :</strong></span>
                        <span><strong> {{ $order->price }} </strong><span> EGP</span></span> 
                </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
