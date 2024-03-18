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
                        <form action="{{route('admin.archives.edit' ,['id' => $archive->id])}}" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group col-sm-6">
                                <label>رقم الملف</label>
                                <input type="text" class="form-control" name="file_number" value="{{$archive->file_number}}" readonly>

                                @if($archive->from_to == 'from')
                                    <label>رقم الوارد</label>
                                    <input type="text" class="form-control" name="import_number" value="{{$archive->import_number}}">

                                    <label>تاريخ الملف</label>
                                    <input type="text" class="form-control" name="file_date" value="{{$archive->file_date}}">
                                @endif

                                <label>المجموعه</label>
                                <select class="form-control" name="group_id">
                                    <option value="0"> -- برجاء اختيار المجموعه -- </option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}" @if($archive->group_id == $group->id){{'selected'}}@endif>{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>اتجاه الملف</label>
                                <select class="form-control" name="file_path">
                                    <option value="صادر الي" @if($archive->file_path == 'صادر الي'){{'selected'}}@endif>صادر الي</option>
                                    <option value="وارد من" @if($archive->file_path == 'وارد من'){{'selected'}}@endif>وارد من</option>
                                    <option value="ارشيف" @if($archive->file_path == 'ارشيف'){{'selected'}}@endif>ارشيف</option>
                                    <option value="اخري" @if($archive->file_path == 'اخري'){{'selected'}}@endif>اخري</option>
                                </select>

                                <label>القسم</label>
                                <select class="form-control" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($archive->category_id == $category->id){{'selected'}}@endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>كيفيه الارسال</label>
                                <select class="form-control" name="how_to_send">
                                    <option value="الفاكس" @if($archive->how_to_send == 'الفاكس'){{'selected'}}@endif>الفاكس</option>
                                    <option value="البريد" @if($archive->how_to_send == 'البريد'){{'selected'}}@endif>البريد</option>
                                    <option value="يد بيد" @if($archive->how_to_send == 'يد بيد'){{'selected'}}@endif>يد بيد</option>
                                    <option value="اخري" @if($archive->how_to_send == 'اخري'){{'selected'}}@endif>اخري</option>
                                </select>

                                <label>المسئول</label>
                                <input type="text" name="incharge" class="form-control" value="{{$archive->incharge}}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>الموضوع</label>
                                <input type="text" class="form-control" name="subject" value="{{$archive->subject}}">

                                <label>حاله الملف</label>
                                <select class="form-control" name="file_status">
                                    <option value="يحتاج الي متابعه" @if($archive->file_status == 'يحتاج الي متابعه'){{'selected'}}@endif>يحتاج الي متابعه</option>
                                    <option value="لا يحتاج الي متابعه" @if($archive->file_status == 'لا يحتاج الي متابعه'){{'selected'}}@endif>لا يحتاج الي متابعه</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>تاريخ التسجيل</label>
                                <input type="text" class="form-control form_date" name="register_date" value="{{$archive->register_date}}">

                                <label>الملاحظات</label>
                                <textarea rows="3" name="notes" class="form-control">{{$archive->notes}}</textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <button class="custom-btn addBTN" type="submit">تاكيد تعديل الملف <i class="fa fa-spinner fa-spin" style="font-size:15px; display: none;"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer-15"></div>
        <div class="widget" >
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover table-bordered display nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr class="ticket-tr">
                                <th>رقم الملف</th>
                                <th>تحميل الملف</th>
                                <th>انشئ في </th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($archive->files as $index => $file)
                                <tr class="ticket-tr">
                                    <td>
                                        {{$index+1}}
                                    </td>

                                    <td>
                                        <a href="{{asset('storage/uploads/archives/'.$file->image)}}" download target="_blank">Download #{{$index+1}} archive</a>
                                    </td>
                                    <td>{{$archive->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a data-url="{{route('admin.files.delete',['id' => $file->id])}}" class="icon-btn btndelet"> <i class="fas fa-trash-alt"> </i></a>
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