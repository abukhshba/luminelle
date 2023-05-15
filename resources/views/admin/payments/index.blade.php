
@extends('admin.Layouts.Dashboard')

@section('content')
    <!-- User Modal -->

    @foreach($payments as $payment)
    <div class="modal fade" id="edit-user-{{$payment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{route('dashboard.payments.update', $payment->id)}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل المدفوعات</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="user">User</label>
                            <select class="form-control" id="user" name="user_id">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="product">Order</label>
                            <select class="form-control" id="product" name="order_id">
                                @foreach($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->code }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group ">
                            <label for="edit-amount-{{$payment->id}}">Amount</label>
                            <input type="number" class="form-control" id="edit-amount-{{$payment->id}}" name="amount" value="{{old('amount') ?? $payment->amount}}" required />
                        </div>

                       
                        <div class="form-group">
                            <label for="payment_method">Payment Method:</label>
                            <select name="payment_method" id="payment_method" class="form-control">
                                <option value="فودافون كاش" {{ $payment->payment_method == 'فودافون كاش' ? 'selected' : '' }}>فودافون كاش</option>
                                <option value="فورى" {{ $payment->payment_method == 'فورى' ? 'selected' : '' }}> فورى </option>
                                <option value="بطاقة ائتنان" {{ $payment->payment_method == 'بطاقة ائتنان' ? 'selected' : '' }}>بطاقة ائتنان </option>
                            </select>
                        </div> 


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> تعديل المدفوعات </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach
    
    <div class="modal fade" id="add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{route('dashboard.payments.store')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة مدفوع جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
        
                        <div class="modal-body">
                            @csrf
                           
                            <div class="form-group">
                                <label for="user">user</label>
                                <select class="form-control" id="user" name="user_id">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order">product</label>
                                <select class="form-control" id="order" name="order_id">
                                    @foreach($orders as $order)
                                        <option value="{{ $order->id }}">{{ $order->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="form-group ">
                                <label for="amount">Amount:</label>
                                <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount') }}">
                            </div>
                    
                            

                            <div class="form-group">
                                <label for="payment_method">Payment Method:</label>
                                <select name="payment_method" id="payment_method" class="form-control">
                                    <option value="فودافون كاش" {{ old('status') == 'فودافون كاش' ? 'selected' : '' }}>فودافون كاش </option>
                                    <option value="فورى" {{ old('status') == 'فورى' ? 'selected' : '' }}>فورى</option>
                                    <option value="بطاقة ائتنان" {{ old('status') == 'بطاقة ائتنان' ? 'selected' : '' }}>بطاقة ائتنان</option>
                                </select>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> اضافة المدفوعات </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
                        </div>

                        
                    </div>
                </form>
            </div>
        </div>

    <!-- breadcrumb -->
    
    <!-- breadcrumb -->


    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">لوحة التحكم</h4><span
                    class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{$page_title}}</span>
            </div>
        </div>

        <div class="d-flex my-xl-auto right-content">
            {{-- <a href="{{route('dashboard.orders.create')}}" class="btn btn-danger btn-icon mb-1 me-3"><i class="mdi mdi-plus"></i></a> --}}
            <button type="button" data-bs-toggle="modal" data-bs-target="#add-user" class="btn btn-danger btn-icon mb-1 me-3"><i class="mdi mdi-plus"></i></button>

            <span class="btn btn-primary mb-1 me-1">
                <span>عدد الطلبات</span>
                <span class="badge  bg-white ms-1">{{$paymentsCount}}</span>
            </span>
        </div>
    </div>
    {{--show table--}}
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
                            <tr style="text-align: center">
                                <th class="border-bottom-0">ID</th>
                                <th class="border-bottom-0">User</th>
                                <th class="border-bottom-0">Order Code</th>
                                <th class="border-bottom-0">amount</th>
                                <th class="border-bottom-0">Total Price</th>
                                <th class="border-bottom-0">Remain</th>
                                <th class="border-bottom-0">Payment Method</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                            <tr style="text-align: center">
                                <td>{{ $payment->id }}</td>
                                <td><span style="color: #00ae0f">{{ $payment->user->name }} </span><br><span style="color: #ff4000"> {{ $payment->user->phone }} </span> </td>
                                <td><span style="color: #00ae0f">{{ $payment->order->code ?? 'N/A' }} </span></td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->order->total_price }}</td>
                                <td>{{ $payment->remain }}</td>
                                <td>
                                <div
                                style="padding: 7px ; background-color: 
                                @if ($payment->status == 'فودافون كاش')
                                    #ff6d6d;
                                @elseif ($payment->status == 'فورى')
                                    #4cec5c;
                                @elseif ($payment->status == 'بطاقة ائتمان')
                                    #ecec4c;
                                @endif
                                ">{{ $payment->payment_method }}</div>
                                    {{-- {{ $order->status }} --}}
                                </td>
                            
                                
                                {{-- <a href="{{ route('dashboard.payments.show', $order->id) }}" class="btn btn-primary">View Items</a> --}}
                            
                                <td> 
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" title="تعديل المستخدم" data-bs-toggle="modal" data-bs-target="#edit-user-{{$payment->id}}"><i class="far fa-edit"></i></button>
                                <a href="{{ route('dashboard.orders.show', $order->id) }}" class="btn btn-primary">View Order</a>

                                    <!-- Delete -->
                                    <form method="post" class="soft-delete-form" action="{{route('dashboard.payments.destroy', $payment->id)}}" style="display:inline-block;margin:0">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="btn btn-danger delete" data-toggle="tooltip" title="الحذف"><i class="fas fa-trash"></i></button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </table>
            </div>

        </div>
    </div>
</div>


@endsection
