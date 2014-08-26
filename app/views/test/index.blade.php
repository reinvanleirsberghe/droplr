@extends('layouts.default')

@section('content')

<h1>Test</h1>

@stop

@section('scripts')
<script src="/scripts/api.js"></script>
<script>
	$(document).ready(function () {
		Droplr.drops.getAll(successCB, errorCB)
	});

	function successCB(data) {
		console.log(data);
	}

	function errorCB(data) {
		console.log(data);
	}
</script>
@stop