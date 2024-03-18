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
                        <div class="form-group col-sm-12">
                            <label  for="display-name">الملف</label>
                            <a href="{{asset('storage/uploads/archives/'.$archive->image)}}" download="">Download file</a>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>رقم الملف</label>
                            <blockquote>{{$archive->file_number}}</blockquote>

                            <label>المجموعه</label>
                            <blockquote>{{$archive->group['name']}}</blockquote>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>الاداره</label>
                            <blockquote>{{$archive->management}}</blockquote>

                            <label>القسم</label>
                            <blockquote>{{$archive->category['name']}}</blockquote>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div><!--End Content-->
@endsection