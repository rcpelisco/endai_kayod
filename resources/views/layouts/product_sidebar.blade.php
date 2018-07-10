
@section('sidebar_items')
<li class="{{ Request::is('products') || Request::is('products/*') ? 'active' : ''}}">
	<a href="{{route('products.index')}}"><em class="fa fa-cart-plus">&nbsp;</em> Products</a></li>
	
<li class="{{ Request::is('buyers') || Request::is('buyers/*') ? 'active' : ''}}">
	<a href="{{route('buyers.index')}}"><em class="fa fa-users">&nbsp;</em> Buyers</a></li>
		
<li class="{{ Request::is('product_log') || Request::is('product_log/*') ? 'active' : ''}}">
	<a href="{{route('product_log.index')}}"><em class="fa fa-id-card">&nbsp;</em>Logs</a></li>
			
@endsection()
		