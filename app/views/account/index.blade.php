@extends('layouts.default')

@section('content')

	<header>
		<div class="row">
			<div class="col-md-12">
				<h1>{{ trans('account.my_account') }}</h1>
			</div>
		</div>
	</header>

	<div class="row">
		<div class="col-md-6">
			@include('layouts.partials.errors')

			<!--  Form -->
			{{ Form::open(['route' => 'user_account_path']) }}

				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<!-- Firstname Form Input -->
						<div class="form-group">
							{{ Form::label('firstname', trans('main.firstname') . ':') }}
							{{ Form::text('firstname', $currentUser->firstname, ['class' => 'form-control']) }}

							{{ $errors->first('firstname', '<span class="error">:message</span>') }}
						</div>
					</div>

					<div class="col-xs-12 col-sm-6 col-md-6">
						<!-- Name Form Input -->
						<div class="form-group">
							{{ Form::label('name', trans('main.name') . ':') }}
							{{ Form::text('name', $currentUser->name, ['class' => 'form-control']) }}

							{{ $errors->first('name', '<span class="error">:message</span>') }}
						</div>
					</div>
				</div>

				<!-- Email Form Input -->
				<div class="form-group">
					{{ Form::label('email', trans('main.email') . ':') }}
					{{ Form::email('email', $currentUser->email, ['class' => 'form-control']) }}

					{{ $errors->first('email', '<span class="error">:message</span>') }}
				</div>

			    <!--  Form Submit -->
			    <div class="form-group pull-right">
			        {{ Form::submit(trans('account.update'), ['class' => 'btn btn-primary', 'name' => 'submit']) }}
			    </div>
			{{ Form::close() }}
		</div>
	</div>
@stop