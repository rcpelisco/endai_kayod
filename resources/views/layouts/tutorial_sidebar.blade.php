@section('sidebar_items')
	<li class="{{ Request::is('tutorials') || Request::is('tutorials/*') ? 'active' : ''}}">
		<a href="{{route('tutorials.index')}}"><em class="fa fa-dashboard">&nbsp;</em> Lessons</a></li>	

	<li class="{{ Request::is('students') || Request::is('students/*') ? 'active' : ''}}">
		<a href="{{route('students.index')}}"><em class="fa fa-dashboard">&nbsp;</em> Students</a></li>

	<li class="{{ Request::is('guardians') || Request::is('guardians/*') ? 'active' : ''}}">
		<a href="{{route('guardians.index')}}"><em class="fa fa-dashboard">&nbsp;</em> Guardians</a></li>
@endsection