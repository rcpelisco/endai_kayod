<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-usertitle">
        <div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
        <div class="profile-usertitle-status"></span>Hi I'm {{ Auth::user()->name }}</div>
    </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
        @yield('sidebar_items')
        <li>
            <a href="{{ route('logout') }}" 
            onclick="event.preventDefault();
                    document.getElementById('logout_form').submit();"><em class="fa fa-power-off">&nbsp;</em> Logout
            </a>
            <form id="logout_form" action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}		
            </form>
        </li>
    </ul>
</div><!--/.sidebar-->	