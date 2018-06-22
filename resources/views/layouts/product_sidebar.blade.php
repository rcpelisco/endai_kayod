
@section('sidebar_items')
<li class="{{ Request::is('products') || Request::is('products/*') ? 'active' : ''}}">
	<a href="/products"><em class="fa fa-cart-plus">&nbsp;</em> Products</a></li>
	
<li class="{{ Request::is('buyers') || Request::is('buyers/*') ? 'active' : ''}}">
	<a href="/buyers"><em class="fa fa-users">&nbsp;</em> Buyers</a></li>
		
<li class="{{ Request::is('log') || Request::is('log/*') ? 'active' : ''}}">
	<a href="/product_log"><em class="fa fa-id-card">&nbsp;</em>Logs</a></li>
			
@endsection()
		