@section('sidebar_items')
	<li class="{{ Request::is('boarding_house') || Request::is('boarding_house/*') ? 'active' : ''}}">
		<a href="{{ route('boarding_house.index') }}"><em class="fa fa-dashboard">&nbsp;</em>Rooms</a></li>

	<li class="{{ Request::is('boarders') || Request::is('boarders/*') ? 'active' : ''}}">
		<a href="{{ route('boarders.index') }}"><em class="fa fa-cart-plus">&nbsp;</em> Boarders</a></li>
@endsection