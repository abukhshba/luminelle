@extends('admin.Layouts.Dashboard')

@section('content')
    <!-- User Modal -->
    <div class="modal fade" id="add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{route('dashboard.reviews.store')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضاف تقييم جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label for="category">User</label>
                            <select class="form-control" id="user" name="user_id">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product">Product</label>
                            <select class="form-control" id="product" name="product_id">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="add-rating">Ratting</label>
                            <input type="text" step="0.1" min="0" max="5" class="form-control" id="add-rating" name="rating" value="{{old('rating')}}" required />
                        </div>

                        <div class="form-group">
                            <label for="add-comment">Comment: </label>
                            <input type="text" class="form-control" id="add-comment" name="comment" value="{{old('comment')}}" required />
                        </div> 
                        
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> اضافة التقييم </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach($reviews as $review)
        <div class="modal fade" id="edit-user-{{$review->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{route('dashboard.reviews.update', $review->id)}}" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            @csrf
                            @method('PUT')


                            <div class="form-group">
                                <label for="category">User</label>
                                <select class="form-control" id="user" name="user_id">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Product</label>
                                <select class="form-control" id="user" name="user_id">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit-rating-{{$review->id}}">Ratting</label>
                                <input type="text" class="form-control" id="edit-rating-{{$review->id}}" name="rating" value="{{old('rating') ?? $review->rating}}" required />
                            </div>

                            <div class="form-group">
                                <label for="edit-comment-{{$review->id}}">Comment </label>
                                <input type="text" class="form-control" id="edit-comment-{{$review->id}}" value="{{old('comment') ?? $review->comment}}" name="description" required />
                            </div>

                 

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> تعديل التقييم </button>
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
                <span>عدد التقييمات</span>
                <span class="badge  bg-white ms-1">{{$reviewsCount}}</span>
            </span>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- Row -->
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
                                <th>#</th>
                                <th class="border-bottom-0">User </th>
                                <th class="wd-3p border-bottom-0"> Product</th>
                                <th class="wd-3p border-bottom-0">Rating  </th>
                                <th class="wd-3p border-bottom-0"> Comment</th>
                                <th class="border-bottom-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $review)
                                <tr style="text-align: center">
                                    <td>{{$review->id}}</td>
                                    <td>{{$review->user->name}}</td>
                                    <td>{{$review->product->name}}</td>
                                    <td>{{$review->rating}}</td>
                                    <td>{{$review->comment}}</td>
                                   
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="tooltip" title="تعديل  التقييم" data-bs-toggle="modal" data-bs-target="#edit-user-{{$review->id}}"><i class="far fa-edit"></i></button>

                                        <!-- Delete -->
                                        <form method="post" class="soft-delete-form" action="{{route('dashboard.reviews.destroy', $review->id)}}" style="display:inline-block;margin:0">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-danger delete" data-toggle="tooltip" title="الحذف"><i class="fas fa-trash"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- {{$admins->withQueryString()}} --}}
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
