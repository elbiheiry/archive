@extends('admin.layouts.master')
@section('title')
    شاشه البحث
@endsection
@section('content')
    <div class="content">
        <div class="col-sm-12 page-heading">
            <div class="col-sm-6">
                <h2>شاشه البحث</h2>
            </div><!--End col-md-6-->
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">الصفحه الرئيسيه</a></li>
                    <li class="active">شاشه البحث</li>
                </ul>
            </div><!--End col-md-6-->
        </div>
        <div class="spacer-15"></div>
        <div class="widget" >
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="add-user-form">
                        <form action="{{route('admin.result')}}" method="GET" enctype="multipart/form-data" >
                            {!! csrf_field() !!}

                            <div class="form-group col-sm-6">
                                <label>رقم الملف</label>
                                <input type="text" class="form-control" name="search" >
                            </div>

                            <div class="form-group col-sm-6">
                                <label>نوع الارشيف</label>
                                <select class="form-control" name="type" >
                                    <option value="to">ارشيف الصادر</option>
                                    <option value="from">ارشيف الوارد</option>
                                    <option value="images">ارشيف الصور</option>
                                    <option value="forms">ارشيف النماذج</option>
                                    <option value="videos">ارشيف الفيديو</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الاقسام</label>
                                <select class="form-control" name="category_id" >
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>المجموعات</label>
                                <select class="form-control" name="group_id" >
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-12 form-group">
                                <button class="custom-btn" type="submit">بحث <i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--End Content-->

@endsection