
@extends('admin.Layouts.Dashboard')

@section('content')
    <!-- User Modal -->


    @foreach($orders as $order)
    <div class="modal fade" id="edit-user-{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{route('dashboard.orders.update', $order->id)}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="user">user</label>
                            <select class="form-control" id="user" name="user_id">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="product">product</label>
                            <select class="form-control" id="product" name="product_id">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group ">
                            <label for="edit-amount-{{$order->id}}">Amount</label>
                            <input type="number" class="form-control" id="edit-amount-{{$order->id}}" name="amount" value="{{old('amount') ?? $order->amount}}" required />
                        </div>

                        <div class="form-group ">
                            <label for="edit-price-{{$order->id}}">Product Price</label>
                            <input type="number" class="form-control" id="edit-price-{{$order->id}}" name="price" value="{{old('price') ?? $order->price}}" required />
                        </div>
                        
                       
                        <div class="form-group ">
                            <label for="edit-discount-{{$order->id}}">Discount </label>
                            <input type="number" class="form-control" id="edit-discount-{{$order->id}}" name="discount" value="{{old('discount') ?? $order->discount}}" required />
                        </div>

                        <div class="form-group ">
                            <label for="edit-deposit-{{$order->id}}">Deposit </label>
                            <input type="number" class="form-control" id="edit-deposit-{{$order->id}}" name="deposit" value="{{old('deposit') ?? $order->deposit}}" required />
                        </div> 

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="تم الطلب وبإنتظار دفع العربون" {{ $order->status == 'تم الطلب وبإنتظار دفع العربون' ? 'selected' : '' }}>تم الطلب وبإنتظار دفع العربون</option>
                                <option value="تم الحجز ودفع العربون" {{ $order->status == 'تم الحجز ودفع العربون' ? 'selected' : '' }}>تم الحجز ودفع العربون</option>
                                <option value="تم التسليم وانتهاء الحجز" {{ $order->status == 'تم التسليم وانتهاء الحجز' ? 'selected' : '' }}>تم التسليم وانتهاء الحجز</option>
                            </select>
                        </div>

                        <div class="form-group ">
                            <label for="edit-reservation_date-{{$order->id}}">Reservation Date: </label>
                            <input type="date" class="form-control" id="edit-reservation_date-{{$order->id}}" name="reservation_date" value="{{old('reservation_date') ?? $order->reservation_date}}" required />
                        </div> 


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> تعديل الطلب </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach
    
    <div class="modal fade" id="add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{route('dashboard.orders.store')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة منتج جديد</h5>
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
                                <label for="product">product</label>
                                <select class="form-control" id="product" name="product_id">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="form-group ">
                                <label for="amount">Amount:</label>
                                <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount') }}">
                            </div>
                    
                            <div class="form-group ">
                                <label for="item_price">Item Price:</label>
                                <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
                            </div>
                    
                            <div class="form-group ">
                                <label for="discount">Discount </label>
                                <input type="number" step="0.01" name="discount" id="discount" class="form-control" value="{{ old('discount') }}">
                            </div>

                            <div class="form-group ">
                                <label for="deposit">Deposit </label>
                                <input type="number" step="0.01" name="deposit" id="deposit" class="form-control" value="{{ old('deposit') }}">
                            </div>

                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="تم الطلب وبإنتظار دفع العربون" {{ old('status') == 'تم الطلب وبإنتظار دفع العربون' ? 'selected' : '' }}>تم الطلب وبإنتظار دفع العربون</option>
                                    <option value="تم الحجز ودفع العربون" {{ old('status') == 'تم الحجز ودفع العربون' ? 'selected' : '' }}>تم الحجز ودفع العربون</option>
                                    <option value="تم التسليم وانتهاء الحجز" {{ old('status') == 'تم التسليم وانتهاء الحجز' ? 'selected' : '' }}>تم التسليم وانتهاء الحجز</option>
                                </select>
                            </div>

                            <div class="form-group ">
                                <label for="item_price">Reservation Date:</label>
                                <input type="date" name="reservation_date" id="reservation_date" class="form-control" value="{{ old('reservation_date') }}">
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> اضافة المنتج </button>
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
                <span class="badge  bg-white ms-1">{{$ordersCount}}</span>
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
                                <th class="border-bottom-0">Code</th>
                                <th class="border-bottom-0">User</th>
                                <th class="border-bottom-0">Product</th>
                                <th class="border-bottom-0">amount</th>
                                <th class="border-bottom-0">Price</th>
                                <th class="border-bottom-0">Discount</th>
                                <th class="border-bottom-0">Total Price</th>
                                <th class="border-bottom-0">Deposit</th>
                                <th class="border-bottom-0">Status </th>
                                <th class="border-bottom-0">Date Reservation</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr style="text-align: center">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->code }}</td>
                                <td><span style="color: #00ae0f">{{ $order->user->name }} </span><br><span style="color: #ff4000"> {{ $order->user->phone }} </span> </td>
                                <td><span style="color: #00ae0f">{{ $order->product->name ?? 'N/A' }} </span><br> <span style="color: #ff4000"> {{ $order->product->category->name ?? 'N/A'}} </span></td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->discount }}</td>
                                <td><strong>{{ $order->total_price }}</strong></td>
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
                                {{-- <td>--}}
                                {{-- <a href="{{ route('dashboard.orders.show', $order->id) }}" class="btn btn-primary">View Items</a> --}}
                            
                              <td> 
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" title="تعديل المستخدم" data-bs-toggle="modal" data-bs-target="#edit-user-{{$order->id}}"><i class="far fa-edit"></i></button>

                                    <!-- Delete -->
                                    <form method="post" class="soft-delete-form" action="{{route('dashboard.orders.destroy', $order->id)}}" style="display:inline-block;margin:0">
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
