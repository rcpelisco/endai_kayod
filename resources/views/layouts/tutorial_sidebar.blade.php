@section('sidebar_items')
	<li class="{{ Request::is('tutorials') || Request::is('tutorials/*') ? 'active' : ''}}">
		<a href="/tutorials"><em class="fa fa-dashboard">&nbsp;</em> Lessons</a></li>	

	<li class="{{ Request::is('students') || Request::is('students/*') ? 'active' : ''}}">
		<a href="/students"><em class="fa fa-dashboard">&nbsp;</em> Students</a></li>

	<li class="{{ Request::is('guardians') || Request::is('guardians/*') ? 'active' : ''}}">
		<a href="/guardians"><em class="fa fa-dashboard">&nbsp;</em> Guardians</a></li>
@endsection