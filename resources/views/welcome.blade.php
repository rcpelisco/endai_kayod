@extends('layouts.landing')

@section('title', 'HomeMadelene')

@section('header', 'THE BILLIONAIRE\'S CONGLOMERATE')

@section('content')
	<div class="row">
		<div class="col-xs-6 col-md-4">
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
		<div class="col-xs-6 col-md-4">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Tutorials</h4>
					<div class="easypiechart"><span class="percent">
						<a href="./tutorials">
							<button class="btn btn-primary">Open</button></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-4">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Flight Ticketing</h4>
					<div class="easypiechart"><span class="percent">
						<a href="./flight_tickets">
							<button class="btn btn-primary">Open</button></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		{{-- <div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Visitors</h4>
					<div class="easypiechart"><span class="percent">27%</span></div>
				</div>
			</div>
		</div>
	</div> --}}
@endsection