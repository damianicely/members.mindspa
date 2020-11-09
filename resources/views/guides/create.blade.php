@extends('../layouts/base')

@section('head')
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<title>Create a Guide</title>
<style>
</style>
@endsection

@section('content')
        <div class="container mt-5">
        <form action="{{route('guides.store')}}" method="post" enctype="multipart/form-data">
          <h3 class="text-center mb-5">Create a new Guide</h3>
            @csrf
            @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <strong>{{ $message }}</strong>
              </div>
            @endif

            <div class="form-group">
              <label for="guide_title">Title:</label>
              <input
                type="text"
                class="form-control 
                @error('title') is-invalid @enderror"
                id="guide_title"
                name="title"
                value="{{ old('title') }}">
              @error('title')
                <p class="text-danger mt-2">
                    {{ $errors->first('title') }}
                </p>
              @enderror
            </div>

            <div class="form-group">
                <label for="guide_byline">Byline:</label>
                <input
                  type="text"
                  class="form-control 
                  @error('byline')
                  is-invalid
                  @enderror"
                  id="guide_byline"
                  name="byline"
                  value="{{ old('byline') }}">
                @error('byline')
                  <p class="text-danger mt-2">
                      {{ $errors->first('byline') }}
                  </p>
                @enderror
            </div>

            <div class="form-group">
              <label for="guide_description">Description:</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="guide_description" name="description">{{ old('description') }}</textarea>
              @error('description')
                <p class="text-danger mt-2">
                    {{ $errors->first('description') }}
                </p>
              @enderror
            </div>
        
            <div class="form-group">
                <label class="file-upload-label " for="chooseGuide">Select File:</label>
                <input type="file" name="guide" class="form-control-file @error('guide') is-invalid @enderror" id="chooseGuide">
                @error('guide')
                  <p class="text-danger mt-2">
                      {{ $message }}
                  </p>
                @enderror
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload Guide
            </button>
        </form>
    </div>

@endsection