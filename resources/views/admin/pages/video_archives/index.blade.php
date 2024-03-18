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
                        <form action="{{route('admin.videos')}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-6">
                                <label>رقم الملف</label>
                                <input type="text" class="form-control" name="file_number" value="Video{{rand(1 , 999)}}-{{\Carbon\Carbon::now()->format('d-m-Y')}}" disabled>

                                <label>المجموعه</label>
                                <select class="form-control" name="group_id">
                                    <option value="0"> -- برجاء اختيار المجموعه -- </option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>اسم الالبوم</label>
                                <input type="text" class="form-control" name="name" >

                                <label>القسم</label>
                                <select class="form-control" name="category_id">
                                    <option value="0"> -- برجاء اختيار القسم -- </option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label  for="display-name">رابط الفيديو</label>
                                <input type="text" name="video" class="form-control">

                                <label>المكان/الموقع/البلد</label>
                                <input type="text" class="form-control" name="location" >
                            </div>

                            <div class="col-sm-12 form-group">
                                <button class="custom-btn addBTN" type="submit">تاكيد اضافه الملف <i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i></button>
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
                        <table id="datatable" class="table table-hover table-bordered display nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr class="ticket-tr">
                                <th>الرقم التعريفي</th>
                                <th>رقم الملف</th>
                                <th>الاسم</th>
                                <th>المجموعه</th>
                                <th>القسم</th>
                                <th>انشئ في </th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($archives as $index => $archive)
                                    <tr class="ticket-tr">
                                        <td>
                                            {{$index+1}}
                                        </td>

                                        <td>
                                            {{$archive->file_number}}
                                        </td>
                                        <td>
                                            {{$archive->name}}
                                        </td>
                                        <td>
                                            {{$archive->group['name']}}
                                        </td>
                                        <td>
                                            {{$archive->category['name']}}
                                        </td>
                                        <td>{{$archive->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{route('admin.videos.edit' ,['id' => $archive->id])}}" class="icon-btn green-bc"><i class="fa fa-edit "> </i></a>
                                            <a data-url="{{route('admin.videos.delete',['id' => $archive->id])}}" class="icon-btn btndelet"> <i class="fas fa-trash-alt"> </i></a>
                                            <a href="{{route('admin.videos.single' ,['id' => $archive->id])}}" class="icon-btn red-bc"><i class="fa fa-eye "> </i></a>
                                        </td>
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