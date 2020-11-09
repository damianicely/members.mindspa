@extends('../layouts/base')

@section('head')
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<title>Uploaded Files</title>
<style>
    .container {
        max-width: 500px;
    }
    dl, ol, ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
</style>
@endsection

@section('content')
        <div class="container mt-5">
            <audio controls>
            <source src="{{ asset("$recording->file_path") }}" type="audio/ogg">
              Your browser does not support the audio element.
              </audio> 
        </div>
@endsection