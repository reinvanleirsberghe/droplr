@extends('layouts.default')

@section('content')
<header>
	<div class="row">
		<div class="col-sm-8">
			<h1 class="pull-left">{{ $drop->name }}</h1>
		</div>
		<div class="col-sm-4">
			{{ link_to_route('drops_info_path', trans('drops.edit_info'), $drop->id, ['class' => 'btn btn-primary']) }}
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
		{{ Form::open() }}

		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8">
				<div class="map_loader"><div class="fa fa-spinner fa-spin"></div></div>
				<div id="drop_map"></div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				{{ Form::hidden('markers_amount', 0, ['id' => 'markers_amount']) }}

				<ul class="list-unstyled" id="drop_list">
				</ul>
			</div>
		</div>

		{{ Form::close() }}
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalMarker" tabindex="-1" role="dialog" aria-labelledby="modalMarkerLabel" aria-hidden="true">
	<div class="modal-dialog">

		<!--  Form -->
		{{ Form::open() }}

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">{{ trans('drops.marker_options') }}</h4>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('main.cancel') }}</button>
				<button type="button" class="btn btn-primary" id="marker-submit">{{ trans('main.save') }}</button>
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