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
                        <form action="{{route('admin.users.edit' ,['id' => $user->id])}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-6">
                                <label  for="display-name">الصوره</label>
                                <img class="img-responsive mr-bot-15 btn-product-image" alt="user-image" src="{{asset('storage/uploads/users/'.$user->image)}}" style="cursor:pointer; height: 150px;" title="Pick an image">
                                <input type="file" style="display:none;" name="image">
                                <div class="text-danger text-center">برجاء الضغط علي الصوره لتغييرها</div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الاسم</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>اسم المستخدم</label>
                                <input type="text" class="form-control" name="username" value="{{$user->username}}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>البريد الالكتروني</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>رقم الهاتف</label>
                                <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>نوع المستخدم</label>
                                <select class="form-control" name="role">
                                    <option value="admin" @if($user->role == 'admin'){{'selected'}}@endif>مدير الموقع</option>
                                    <option value="senior" @if($user->role == 'senior'){{'selected'}}@endif>رئيس قسم</option>
                                    <option value="user" @if($user->role == 'user'){{'selected'}}@endif>مستخدم عادي</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6 @if($user->role == 'admin'){{'hidden'}}@endif">
                                <label>القسم</label>
                                <select class="form-control" name="category_id">
                                    <option value="0" @if($user->category_id  == 0){{'selected'}}@endif>-- اختر القسم --</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($user->category_id  == $category->id){{'selected'}}@endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-sm-6">
                                <label>الرقم السري</label>
                                <input type="password" class="form-control" name="password" >
                            </div>

                            <div class="col-sm-12 form-group">
                                <button class="custom-btn addBTN" type="submit"> <i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i>حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--End Content-->

@endsection