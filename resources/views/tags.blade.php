@extends('layouts.app')

@section('content')

<div class="card card-default">
	<div class="card-header">Tags</div>
	<div class="card-body">
		<table class="table" id="tagTable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Image Count</th>
					<th>created</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				@if($tags->count())
					@foreach($tags as $tag)
						<tr>
							<td><a href="{{ route('tag.show',['id'=>$tag->id]) }}">
								<span class="badge badge-primary">{{ $tag->tag }}</span>
								</a>				
							</td>
							<td>{{ $tag->pics->count() }}</td>
							<td>{{ $tag->created_at }}</td>													
							<td><form action="{{ route('tag.delete',['id'=>$tag->id]) }}" method="POST"
								onsubmit="return confirm('This TAG will be deleted and all pics under this TAG will be untagged. Are you sure?')">
								{{ csrf_field() }}	
								{{ method_field('DELETE') }}
									<button class="btn btn-primary float right">X</button>
								</form>	
							</td>
						</tr>
					@endforeach
				@else
					<tr>No Tags</tr>
				@endif
			</tbody>			
		</table>
	</div>	
</div>
<div class="paginate">{{ $tags->links() }}</div>
@endsection

@section('javascript')
$(document).ready( function () {
    $('#tagTable').DataTable();
});
@endsection