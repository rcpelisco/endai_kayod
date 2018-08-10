@extends('layouts.landing')

@section('title', 'HomeMadelene')

@section('header', 'THE BILLIONAIRE\'S CONGLOMERATE')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Products</h4>
					<div class="easypiechart"><span class="percent">
						<a href="./products">
							<button class="btn btn-primary">Open</button></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Tutorials</h4>
					<div class="easypiechart"><span class="percent">
						<a href="{{route('tutorials.index')}}">
							<button class="btn btn-primary">Open</button></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Flight Ticketing</h4>
					<div class="easypiechart"><span class="percent">
						<a href="{{route('flight_tickets.index')}}">
							<button class="btn btn-primary">Open</button></span>
						</a>
					</div>
				</div>
			</div>
    </div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Boarding House</h4>
					<div class="easypiechart"><span class="percent">
						<a href="{{route('boarding_house.index')}}">
							<button class="btn btn-primary">Open</button></span>
						</a>
					</div>
				</div>
			</div>
    </div>
  </div>
@endsection