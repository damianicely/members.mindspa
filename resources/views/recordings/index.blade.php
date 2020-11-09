@extends('../layouts/base')

@section('head')
<title>Uploaded Files</title>
<style>
</style>
@endsection

@section('content')
        <div class="container mt-5">
            <h1>Recordings</h1>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <ul class="list-unstyled">
                @foreach ($recordings as $recording)
                <li class="media my-4">
                  <i class="far fa-file-audio fa-7x mx-3"></i>
                  <div class="media-body">
                    <a href="{{ route('recordings.show', $recording->id) }}">Listen</a>
                    | <a href="{{ route('recordings.download', $recording->id) }}">Download</a>
                    | <a href="{{ route('recordings.destroy', $recording->id) }}">Delete</a>
                    | Edit
                    <h4 class="mt-0 mb-1"><a href="{{ route('recordings.show', $recording->id) }}">#{{$recording->id}}  {{ $recording->title }}</a></h4>
                    <h5 class="mt-0 mb-1">{{ $recording->byline }}</h5>

                    {{ $recording->description }}
                  </div>
                </li>
                    
                @endforeach
              </ul>            
        </div>
@endsection