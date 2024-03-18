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
                        <form action="{{route('admin.cards.edit',['id' => $card->id])}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-12">
                                <label  for="display-name">صوره الكارت</label>
                                <img class="img-responsive mr-bot-15 btn-product-image"  alt="user-image" src="{{asset('storage/uploads/cards/'.$card->image)}}" style="cursor:pointer; height: 150px;" title="Pick an image">
                                <input type="file" style="display:none;" name="image">
                                <div class="text-danger text-center">برجاء الضغط علي الصوره لتغييرها</div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الاسم باللغه العربيه</label>
                                <input type="text" class="form-control" name="ar_name" value="{{$card->ar_name}}">

                                <label>الاسم باللغه الانجليزيه</label>
                                <input type="text" class="form-control" name="en_name" value="{{$card->en_name}}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الوظيفه</label>
                                <input type="text" class="form-control" name="job" value="{{$card->job}}">

                                <label>المؤسسه</label>
                                <input type="text" class="form-control" name="institute" value="{{$card->institute}}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>رقم الهاتف</label>
                                <input type="text" class="form-control" name="phone" value="{{$card->phone}}">

                                <label>رقم الجوال</label>
                                <input type="text" class="form-control" name="mobile" value="{{$card->mobile}}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>ص.ب</label>
                                <input type="text" class="form-control" name="postal" value="{{$card->postal}}">

                                <label>البلد</label>
                                <input type="text" class="form-control" name="city" value="{{$card->city}}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الدوله</label>
                                <input type="text" class="form-control" name="country" value="{{$card->country}}">

                                <label>العنوان</label>
                                <input type="text" class="form-control" name="address" value="{{$card->address}}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>البريد الالكتروني</label>
                                <input type="email" class="form-control" name="email" value="{{$card->email}}">

                                <label>الموقع الالكتروني</label>
                                <input type="text" class="form-control" name="website" value="{{$card->website}}">
                            </div>

                            <div class="form-group col-sm-12">
                                <label>الملاحظات</label>
                                <textarea class="form-control" name="notes" >{{$card->notes}}</textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <button class="custom-btn addBTN" type="submit"><i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i> تاكيد اضافه الكارت الشخصي</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--End Content-->
@endsection