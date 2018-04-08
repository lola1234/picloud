@extends('layouts.app')

@section('content')

<div id="upload">
	<div class="jumbotron jumbotron-fluid py-3 my-0">
    <div class="container-fluid">
        <h3>Uploading is easy!</h3>
        <p class="lead">Drag and drop into the box below, click the box and select multiple files, or press <kbd>CTRL&nbsp;+&nbsp;V</kbd> to paste an image from your clipboard.</p>
    </div>
</div>

	<form action="{{route('pic.store')}}" class="dropzone" id="my-awesome-dropzone"
								method="POST" enctype="multipart/form-data">
				{{ csrf_field()}}	
	</form>
</div>
@endsection

@section('javascript')
Dropzone.options.myAwesomeDropzone = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 5, // MB
  maxFiles: 5,
  acceptedFiles: ".jpeg,.jpg,.png,.gif",
};

@endsection