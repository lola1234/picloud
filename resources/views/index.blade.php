@extends('layouts.app')

@section('content')

<div class="paginate">{{ $pics->links() }}</div>
<div class="sort">
	<ul class="pagination pagination-sm">
	     <li class="page-item active">
	        <a href="/?order=latest" class="page-link"><span class="oi oi-sort-descending" aria-hidden="true"></span> Latest</a>
	    </li>
	    <li class="page-item">
	        <a href="/?sort=oldest" class="page-link"><span class="oi oi-calendar" aria-hidden="true"></span>Oldest</a>
	    </li>
	   
	    <li class="page-item">
	        <a href="/?sort=randomorder" class="page-link"><span class="oi oi-sort-descending" aria-hidden="true"></span>Random Order</a>
	    </li>
	</ul>
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
		<h3>No pics to display at this moment</h3>
	</div>
@endif

<a href="#" class="go-top">Go Top</a>
@endsection

@section('javascript')
<script>
	$(document).ready(function() {
		// Show or hide the sticky footer button
		$(window).scroll(function() {
			if ($(this).scrollTop() > 200) {
				$('.go-top').fadeIn(200);
			} else {
				$('.go-top').fadeOut(200);
			}
		});
		
		// Animate the scroll to top
		$('.go-top').click(function(event) {
			event.preventDefault();
			
			$('html, body').animate({scrollTop: 0}, 300);
		})
	});
</script>
@endsection

