@section('sidebar_items')
	<li class="{{ Request::is('flight_tickets') || Request::is('flight_tickets/*') ? 'active' : ''}}">
		<a href="{{ route('flight_tickets.index') }}"><em class="fa fa-dashboard">&nbsp;</em>Flight Tickets</a></li>

	<li class="{{ Request::is('airline_companies') || Request::is('airline_companies/*') ? 'active' : ''}}">
		<a href="{{ route('airline_companies.index') }}"><em class="fa fa-cart-plus">&nbsp;</em> Airline Companies</a></li>
@endsection