@extends('layouts.default')

@section('content')
<header>
	<div class="row">
		<div class="col-md-12">
			<h1>{{ $drop->name }}</h1>
			<h2>{{ trans('drops.edit_info') }}</h2>
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
		{{ Form::open(['route' => ['drops_info_path', $drop->id]]) }}

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<!-- Name Form Input -->
				<div class="form-group">
					{{ Form::label('name', trans('main.name') . ':') }}
					{{ Form::text('name', $drop->name, ['class' => 'form-control']) }}

					{{ $errors->first('name', '<span class="error">:message</span>') }}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<!-- Description Form Input -->
				<div class="form-group">
					{{ Form::label('description', trans('main.description') . ':') }}
					{{ Form::textarea('description', $drop->description, ['class' => 'form-control']) }}

					{{ $errors->first('description', '<span class="error">:message</span>') }}
				</div>

				<!--  Form Submit -->
				<div class="form-group pull-right">
					{{ Form::submit(trans('drops.edit_info'), ['class' => 'btn btn-primary', 'name' => 'submit']) }}
				</div>
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>

@stop