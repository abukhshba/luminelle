@extends('admin.Layouts.Dashboard')

@section('content')
    <!-- User Modal -->
    <div class="modal fade" id="add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{route('dashboard.users.store')}}" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <label for="image">الصورة الشخصية</label>
                            <div class="sec-2">
                                <i class="lni lni-user"></i>
                                <input type="file" id="image" name="image"/>
                            </div>
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

    @foreach($users as $user)
        <div class="modal fade" id="edit-user-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{route('dashboard.users.update', $user->id)}}" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل المدير</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="edit-name-{{$user->id}}">الاسم</label>
                                <input type="text" class="form-control" id="edit-name-{{$user->id}}" name="name" value="{{old('name') ?? $user->name}}" required />
                            </div>

                            <div class="form-group">
                                <label for="edit-phonenumber-{{$user->id}}">رقم الهاتف</label>
                                <input type="number" class="form-control" id="edit-phonenumber-{{$user->id}}" value="{{old('phone') ?? $user->phone}}" name="phone" required />
                            </div>

                            <div class="form-group">
                                <label for="edit-email-{{$user->id}}">البريد الإلكتروني</label>
                                <input type="email" id="edit-email-{{$user->id}}" class="form-control" value="{{old('email') ?? $user->email}}" name="email" required />
                            </div>

                            <div class="form-group">
                                <label for="edit-password-{{$user->id}}">كلمة المرور</label>
                                <input type="password" id="edit-password-{{$user->id}}" class="form-control" name="password" />
                            </div>

                            <div class="form-group">
                                <label for="edit-password-confirmation-{{$user->id}}">تأكيد كلمة المرور</label>
                                <input type="password" id="edit-password-confirmation-{{$user->id}}" class="form-control" name="password_confirmation" />
                            </div>

                            <div class="form-group">
                                <label for="image">الصورة الشخصية</label>
                                <div class="sec-2">
                                    <i class="lni lni-user"></i>
                                    <input type="file" id="image" name="image"/>
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
                <h4 class="content-title mb-0 my-auto">لوحة التحكم </h4><span
                    class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{$page_title}}</span>
            </div>
        </div>

        <div class="d-flex my-xl-auto right-content">
            <button type="button" data-bs-toggle="modal" data-bs-target="#add-user" class="btn btn-danger btn-icon mb-1 me-3"><i class="mdi mdi-plus"></i></button>

            <span class="btn btn-primary mb-1 me-1">
                <span>عدد المستخدمين</span>
                <span class="badge  bg-white ms-1">{{$usersCount}}</span>
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
                                <th class="border-bottom-0">اسم المدير</th>
                                <th class="wd-3p border-bottom-0">رقم الهاتف</th>
                                <th class="wd-3p border-bottom-0">البريد الالكتروني</th>
                                <th class="wd-3p border-bottom-0"> العنوان</th>
                                <th class="wd-3p border-bottom-0"> الصورة الشخصية</th>
                                <th class="border-bottom-0">الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->address}}</td>
                                    <td><div>
                                        <img src="{{ asset('images/users/' . $user->image) }}" alt="{{ $user->name }}" class="img-thumbnail" style="width: 100px; height: 100px;">
                                    </div></td>

                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="tooltip" title="تعديل المستخدم" data-bs-toggle="modal" data-bs-target="#edit-user-{{$user->id}}"><i class="far fa-edit"></i></button>
                                        <a href="{{route('dashboard.users.show' , $user->id)}}"><button type="button" class="btn btn-success" data-toggle="tooltip" title="عرض المدير"  ><i class="fa-solid fa-list"></i></button></a>

                                        <!-- Delete -->
                                        <form method="post" class="soft-delete-form" action="{{route('dashboard.users.destroy', $user->id)}}" style="display:inline-block;margin:0">
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
