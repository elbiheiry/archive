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
                        <form action="{{route('admin.cards')}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-12">
                                <label  for="display-name">صوره الكارت</label>
                                <img class="img-responsive mr-bot-15 btn-product-image"  alt="user-image" src="{{asset('assets/admin/default.png')}}" style="cursor:pointer; height: 150px;" title="Pick an image">
                                <input type="file" style="display:none;" name="image">
                                <div class="text-danger text-center">برجاء الضغط علي الصوره لتغييرها</div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الاسم باللغه العربيه</label>
                                <input type="text" class="form-control" name="ar_name" >

                                <label>الاسم باللغه الانجليزيه</label>
                                <input type="text" class="form-control" name="en_name" >
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الوظيفه</label>
                                <input type="text" class="form-control" name="job" >

                                <label>المؤسسه</label>
                                <input type="text" class="form-control" name="institute" >
                            </div>

                            <div class="form-group col-sm-6">
                                <label>رقم الهاتف</label>
                                <input type="text" class="form-control" name="phone" >

                                <label>رقم الجوال</label>
                                <input type="text" class="form-control" name="mobile" >
                            </div>

                            <div class="form-group col-sm-6">
                                <label>ص.ب</label>
                                <input type="text" class="form-control" name="postal" >

                                <label>البلد</label>
                                <input type="text" class="form-control" name="city" >
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الدوله</label>
                                <input type="text" class="form-control" name="country" >

                                <label>العنوان</label>
                                <input type="text" class="form-control" name="address" >
                            </div>
                            <div class="form-group col-sm-6">
                                <label>البريد الالكتروني</label>
                                <input type="email" class="form-control" name="email" >

                                <label>الموقع الالكتروني</label>
                                <input type="text" class="form-control" name="website" >
                            </div>

                            <div class="form-group col-sm-12">
                                <label>الملاحظات</label>
                                <textarea class="form-control" name="notes" ></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <button class="custom-btn addBTN" type="submit">تاكيد اضافه الكارت الشخصي <i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i></button>
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
                                <th>المؤسسه</th>
                                <th>الجوال</th>
                                <th>البريد الالكتروني</th>
                                <th>انشئ في </th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cards as $index => $card)
                                <tr class="ticket-tr">
                                    <td>
                                        {{$index+1}}
                                    </td>

                                    <td>
                                        {{$card->id}}
                                    </td>

                                    <td>
                                        {{$card->ar_name}}
                                    </td>
                                    <td>
                                        {{$card->institute}}
                                    </td>
                                    <td>
                                        {{$card->mobile}}
                                    </td>
                                    <td>
                                        {{$card->email}}
                                    </td>

                                    <td>{{$card->created_at->diffForHumans()}}</td>
                                    <td>
                                        @if(auth()->guard('admins')->user()->role != 'user')
                                            <a href="{{route('admin.cards.edit' ,['id' => $card->id])}}" class="icon-btn green-bc"><i class="fa fa-edit "> </i></a>
                                            <a data-url="{{route('admin.cards.delete',['id' => $card->id])}}" class="icon-btn btndelet"> <i class="fas fa-trash-alt"> </i></a>
                                        @endif
                                        <a href="{{route('admin.cards.single' ,['id' => $card->id])}}" class="icon-btn red-bc"><i class="fa fa-eye "> </i></a>
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