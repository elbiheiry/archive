<div class="side-menu">
    <div class="logo">
        <div class="main-logo"><img src="{{asset('storage/uploads/logo/'.$settings->site_logo)}}"></div>
    </div><!--End Logo-->
    <aside class="sidebar">
        <ul class="side-menu-links">

            <li class="@if(Request::route()->getName() == 'admin.dashboard'){{'active'}}@endif"><a rel="nofollow" rel="noreferrer" href="{{route('admin.dashboard')}}">الصفحه الرئيسيه</a></li>

            <li class="@if(Request::route()->getName() == 'admin.archives.to'){{'active'}}@endif"><a href="{{route('admin.archives.to')}}">الارشيف الصادر</a></li>

            <li class="@if(Request::route()->getName() == 'admin.archives.from'){{'active'}}@endif"><a href="{{route('admin.archives.from')}}">الارشيف الوارد</a></li>

            <li class="@if(Request::route()->getName() == 'admin.images'){{'active'}}@endif"><a href="{{route('admin.images')}}">ارشيف الصور</a></li>

            <li class="@if(Request::route()->getName() == 'admin.forms'){{'active'}}@endif"><a href="{{route('admin.forms')}}">ارشيف النماذج</a></li>

            <li class="@if(Request::route()->getName() == 'admin.videos'){{'active'}}@endif"><a href="{{route('admin.videos')}}">ارشيف الفيديو</a></li>

            <li class="@if(Request::route()->getName() == 'admin.cards'){{'active'}}@endif"><a rel="nofollow" rel="noreferrer" href="{{route('admin.cards')}}">الكروت الشخصيه</a></li>

            <li class="@if(Request::route()->getName() == 'admin.contracts'){{'active'}}@endif"><a href="{{route('admin.contracts')}}">العقود</a></li>

            <li class="@if(Request::route()->getName() == 'admin.search'){{'active'}}@endif"><a href="{{route('admin.search')}}">بحث عام</a></li>

            @if(auth()->guard('admins')->user()->role != 'user')
                <li class="sub-menu @if(Request::route()->getName() == 'admin.users'
                || Request::route()->getName() == 'admin.categories'
                || Request::route()->getName() == 'admin.groups'
                || Request::route()->getName() == 'admin.settings'){{'active'}}@endif">
                    <a rel="nofollow" rel="noreferrer" href="javascript:void(0);">
                        الاعدادات
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul>
                        <li class="@if(Request::route()->getName() == 'admin.users'){{'active'}}@endif">
                            <a rel="nofollow" rel="noreferrer" href="{{route('admin.users')}}">المستخدمين</a>
                        </li>

                        <li class="@if(Request::route()->getName() == 'admin.categories'){{'active'}}@endif">
                            <a rel="nofollow" rel="noreferrer" href="{{route('admin.categories')}}">الاقسام</a>
                        </li>

                        <li class="@if(Request::route()->getName() == 'admin.groups'){{'active'}}@endif">
                            <a rel="nofollow" rel="noreferrer" href="{{route('admin.groups')}}">المجموعات</a>
                        </li>

                        <li class="@if(Request::route()->getName() == 'admin.settings'){{'active'}}@endif">
                            <a rel="nofollow" rel="noreferrer" href="{{route('admin.settings')}}">اعدادات السيستم</a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
    </aside>
</div>