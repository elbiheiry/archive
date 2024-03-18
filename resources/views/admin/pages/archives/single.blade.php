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
                            <label  for="display-name">الملفات</label>
                            <ul>
                                @foreach($archive->files as $index => $file)
                                    <li>
                                        <a href="{{asset('storage/uploads/archives/'.$file->image)}}" download target="_blank">Download #{{$index+1}} archive</a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                        <div class="form-group col-sm-6">
                            <label>رقم الملف</label>
                            <blockquote>{{$archive->file_number}}</blockquote>

                            @if($archive->from_to == 'from')
                                <label>رقم الوارد</label>
                                <blockquote>{{$archive->import_number}}</blockquote>

                                <label>تاريخ الملف</label>
                                <blockquote>{{$archive->file_date}}</blockquote>
                            @endif

                            <label>المجموعه</label>
                            <blockquote>
                                @foreach($groups as $group)
                                @if($archive->group_id == $group->id)
                                    {{$group->name}}
                                @endif
                                    @endforeach
                            </blockquote>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>اتجاه الملف</label>
                            <blockquote>
                                @if($archive->file_path == 'صادر الي')
                                    صادر الي
                                @elseif($archive->file_path == 'وارد من')
                                    وارد من
                                @elseif($archive->file_path == 'ارشيف')
                                    ارشيف
                                @elseif($archive->file_path == 'اخري')
                                    اخري
                                @endif
                            </blockquote>

                            <label>القسم</label>
                            <blockquote>
                                @foreach($categories as $category)
                                @if($archive->group_id == $category->id)
                                    {{$category->name}}
                                @endif
                                @endforeach
                            </blockquote>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>كيفيه الارسال</label>
                            <blockquote>
                                @if($archive->how_to_send == 'الفاكس')
                                    الفاكس
                                @elseif($archive->how_to_send == 'البريد')
                                    البريد
                                @elseif($archive->how_to_send == 'يد بيد')
                                    يد بيد
                                @elseif($archive->how_to_send == 'اخري')
                                    اخري
                                @endif
                            </blockquote>

                            <label>المسئول</label>
                            <blockquote>{{$archive->incharge}}</blockquote>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>الموضوع</label>
                            <blockquote>{{$archive->subject}}</blockquote>

                            <label>حاله الملف</label>
                            <blockquote>
                                @if($archive->file_status == 'يحتاج الي متابعه')
                                    يحتاج الي متابعه
                                    @else
                                    لا يحتاج الي متابعه
                                @endif
                            </blockquote>

                        </div>

                        <div class="form-group col-sm-6">
                            <label>تاريخ التسجيل</label>
                            <blockquote>{{$archive->register_date}}</blockquote>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>الملاحظات</label>
                            <blockquote>{{$archive->notes}}</blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--End Content-->
@endsection