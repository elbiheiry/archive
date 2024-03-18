@extends('admin.layouts.master')
@section('title')
    الملفات
@endsection
@section('content')
    <div class="content">
        <div class="col-sm-12 page-heading">
            <div class="col-sm-6">
                <h2>الملفات</h2>
            </div><!--End col-md-6-->
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">الصفحه الرئيسيه</a></li>
                    <li class="active">الملفات</li>
                </ul>
            </div><!--End col-md-6-->
        </div>
        <div class="spacer-15"></div>
        <div class="widget" >
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="add-user-form">
                        <form action="{{route('admin.forms.edit' ,['id' => $archive->id])}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-12">
                                <label  for="display-name">الملف</label>
                                <input type="file" name="image">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>رقم الملف</label>
                                <input type="text" class="form-control" name="file_number" value="{{$archive->file_number}}">

                                <label>المجموعه</label>
                                <select class="form-control" name="group_id">
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}" @if($archive->group_id == $group->id){{'selected'}}@endif>{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الاداره</label>
                                <input type="text" class="form-control" name="management" value="{{$archive->management}}">

                                <label>القسم</label>
                                <select class="form-control" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($archive->category_id == $category->id){{'selected'}}@endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-12 form-group">
                                <button class="custom-btn addBTN" type="submit">تاكيد تعديل الملف <i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--End Content-->
@endsection