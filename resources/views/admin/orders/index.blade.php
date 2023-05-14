@extends('admin.Layouts.Dashboard')

@section('content')
    <!-- User Modal -->
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
                            <label for="item_price">Discount </label>
                            <input type="number" step="0.01" name="discount" id="discount" class="form-control" value="{{ old('discount') }}">
                        </div>

                        {{-- <div class="form-group">
                            <label for="total_price">Total Price</label>
                            <input type="text" name="total_price" id="total_price" class="form-control" value="{{ old('total_price') }}">
                        </div> --}}

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

    {{--
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
                                <label for="edit-name-{{$order->id}}">الاسم</label>
                                <input type="text" class="form-control" id="edit-name-{{$order->id}}" name="name" value="{{old('name') ?? $order->name}}" required />
                            </div>

                            <div class="form-group">
                                <label for="edit-description-{{$order->id}}">الوصف </label>
                                <input type="text" class="form-control" id="edit-description-{{$order->id}}" value="{{old('description') ?? $order->description}}" name="description" required />
                            </div>

                            <div class="form-group">
                                <label for="edit-price-{{$order->id}}">السعر </label>
                                <input type="number" id="edit-price-{{$order->id}}" class="form-control" value="{{old('price') ?? $order->price}}" name="price" required />
                            </div>

                            <div class="form-group">
                                <label for="user">User</label>
                                <select class="form-control" id="user" name="user_id">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-md-4 col-form-label text-md-end">الصورة</label>
    
                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
    
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> تعديل المدير </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">لوحة التحكم</h4><span
                    class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{$page_title}}</span>
            </div>
        </div>

        <div class="d-flex my-xl-auto right-content">
            <button type="button" data-bs-toggle="modal" data-bs-target="#add-user" class="btn btn-danger btn-icon mb-1 me-3"><i class="mdi mdi-plus"></i></button>

            <span class="btn btn-primary mb-1 me-1">
                <span>عدد المنتجات</span>
                <span class="badge  bg-white ms-1">{{$ordersCount}}</span>
            </span>
        </div>
    </div>
    <!-- breadcrumb -->

--}}

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
                                <th class="border-bottom-0">User</th>
                                <th class="border-bottom-0">Phone</th>
                                <th class="border-bottom-0">Product</th>
                                <th class="border-bottom-0">Category</th>
                                <th class="border-bottom-0">amount</th>
                                <th class="border-bottom-0">Price</th>
                                <th class="border-bottom-0">Discount</th>
                                <th class="border-bottom-0">Total Price</th>
                                <th class="border-bottom-0">Date Reservation</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr style="text-align: center">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->user->phone }}</td>
                                <td>{{ $order->product->name ?? 'N/A' }}</td>
                                <td>{{ $order->product->category->name ?? 'N/A'}}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->discount }}</td>
                                <td>{{ $order->total_price }}</td>
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
