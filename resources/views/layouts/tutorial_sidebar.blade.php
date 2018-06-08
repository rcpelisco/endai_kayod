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
		<li 
		@if(explode('/', url()->current())[3] == 'tutorials')
			class="active"
		@endif
		><a href="/tutorials"><em class="fa fa-dashboard">&nbsp;</em> Lessons</a></li>	

		@if(explode('/', url()->current())[3] == 'students')
			<li class="active"><a href="/students"><em class="fa fa-dashboard">&nbsp;</em> Students</a></li>
		@else
			<li class=""><a href="/students"><em class="fa fa-dashboard">&nbsp;</em> Students</a></li>
		@endif

		@if(explode('/', url()->current())[3] == 'guardians')
			<li class="active"><a href="/guardians"><em class="fa fa-dashboard">&nbsp;</em> Guardians</a></li>
		@else
			<li class=""><a href="/guardians"><em class="fa fa-dashboard">&nbsp;</em> Guardians</a></li>
		@endif

		</li>
		<li><a href="/"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
	</ul>
</div><!--/.sidebar-->	