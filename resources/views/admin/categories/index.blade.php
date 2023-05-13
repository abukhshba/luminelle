@extends('admin.Layouts.Dashboard')

@section('content')
    <!-- User Modal -->
    <div class="modal fade" id="add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{route('dashboard.categories.store')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة صنف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label for="add-name">الاسم</label>
                            <input type="text" class="form-control" id="add-name" name="name" value="{{old('name')}}" required />
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> اضافة الصنف </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach($categories as $category)
        <div class="modal fade" id="edit-user-{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{route('dashboard.categories.update', $category->id)}}" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل المدير</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="edit-name-{{$category->id}}">الاسم</label>
                                <input type="text" class="form-control" id="edit-name-{{$category->id}}" name="name" value="{{old('name') ?? $category->name}}" required />
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
                <span>عدد الاصناف</span>
                <span class="badge  bg-white ms-1">{{$categoriesCount}}</span>
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
                            <tr>
                                <th>#</th>
                                <th class="border-bottom-0">اسم الصنف</th>
                                
                                <th class="border-bottom-0">الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody style="align-content: center" >
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                  

                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="tooltip" title="تعديل المدير" data-bs-toggle="modal" data-bs-target="#edit-user-{{$category->id}}"><i class="far fa-edit"></i></button>

                                        <!-- Delete -->
                                        <form method="post" class="soft-delete-form" action="{{route('dashboard.categories.destroy', $category->id)}}" style="display:inline-block;margin:0">
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
