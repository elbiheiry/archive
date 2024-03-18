@extends('admin.layouts.master')
@section('title')
    نتائج البحث
@endsection
@section('content')
    <div class="content">
        <div class="col-sm-12 page-heading">
            <div class="col-sm-6">
                <h2>نتائج البحث</h2>
            </div><!--End col-md-6-->
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">الصفحه الرئيسيه</a></li>
                    <li class="active">نتائج البحث</li>
                </ul>
            </div><!--End col-md-6-->
        </div>
        <div class="spacer-15"></div>
        <div class="widget" >
            <div class="widget-content">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        @if ($type == 'to')
                            <table class="table table-hover table-bordered display nowrap" cellspacing="0" width="100%">
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
                        @elseif ($type == 'from')
                            <table class="table table-hover table-bordered display nowrap" cellspacing="0" width="100%">
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
                        @elseif ($type == 'images')
                            <table class="table table-hover table-bordered display nowrap" cellspacing="0" width="100%">
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
                                            <a href="{{route('admin.images.edit' ,['id' => $archive->id])}}" class="icon-btn green-bc"><i class="fa fa-edit "> </i></a>
                                            <a data-url="{{route('admin.images.delete',['id' => $archive->id])}}" class="icon-btn btndelet"> <i class="fas fa-trash-alt"> </i></a>
                                            <a href="{{route('admin.images.single' ,['id' => $archive->id])}}" class="icon-btn red-bc"><i class="fa fa-eye "> </i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @elseif ($type == 'videos')
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
                        @elseif ($type == 'forms')
                            <table id="datatable" class="table table-hover table-bordered display nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr class="ticket-tr">
                                    <th>الرقم التعريفي</th>
                                    <th>رقم الملف</th>
                                    <th>الادراه </th>
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
                                            {{$archive->management}}
                                        </td>
                                        <td>
                                            {{$archive->group['name']}}
                                        </td>
                                        <td>
                                            {{$archive->category['name']}}
                                        </td>
                                        <td>{{$archive->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{route('admin.forms.edit' ,['id' => $archive->id])}}" class="icon-btn green-bc"><i class="fa fa-edit "> </i></a>
                                            <a data-url="{{route('admin.forms.delete',['id' => $archive->id])}}" class="icon-btn btndelet"> <i class="fas fa-trash-alt"> </i></a>
                                            <a href="{{route('admin.forms.single' ,['id' => $archive->id])}}" class="icon-btn red-bc"><i class="fa fa-eye "> </i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><!--End Content-->
@endsection