@extends('admin.layouts.master')
@section('title')
    العقود
@endsection
@section('content')
    <div class="content">
        <div class="col-sm-12 page-heading">
            <div class="col-sm-6">
                <h2>العقود</h2>
            </div><!--End col-md-6-->
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">الصفحه الرئيسيه</a></li>
                    <li class="active">العقود</li>
                </ul>
            </div><!--End col-md-6-->
        </div>
        <div class="spacer-15"></div>
        <div class="widget" >
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="add-user-form">
                        <form action="{{route('admin.contracts.edit' ,['id' => $contract->id])}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-12">
                                <label  for="display-name">الملف</label>
                                <input type="file" name="image">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>اسم الملف او الجهه المنوط بها</label>
                                <input type="text" class="form-control" name="name" value="{{$contract->name}}">

                                <label>تاريخ التسجيل</label>
                                <input type="date" name="register_date" class="form-control" value="{{$contract->register_date}}">

                                <label>تاريخ الانتهاء</label>
                                <input type="date" name="end_date" class="form-control" value="{{$contract->end_date}}">
                            </div>

                            <div class="col-sm-12 form-group">
                                <button class="custom-btn addBTN" type="submit"> <i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i>تاكيد تعديل الملف</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection