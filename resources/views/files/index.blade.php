@extends('../layouts/base')

@section('head')
<title>Uploaded Files</title>
<style>
</style>
@endsection

@section('content')
        <div class="container mt-5">
            <h1>Uploaded Files</h1>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
            @endif



            <div class="container">
                @foreach ($files as $file)
                <div class="row">
                    <div class="col-sm-2"><a href="{{ route('files.show', $file->id) }}">Listen</a></div>
                    <div class="col-sm-2"><a href="{{ route('files.destroy', $file->id) }}">Delete</a></div>
                    <div class="col-sm-2">Edit</div>
                    <div class="col-sm-2">#{{ $file->id }} - {{ $file->name }}</div>
                  </div>                     
                @endforeach
              </div> 
        </div>
@endsection