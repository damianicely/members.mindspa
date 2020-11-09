@extends('../layouts/base')

@section('head')
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
            <h1>File #{{ $recording->id }}</h1>
            <p>Filename: {{ $recording->file_name }}</p>
            <p>Path: {{ $recording->recording_path }}</p>
        </div>
@endsection