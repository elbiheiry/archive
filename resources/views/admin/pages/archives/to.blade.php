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
                        <form action="{{route('admin.archives')}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <input type="hidden" name="from_to" value="to">

                            <div class="form-group col-sm-12">
                                <label  for="display-name">الملف</label>
                                <input type="file" name="archives[]" multiple>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>رقم الملف</label>
                                <input type="text" class="form-control" name="file_number" value="out{{rand(1 , 999)}}-{{\Carbon\Carbon::now()->format('d-m-Y')}}" readonly>

                                <label>المجموعه</label>
                                <select class="form-control" name="group_id">
                                    <option value="0"> -- برجاء اختيار المجموعه -- </option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>اتجاه الملف</label>
                                <select class="form-control" name="file_path">
                                    <option value="0">-- اختار اتجاه الملف --</option>
                                    <option value="ارشيف">ارشيف</option>
                                    <option value="اخري">اخري</option>
                                </select>

                                <label>القسم</label>
                                <select class="form-control" name="category_id">
                                    <option value="0"> -- برجاء اختيار القسم -- </option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>كيفيه الارسال</label>
                                <select class="form-control" name="how_to_send">
                                    <option value="0">-- اختار طريقه ارسال الملف --</option>
                                    <option value="الفاكس">الفاكس</option>
                                    <option value="البريد">البريد</option>
                                    <option value="يد بيد">يد بيد</option>
                                    <option value="اخري">اخري</option>
                                </select>

                                <label>المسئول</label>
                                <input type="text" name="incharge" class="form-control">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الموضوع</label>
                                <input type="text" class="form-control" name="subject" >

                                <label>حاله الملف</label>
                                <select class="form-control" name="file_status" id="file-status">
                                    <option value="0">-- اختار حاله الملف --</option>
                                    <option value="يحتاج الي متابعه">يحتاج الي متابعه</option>
                                    <option value="لا يحتاج الي متابعه">لا يحتاج الي متابعه</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 hidden" id="file-status-date">
                                <label>تاريخ المتابعه</label>
                                <input type="text" class="form-control form_date" name="status_date">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>تاريخ التسجيل</label>
                                <input type="text" class="form-control" name="register_date" value="{{\Carbon\Carbon::now()}}" readonly>

                                <label>الملاحظات</label>
                                <textarea rows="3" name="notes" class="form-control"></textarea>
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
                                <th>الموضوع</th>
                                <th>المجموعه</th>
                                <th>القسم</th>
                                <th>حاله الملف</th>
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
                                            {{$archive->subject}}
                                        </td>
                                        <td>
                                            {{$archive->group['name']}}
                                        </td>
                                        <td>
                                            {{$archive->category['name']}}
                                        </td>
                                        <td>
                                            {{$archive->file_status}}
                                        </td>
                                        <td>{{$archive->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{route('admin.archives.edit' ,['id' => $archive->id])}}" class="icon-btn green-bc"><i class="fa fa-edit "> </i></a>
                                            <a data-url="{{route('admin.archives.delete',['id' => $archive->id])}}" class="icon-btn btndelet"> <i class="fas fa-trash-alt"> </i></a>
                                            <a href="{{route('admin.archive.single' ,['id' => $archive->id])}}" class="icon-btn red-bc"><i class="fa fa-eye "> </i></a>
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