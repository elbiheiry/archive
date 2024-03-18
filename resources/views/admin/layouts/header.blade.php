<div class="top-header">
    <div class="toggle-icon"  data-toggle="tooltip" data-placement="right" title="Toggle Menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <ul class="top-header-links">
        @if(auth()->guard('admins')->user()->role != 'user')
            <div class="dropdown">
                <a href="{{route('admin.settings')}}" class="custom-btn" title="settings"><i class="fa fa-cog"></i></a>
            </div>
        @endif
        <div class="dropdown profile">

            <button class="custom-btn dropdown-toggle" type="button" data-toggle="dropdown">
                <img src="{{asset('storage/uploads/users/'.auth()->guard('admins')->user()->image)}}">
                {{auth()->guard('admins')->user()->username}}
                <i class="fa fa-angle-down pro-ico"></i>
            </button>
            <ul class="dropdown-menu profile-dropdown">
                <div class="heading">
                    <img src="{{asset('storage/uploads/users/'.auth()->guard('admins')->user()->image)}}">
                    <h3>{{auth()->guard('admins')->user()->name}}</h3>
                </div>
                <ul>
                    <li>
                        <a href="{{route('admin.profile')}}">
                            <i class="fa fa-user"></i>
                            الصفحه الشخصيه
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.logout')}}">
                            <i class="fa fa-power-off"></i>
                            تسجيل الخروج
                        </a>
                    </li>
                </ul>
            </ul>
        </div>
    </ul>
</div>