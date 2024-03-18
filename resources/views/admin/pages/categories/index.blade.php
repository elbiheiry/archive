@extends('admin.layouts.master')
@section('title')
    الاقسام
@endsection
@section('content')
    <div class="content">
        <div class="col-sm-12 page-heading">
            <div class="col-sm-6">
                <h2>الاقسام</h2>
            </div><!--End col-md-6-->
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">الصفحه الرئيسيه</a></li>
                    <li class="active">الاقسام</li>
                </ul>
            </div><!--End col-md-6-->
        </div>
        <div class="spacer-15"></div>
        <div class="widget">
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="add-user-form">
                        <form action="{{route('admin.categories')}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-6">
                                <label>اسم القسم</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="col-sm-12 form-group">
                                <button class="custom-btn addBTN" type="submit">حفظ القسم <i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget">
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table  class="table table-hover table-bordered display nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr class="ticket-tr">

                                <th>اسم القسم</th>
                                <th>انشئ في</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)

                                <tr class="ticket-tr">
                                    <form class="form-horizontal" action="{{route('admin.categories.edit',['id' => $category->id])}}" method="post" enctype="multipart/form-data" onsubmit="return true;">
                                        {!! csrf_field() !!}
                                        <td>
                                            <input class="form-control" name="name" value="{{$category->name}}">
                                        </td>

                                        <td>{{$category->created_at->diffForHumans()}}</td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">تعديل <i class="fa fa-edit "> </i></button>
                                            <a data-url="{{route('admin.categories.delete',['id' => $category->id])}}" class="btn btn-danger btndelet btn">مسح <i class="fa fa-trash-o"> </i></a>
                                        </td>
                                    </form>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--End Widget-->
    </div><!--End Content-->
@endsection