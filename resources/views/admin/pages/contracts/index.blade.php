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
                        <form action="{{route('admin.contracts')}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-12">
                                <label  for="display-name">الملف</label>
                                <input type="file" name="image">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>اسم الملف او الجهه المنوط بها</label>
                                <input type="text" class="form-control" name="name">

                                <label>تاريخ التسجيل</label>
                                <input type="date" name="register_date" class="form-control">

                                <label>تاريخ الانتهاء</label>
                                <input type="date" name="end_date" class="form-control">
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
                                <th>اسم العقد</th>
                                <th>تاريخ التسجيل</th>
                                <th>تاريخ الانتهاء</th>
                                <th>انشئ في </th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($contracts as $index => $contract)
                                    <tr class="ticket-tr">
                                        <td>
                                            {{$contract->name}}
                                        </td>

                                        <td>
                                            {{$contract->register_date}}
                                        </td>
                                        <td>
                                            {{$contract->end_date}}
                                        </td>
                                        <td>{{$contract->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{route('admin.contracts.edit' ,['id' => $contract->id])}}" class="icon-btn green-bc"><i class="fa fa-edit "> </i></a>
                                            <a data-url="{{route('admin.contracts.delete',['id' => $contract->id])}}" class="icon-btn btndelet"> <i class="fas fa-trash-alt"> </i></a>
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