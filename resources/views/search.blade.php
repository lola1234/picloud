@extends('layouts.app')

@section('content')

<div class="header">
    <h1 class="title">Search results: {{ $title }}</h1>
</div>

@if($pics->count())	
	<div class="row">
		@foreach($pics as $pic)
			<div class="pic">
			    <a href="{{ route('pic.show',['pic'=>$pic])}}"><img src="{{ asset($pic->picimg)}}" alt="" width="400" height="250" class="responsive"></a>
			</div>
		@endforeach
		</div>
	</div>
@else
	<div class="nopics">
		<h3>No results found</h3>
	</div>
@endif

	<div class="paginate">{{ $pics->links() }}</div>
@endsection