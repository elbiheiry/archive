@extends('admin.layouts.master')
@section('title')
    الكروت الشخصيه
@endsection
@section('content')
    <div class="content">
        <div class="col-sm-12 page-heading">
            <div class="col-sm-6">
                <h2>الكروت الشخصيه</h2>
            </div><!--End col-md-6-->
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">الصفحه الرئيسيه</a></li>
                    <li class="active">الكروت الشخصيه</li>
                </ul>
            </div><!--End col-md-6-->
        </div>
        <div class="spacer-15"></div>
        <div class="widget" >
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="add-user-form">

                        <div class="form-group col-sm-12">
                            <label  for="display-name">صوره الكارت</label>
                            <img class="img-responsive mr-bot-15 "  alt="user-image" src="{{asset('storage/uploads/cards/'.$card->image)}}" style="cursor:pointer; height: 150px;" title="Pick an image">
                        </div>

                        <div class="form-group col-sm-6">
                            <label>الاسم باللغه العربيه</label>
                            <blockquote>{{$card->ar_name}}</blockquote>

                            <label>الاسم باللغه الانجليزيه</label>
                            <blockquote>{{$card->en_name}}</blockquote>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>الوظيفه</label>
                            <blockquote>{{$card->job}}</blockquote>

                            <label>المؤسسه</label>
                            <blockquote>{{$card->institute}}</blockquote>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>رقم الهاتف</label>
                            <blockquote>{{$card->phone}}</blockquote>

                            <label>رقم الجوال</label>
                            <blockquote>{{$card->mobile}}</blockquote>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>ص.ب</label>
                            <blockquote>{{$card->postal}}</blockquote>

                            <label>البلد</label>
                            <blockquote>{{$card->city}}</blockquote>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>الدوله</label>
                            <blockquote>{{$card->country}}</blockquote>

                            <label>العنوان</label>
                            <blockquote>{{$card->address}}</blockquote>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>البريد الالكتروني</label>
                            <blockquote>{{$card->email}}</blockquote>

                            <label>الموقع الالكتروني</label>
                            <blockquote>{{$card->website}}</blockquote>
                        </div>

                        <div class="form-group col-sm-12">
                            <label>الملاحظات</label>
                            <blockquote>{{$card->notes}}</blockquote>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div><!--End Content-->
@endsection