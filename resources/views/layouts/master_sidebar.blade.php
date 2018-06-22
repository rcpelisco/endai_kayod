<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">MadeleneBT</div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
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