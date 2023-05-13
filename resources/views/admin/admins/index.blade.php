@extends('admin.Layouts.Dashboard')

@section('content')
    <!-- User Modal -->
    <div class="modal fade" id="add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{route('dashboard.admins.store')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة مدير جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label for="add-name">الاسم</label>
                            <input type="text" class="form-control" id="add-name" name="name" value="{{old('name')}}" required />
                        </div>

                        <div class="form-group">
                            <label for="add-phonenumber">رقم الهاتف</label>
                            <input type="number" class="form-control" id="add-phonenumber" value="{{old('phone')}}" name="phone" required />
                        </div>

                        <div class="form-group">
                            <label for="add-email">البريد الإلكتروني</label>
                            <input type="email" id="add-email" class="form-control"  value="{{old('email')}}" name="email" required />
                        </div>

                        <div class="form-group">
                            <label for="add-password">كلمة المرور</label>
                            <input type="password" id="add-password" class="form-control" name="password" required />
                        </div>

                        <div class="form-group">
                            <label for="add-password-confirmation">تأكيد كلمة المرور</label>
                            <input type="password" id="add-password-confirmation" class="form-control" name="password_confirmation" required />
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> اضافة المدير </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach($admins as $admin)
        <div class="modal fade" id="edit-user-{{$admin->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{route('dashboard.admins.update', $admin->id)}}" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل المدير</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="edit-name-{{$admin->id}}">الاسم</label>
                                <input type="text" class="form-control" id="edit-name-{{$admin->id}}" name="name" value="{{old('name') ?? $admin->name}}" required />
                            </div>

                            <div class="form-group">
                                <label for="edit-phonenumber-{{$admin->id}}">رقم الهاتف</label>
                                <input type="number" class="form-control" id="edit-phonenumber-{{$admin->id}}" value="{{old('phone') ?? $admin->phone}}" name="phone" required />
                            </div>

                            <div class="form-group">
                                <label for="edit-email-{{$admin->id}}">البريد الإلكتروني</label>
                                <input type="email" id="edit-email-{{$admin->id}}" class="form-control" value="{{old('email') ?? $admin->email}}" name="email" required />
                            </div>

                            <div class="form-group">
                                <label for="edit-password-{{$admin->id}}">كلمة المرور</label>
                                <input type="password" id="edit-password-{{$admin->id}}" class="form-control" name="password" />
                            </div>

                            <div class="form-group">
                                <label for="edit-password-confirmation-{{$admin->id}}">تأكيد كلمة المرور</label>
                                <input type="password" id="edit-password-confirmation-{{$admin->id}}" class="form-control" name="password_confirmation" />
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
                <span>عدد المديرين</span>
                <span class="badge  bg-white ms-1">{{$adminsCount}}</span>
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
                        <table  style="align-content: center"  class="table table-striped mg-b-0 text-md-nowrap dl-table" id="basic-datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="border-bottom-0">اسم المدير</th>
                                <th class="wd-3p border-bottom-0">رقم الهاتف</th>
                                <th class="wd-3p border-bottom-0">البريد الالكتروني</th>
                                <th class="border-bottom-0">الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{$admin->id}}</td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->phone}}</td>
                                    <td>{{$admin->email}}</td>

                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="tooltip" title="تعديل المدير" data-bs-toggle="modal" data-bs-target="#edit-user-{{$admin->id}}"><i class="far fa-edit"></i></button>
                                        <a href="{{route('dashboard.admins.show' , $admin->id)}}"><button type="button" class="btn btn-success" data-toggle="tooltip" title="عرض المدير"  ><i class="fa-duotone fa-list"></i></button></a>

                                        <!-- Delete -->
                                        <form method="post" class="soft-delete-form" action="{{route('dashboard.admins.destroy', $admin->id)}}" style="display:inline-block;margin:0">
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
