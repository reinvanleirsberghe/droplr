@extends('layouts.default')

@section('content')

<header>
	<div class="row">
		<div class="col-md-12">
			<h1>{{ trans('account.my_drops') }}</h1>
		</div>
	</div>
</header>

<div class="row">
	<div class="col-md-12">
		{{ link_to_route('drops_add_path', trans('drops.add'), null, ['class' => 'btn btn-primary']) }}
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead>
			<tr>
				<th>{{ trans('main.name') }}</th>
				<th>{{ trans('main.description') }}</th>
				<th>{{ trans('main.actions') }}</th>
			</tr>
			</thead>
			<tbody>
			@forelse ($drops as $drop)
			<tr>
				<td>{{ link_to_route('drops_edit_path', $drop->name, $drop->id) }}</td>
				<td>{{ Str::words($drop->description, 10) }}</td>
				<td>
					<ul class="list-inline list-unstyled">
						<li>
							{{ link_to_route('drops_info_path', trans('drops.edit_info'), $drop->id, ['class' => 'btn btn-xs btn-primary drop-edit']) }}
						</li>
						<li>
							<!--  Form -->
							{{ Form::open(['method' => 'DELETE', 'route' => ['drops_delete_path', $drop->id]]) }}
							<!--  Form Submit -->
							<div class="form-group">
								{{ Form::submit(trans('main.delete'), ['class' => 'btn btn-xs btn-danger drop-delete']) }}
							</div>
							{{ Form::close() }}
						</li>
					</ul>
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="3">{{ trans('drops.no_drops') }}</td>
			</tr>
			@endforelse
			</tbody>
		</table>
	</div>
</div>
@stop