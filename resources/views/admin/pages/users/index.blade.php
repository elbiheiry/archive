@extends('admin.layouts.master')
@section('title')
    المستخدمين
@endsection
@section('content')
    <div class="content">
        <div class="col-sm-12 page-heading">
            <div class="col-sm-6">
                <h2>المستخدمين</h2>
            </div><!--End col-md-6-->
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">الصفحه الرئيسيه</a></li>
                    <li class="active">المستخدمين</li>
                </ul>
            </div><!--End col-md-6-->
        </div>
        <div class="spacer-15"></div>
        <div class="widget" >
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="add-user-form">
                        <form action="{{route('admin.users')}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-6">
                                <label  for="display-name">صوره المستخدم</label>
                                <img class="img-responsive mr-bot-15 btn-product-image"  alt="user-image" src="{{asset('assets/admin/default.png')}}" style="cursor:pointer; height: 150px;" title="Pick an image">
                                <input type="file" style="display:none;" name="image">
                                <div class="text-danger text-center">برجاء الضغط علي الصوره لتغييرها</div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الاسم</label>
                                <input type="text" class="form-control" name="name" >
                            </div>

                            <div class="form-group col-sm-6">
                                <label>اسم المستخدم</label>
                                <input type="text" class="form-control" name="username" >
                            </div>

                            <div class="form-group col-sm-6">
                                <label>البريد الالكتروني</label>
                                <input type="email" class="form-control" name="email" >
                            </div>

                            <div class="form-group col-sm-6">
                                <label>رقم الهاتف</label>
                                <input type="text" class="form-control" name="phone" >
                            </div>

                            <div class="form-group col-sm-6">
                                <label>نوع المستخدم</label>
                                <select class="form-control" name="role" id="select-type">
                                    <option>-- اختر نوع المستخدم --</option>
                                    <option value="admin">مدير الموقع</option>
                                    <option value="senior">رئيس قسم</option>
                                    <option value="user">مستخدم عادي</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6 hidden" id="select-category">
                                <label>القسم</label>
                                <select class="form-control" name="category_id">
                                    <option value="0">-- اختر القسم --</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الرقم السري</label>
                                <input type="password" class="form-control" name="password" >
                            </div>

                            <div class="form-group col-sm-6">
                                <label>تاكيد الرقم السري</label>
                                <input type="password" class="form-control" name="re-password" >
                            </div>

                            <div class="col-sm-12 form-group">
                                <button class="custom-btn addBTN" type="submit">اضافه مستخدم <i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget" >
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered display nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr class="ticket-tr">
                                <th>اسم المستخدم</th>
                                <th>البريد الالكتروني</th>
                                <th>انشئ في</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="ticket-tr">
                                    <form class="form-horizontal" action="{{route('admin.users.change',['id' => $user->id])}}" method="post" enctype="multipart/form-data" onsubmit="return true;">
                                        {!! csrf_field() !!}
                                        <td>
                                            {{$user->username}}
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>{{$user->created_at->diffForHumans()}}</td>
                                        <td>
                                            @if(auth()->guard('admins')->user()->role == 'admin')
                                                <a href="{{route('admin.users.edit' ,['id' => $user->id])}}" class="btn btn-primary">تعديل <i class="fa fa-edit "> </i></a>
                                                <button class="btn btn-success" type="submit">
                                                    @if($user->active == 1)
                                                        الغاء التفعيل <i class="fa fa-eye"> </i>
                                                    @else
                                                        تفعيل <i class="fa fa-eye"> </i>
                                                    @endif
                                                </button>
                                                @else
                                                <span class="text-danger">غير مصرح لك ان تقوم بحذف او تعديل المستخدمين</span>
                                            @endif
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!--End Content-->

@endsection