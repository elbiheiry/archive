@extends('admin.layouts.master')
@section('title')
    Home page
@endsection
@section('content')
    <div class="content">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-content">
                    <div class="col-sm-12">
                        <a href="{{route('admin.dashboard')}}" class="home-logo">
                            <span>{{$settings->site_name}}</span>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{route('admin.users')}}" class="counter">
                            <h3 class="timer" data-to="{{\App\User::count()}}" data-speed="1500"></h3>
                            <div class="count-name">المستخدمين</div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{route('admin.categories')}}" class="counter">
                            <h3 class="timer" data-to="{{\App\Category::count()}}" data-speed="1500"></h3>
                            <div class="count-name">الاقسام</div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{route('admin.archives.to')}}" class="counter">
                            <h3 class="timer" data-to="{{\App\Archive::where('from_to' , 'to')->count()}}" data-speed="1500"></h3>
                            <div class="count-name">الارشيف الصادره</div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{route('admin.archives.from')}}" class="counter">
                            <h3 class="timer" data-to="{{\App\Archive::where('from_to' , 'from')->count()}}" data-speed="1500"></h3>
                            <div class="count-name">الارشيف الوارد</div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{route('admin.forms')}}" class="counter">
                            <h3 class="timer" data-to="{{\App\FormArchive::count()}}" data-speed="1500"></h3>
                            <div class="count-name">ارشيف النماذج</div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{route('admin.images')}}" class="counter">
                            <h3 class="timer" data-to="{{\App\ImageArchive::count()}}" data-speed="1500"></h3>
                            <div class="count-name">ارشيف الصور</div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{route('admin.videos')}}" class="counter">
                            <h3 class="timer" data-to="{{\App\VideoArchive::count()}}" data-speed="1500"></h3>
                            <div class="count-name">ارشيف الفيديو</div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{route('admin.cards')}}" class="counter">
                            <h3 class="timer" data-to="{{\App\Card::count()}}" data-speed="1500"></h3>
                            <div class="count-name">الكروت الشخصيه</div>
                        </a>
                    </div>

                    <div class="col-sm-3">
                        <a href="{{route('admin.contracts')}}" class="counter">
                            <h3 class="timer" data-to="{{\App\Contract::count()}}" data-speed="1500"></h3>
                            <div class="count-name">العقود</div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{route('admin.contracts')}}" class="counter">
                            <h3 class="timer" data-to="{{\App\Contract::where('end_date','>=',today()->toDateString())->count()}}" data-speed="1500"></h3>
                            <div class="count-name">العقود غير المنتهيه</div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{route('admin.contracts')}}" class="counter">
                            <h3 class="timer" data-to="{{\App\Contract::where('end_date', '<' , today()->toDateString())->count()}}" data-speed="1500"></h3>
                            <div class="count-name">العقود المنتهيه</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="widget">
                <div class="widget-content">
                    <div class="col-sm-12">
                        <a href="javascript:;" class="home-logo">
                            <span>الارشيفات التي تحتاج الي متابعه</span>
                        </a>
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover table-bordered display nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr class="ticket-tr">
                                    <th>الرقم التعريفي</th>
                                    <th>رقم الملف</th>
                                    <th>الاتجاه</th>
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
                                            {{$archive->from_to  == 'to' ? 'صادر' : 'وارد'}}
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
            <div class="clearfix"></div>
            <div class="widget">
                <div class="widget-content">
                    <div class="col-sm-12">
                        <a href="javascript:;" class="home-logo">
                            <span>العقود التي قاربت علي الانتهاء</span>
                        </a>
                    </div>
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
                                        @if($contract->end_date == \Carbon\Carbon::parse(today())->addMonths(2)->toDateString())
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
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="widget">
                <div class="widget-content">
                    <div class="col-sm-12">
                        <a href="javascript:;" class="home-logo">
                            <span>العقود المنتهيه</span>
                        </a>
                    </div>
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
                                    @if($contract->end_date < today()->toDateString())
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
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection