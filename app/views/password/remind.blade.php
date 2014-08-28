@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('reminders.need') }}</h3>
            </div>
            <div class="panel-body">
                @include('layouts.partials.errors')

                <!--  Form -->
                {{ Form::open() }}

                <!-- Email Form Input -->
                <div class="form-group">
                    {{ Form::label('email', trans('main.email') . ':') }}
                    {{ Form::email('email', null, ['class' => 'form-control']) }}

                    {{ $errors->first('email', '<span class="error">:message</span>') }}
                </div>

                <!--  Form Submit -->
                <div class="form-group pull-right">
                    {{ Form::submit(trans('reminders.reset'), ['class' => 'btn btn-primary', 'name' => 'submit']) }}
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@stop