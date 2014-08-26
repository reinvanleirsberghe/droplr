@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">{{ trans('main.signup') }}</h3>
				</div>
				<div class="panel-body">
					@include('layouts.partials.errors')

					<!--  Form -->
					{{ Form::open(['route' => 'registration_path']) }}

						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<!-- Firstname Form Input -->
								<div class="form-group">
									{{ Form::label('firstname', trans('main.firstname') . ':') }}
									{{ Form::text('firstname', null, ['class' => 'form-control']) }}

									{{ $errors->first('firstname', '<span class="error">:message</span>') }}
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-6">
								<!-- Name Form Input -->
								<div class="form-group">
									{{ Form::label('name', trans('main.name') . ':') }}
									{{ Form::text('name', null, ['class' => 'form-control']) }}

									{{ $errors->first('name', '<span class="error">:message</span>') }}
								</div>
							</div>
						</div>

						<!-- Email Form Input -->
						<div class="form-group">
							{{ Form::label('email', trans('main.email') . ':') }}
							{{ Form::email('email', null, ['class' => 'form-control']) }}

							{{ $errors->first('email', '<span class="error">:message</span>') }}
						</div>

						<!-- Password Form Input -->
						<div class="form-group">
							{{ Form::label('password', trans('main.password') . ':') }}
							{{ Form::password('password', ['class' => 'form-control']) }}

							{{ $errors->first('password', '<span class="error">:message</span>') }}
						</div>

						<!--  Form Submit -->
						<div class="form-group pull-right">
							{{ Form::submit(trans('main.signup'), ['class' => 'btn btn-primary', 'name' => 'submit']) }}
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@stop