@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-9">
	  	<div class="card mb-3">
			<img class="card-img-top" src="{{ asset($pic->picimg)}}" alt="" style="width:100%" class="responsive">
			<div class="card-body">
			   <p class="card-text"><b>Direct Image Link</b>:  <input id="full_url" type="text" class="form-control form-control-sm" value="{{ asset($pic->picimg) }}" readonly></p>
			   <p class="card-text"><small class="text-muted">uploaded by:{{ $pic->user->name }}  {{ $pic->created_at }}</small></p>		
			</div>
	   </div>
	  

  		@if($pic->tags->count())
  			<i data-feather="tag" class="float-right"></i>
		    @foreach($pic->tags as $tag)
		        
		        	<a href="{{ route('tag.detach',['id'=>$tag->id, 'pic'=>$pic]) }}" class="float-right">x</a>
					<a href="{{ route('tag.show',['id'=>$tag->id]) }}" class="float-right">
						<span class="badge badge-primary">{{ $tag->tag }}</span>
					</a>
				
		    @endforeach
	    @endif
			
	   <form action="{{route('tag.store',['pic'=>$pic])}}"  method="POST" >
			{{ csrf_field()}}
			<div class="form-group">
				<label for="tag">Add Tags</label>
				<input type="text" class="form-control"  name="tags" required>
			</div>	
			<button type="submit"  class="btn btn-primary btn-xs">Submit</button>
		</form>
	</div>

   <div class="col-md-3">
		<h4 class="text-center"><b>Recent Pics</b></h4>
		@if($randPics->count())
		
			@foreach($randPics as $randpic)
		    	<a href="{{ route('pic.show',['pic'=>$randpic])}}"><img src="{{ asset($randpic->picimg) }}"
		    		alt="" id="sidepic" style="width:100%" class="responsive">
		    	</a>
		    @endforeach
		@else
			<h4>No Recent Pics</h4>
		@endif
	</div>

</div>	
@endsection

@section('script')



@endsection