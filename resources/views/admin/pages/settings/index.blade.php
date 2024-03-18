@extends('admin.layouts.master')
@section('title')
    بيانات الموقع
@endsection
@section('content')
    <div class="content">
        <div class="col-sm-12 page-heading">
            <div class="col-sm-6">
                <h2>بيانات الموقع</h2>
            </div><!--End col-md-6-->
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">الصفحه الرئيسيه</a></li>
                    <li class="active">بيانات الموقع</li>
                </ul>
            </div><!--End col-md-6-->
        </div>
        <div class="spacer-15"></div>
        <div class="widget">
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="add-user-form">
                        <form action="{{route('admin.settings')}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-6">
                                <label  for="display-name">لوجو الموقع</label>
                                <img class="img-responsive mr-bot-15 btn-product-image"  alt="user-image" src="{{asset('storage/uploads/logo/'.$settings->site_logo)}}" style="cursor:pointer;" title="Pick an image">
                                <input type="file" style="display:none;" name="site_logo">
                                <div class="text-danger text-center">برجاء الضغط علي الصوره لتغييرها</div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label >اسم الموقع</label>
                                <input type="text" class="form-control" name="site_name" value="{{$settings->site_name}}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label >البريد الالكتروني</label>
                                <input type="text" class="form-control" name="email" value="{{$settings->email}}">
                            </div>

                            <div class="col-sm-12 form-group">
                                <button class="custom-btn addBTN" type="submit">حفظ <i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--End Widget-->
    </div><!--End Content-->

@endsection