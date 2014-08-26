@include('layouts.partials.ajax-errors')

{{ Form::hidden('current_marker', $marker->id, ['id' => 'current_marker']) }}

<!-- Name Form Input -->
<div class="form-group">
	{{ Form::label('name', trans('main.name') . ':') }}
	{{ Form::text('name', $marker->name, ['class' => 'form-control', 'placeholder' => 'Marker']) }}
</div>

<!-- Event Form Input -->
<div class="form-group">
	{{ Form::label('event', trans('drops.event_add') . ':') }}
	{{ Form::checkbox('event', '1', $marker->has_event, ['id' => 'event']) }}
</div>

@if($marker->has_event)
<div id="event-content">
@else
<div id="event-content" hidden>
@endif
	<ul id="tab-marker-heading" class="nav nav-tabs" role="tablist">
		<li class="active">
			<a href="#info" role="tab" data-toggle="tab"><i class="fa fa-info"></i></a>
		</li>
		<li class="">
			<a href="#question" role="tab" data-toggle="tab"><i class="fa fa-question"></i></a>
		</li>
		<li class="">
			<a href="#image" role="tab" data-toggle="tab"><i class="fa fa-image"></i></a>
		</li>
		<li class="">
			<a href="#video" role="tab" data-toggle="tab"><i class="fa fa-video-camera"></i></a>
		</li>
	</ul>

	<div id="tab-marker-content" class="tab-content">
		<div class="tab-pane fade active in" id="info">
			<h5>{{ trans('drops.event_info') }}</h5>
			<p>{{ trans('drops.event_info_content') }}</p>
			<!-- Description Form Input -->
			<div class="form-group">
				{{ Form::label('description', trans('main.description')) }}
				{{ Form::textarea('description', null, ['class' => 'form-control', 'cols' => 3]) }}
			</div>
		</div>
		<div class="tab-pane fade" id="question">
			<h5>{{ trans('drops.event_question') }}</h5>
			<p>{{ trans('drops.event_question_content') }}</p>
		</div>
		<div class="tab-pane fade" id="image">
			<h5>{{ trans('drops.event_image') }}</h5>
			<p>{{ trans('drops.event_image_content') }}</p>
		</div>
		<div class="tab-pane fade" id="video">
			<h5>{{ trans('drops.event_video') }}</h5>
			<p>{{ trans('drops.event_video_content') }}</p>
		</div>
	</div>
</div>