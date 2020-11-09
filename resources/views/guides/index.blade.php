@extends('../layouts/base')

@section('head')
<title>Uploaded Guides</title>
<style>
</style>
@endsection

@section('content')
        <div class="container mt-5">
            <h1>Guides</h1>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <ul class="list-unstyled">
                @foreach ($guides as $guide)
                <li class="media my-4">
                  <i class="fas fa-file-download fa-7x mx-3"></i>
                  <div class="media-body">
                    <a href="{{ route('guides.download', $guide->id) }}">Download</a> | <a href="{{ route('guides.destroy', $guide->id) }}">Delete</a> | Edit
                    <h4 class="mt-0 mb-1"><a href="{{ route('guides.show', $guide->id) }}">#{{$guide->id}}  {{ $guide->title }}</a></h4>
                    <h5 class="mt-0 mb-1">{{ $guide->byline }}</h5>

                    {{ $guide->description }}
                  </div>
                </li>
                    
                @endforeach
              </ul>            
        </div>
@endsection