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
		@if(explode('/', url()->current())[3] == 'products')
			<li id="products" class="active"><a href="/products"><em class="fa fa-cart-plus">&nbsp;</em> Products</a></li>
		@else
			<li id="products" class=" "><a href="/products"><em class="fa fa-cart-plus">&nbsp;</em> Products</a></li>
			
		@endif

		@if(explode('/', url()->current())[3] == 'buyers')
			<li id="buyers" class="active"><a href="/buyers"><em class="fa fa-users">&nbsp;</em> Buyers</a></li>
		@else
			<li id="buyers" class=" "><a href="/buyers"><em class="fa fa-users">&nbsp;</em> Buyers</a></li>
		@endif

		@if(explode('/', url()->current())[3] == 'product_log')
			<li id="logs" class="active"><a href="/product_log"><em class="fa fa-id-card">&nbsp;</em>Logs</a></li>
		@else
			<li id="logs" class=" "><a href="/product_log"><em class="fa fa-id-card">&nbsp;</em>Logs</a></li>
		@endif
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