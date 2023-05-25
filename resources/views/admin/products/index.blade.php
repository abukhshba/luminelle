@extends('admin.Layouts.Dashboard')

@section('content')
    <!-- User Modal -->
    <div class="modal fade" id="add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{route('dashboard.products.store')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضاف جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label for="add-name">الاسم</label>
                            <input type="text" class="form-control" id="add-name" name="name" value="{{old('name')}}" required />
                        </div> 
                        <div class="form-group">
                            <label for="add-description">الوصف</label>
                            <input type="text" class="form-control" id="add-description" name="description" value="{{old('description')}}" required />
                        </div>

                        <div class="form-group">
                            <label for="add-price"> السعر</label>
                            <input type="number" class="form-control" id="add-price" value="{{old('price')}}" name="price" required />
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="images">Product Images</label>
                            <input type="file" name="images[]" id="images" multiple accept="image/*">
                            <small class="form-text text-muted">You can select multiple images.</small>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                           @enderror

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

    @foreach($products as $product)
        <div class="modal fade" id="edit-user-{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{route('dashboard.products.update', $product->id)}}" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="edit-name-{{$product->id}}">الاسم</label>
                                <input type="text" class="form-control" id="edit-name-{{$product->id}}" name="name" value="{{old('name') ?? $product->name}}" required />
                            </div>

                            <div class="form-group">
                                <label for="edit-description-{{$product->id}}">الوصف </label>
                                <input type="text" class="form-control" id="edit-description-{{$product->id}}" value="{{old('description') ?? $product->description}}" name="description" required />
                            </div>

                            <div class="form-group">
                                <label for="edit-price-{{$product->id}}">السعر </label>
                                <input type="number" id="edit-price-{{$product->id}}" class="form-control" value="{{old('price') ?? $product->price}}" name="price" required />
                            </div>product

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="images">Product Images</label>
                                <input type="file" name="images[]" id="images" multiple accept="image/*">
                                <small class="form-text text-muted">You can select multiple images.</small>
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
                <span class="badge  bg-white ms-1">{{$productsCount}}</span>
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
                                <th class="border-bottom-0">اسم المنتج</th>
                                <th class="wd-3p border-bottom-0"> الوصف</th>
                                <th class="wd-3p border-bottom-0">السعر  </th>
                                <th class="wd-3p border-bottom-0"> الصنف</th>
                                <th class="wd-3p border-bottom-0"> الصورة</th>
                                <th class="border-bottom-0">الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr style="text-align: center">
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->category->name}}</td>

                                    <td>
                                    
                                        @if ($product->images->count() > 0)
                                        <img src="{{ asset('storage/' . $product->images->first()->image) }}" height="100px" class="card-img-top" alt="{{ $product->name }}">
                                        @endif

                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="tooltip" title="تعديل المستخدم" data-bs-toggle="modal" data-bs-target="#edit-user-{{$product->id}}"><i class="far fa-edit"></i></button>
                                        <a href="{{route('dashboard.products.show' , $product->id)}}"><button type="button" class="btn btn-success" data-toggle="tooltip" title="عرض المنتج"  ><i class="far fa-eye"></i></button></a>

                                        <!-- Delete -->
                                        <form method="post" class="soft-delete-form" action="{{route('dashboard.products.destroy', $product->id)}}" style="display:inline-block;margin:0">
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
