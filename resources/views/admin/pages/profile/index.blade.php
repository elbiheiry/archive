@extends('admin.layouts.master')
@section('title')
    الصفحه الشخصيه
@endsection
@section('content')
    <div class="content">
        <div class="col-sm-12 page-heading">
            <div class="col-sm-6">
                <h2>الصفحه الشخصيه</h2>
            </div><!--End col-md-6-->
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">الصفحه الرئيسيه</a></li>
                    <li class="active">الصفحه الشخصيه</li>
                </ul>
            </div><!--End col-md-6-->
        </div>
        <div class="spacer-15"></div>
        <div class="widget">
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="add-user-form">
                        <form action="{{route('admin.profile')}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-6">
                                <label  for="display-name">صوره المستخدم</label>
                                <img class="img-responsive mr-bot-15 btn-product-image"  alt="user-image" src="{{asset('storage/uploads/users/'.$user->image)}}" style="cursor:pointer;" title="Pick an image">
                                <input type="file" style="display:none;" name="image">
                            </div>

                            <div class="form-group col-sm-6">
                                <label >الاسم</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>البريد الالكتروني</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label >اسم المستخدم</label>
                                <input type="text" class="form-control" name="username" value="{{$user->username}}">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label >رقم الهاتف</label>
                                <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>الرقم السري</label>
                                <input type="password" class="form-control" name="password" >
                            </div>
                            <div class="col-sm-12 form-group">
                                <button class="custom-btn addBTN" type="submit">تاكيد <i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--End Widget-->
    </div><!--End Content-->
@endsection