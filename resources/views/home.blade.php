@extends('layouts.app')

@section('content')
<div class="header">
    <h1 class="title">MY Pics</h1>
</div>
<div class="card-header">Tags Count</div>
<div class="card-body">
    Tag->user->count()
</div>

<div class="card-header">Pics Count</div>
<div class="card-body">
    $pics->count()
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
        <h3>No Pics for this user</h3>
    </div>
@endif

<div class="paginate">{{ $pics->links() }}</div>

@endsection
