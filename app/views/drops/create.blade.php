@extends('layouts.default')

@section('content')
<header>
	<div class="row">
		<div class="col-md-12">
			<h1>{{ trans('account.my_drops') }}</h1>
			<h2>{{ trans('drops.add') }}</h2>
		</div>
	</div>
</header>

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				@include('layouts.partials.errors')
			</div>
		</div>

		<!--  Form -->
		{{ Form::open(['route' => 'drops_add_path']) }}

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<!-- Name Form Input -->
				<div class="form-group">
					{{ Form::label('name', trans('main.name') . ':') }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}

					{{ $errors->first('name', '<span class="error">:message</span>') }}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<!-- Description Form Input -->
				<div class="form-group">
					{{ Form::label('description', trans('main.description') . ':') }}
					{{ Form::textarea('description', null, ['class' => 'form-control']) }}

					{{ $errors->first('description', '<span class="error">:message</span>') }}
				</div>

				<!--  Form Submit -->
				<div class="form-group pull-right">
					{{ Form::submit(trans('drops.add'), ['class' => 'btn btn-primary', 'name' => 'submit']) }}
				</div>
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>

@stop

@section('scripts')
<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry"></script>
<script type="text/javascript" src="http://hpneo.github.io/gmaps/gmaps.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
@stop