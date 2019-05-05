@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/importExportView">Files</a>
    <example-component storage="storage/uploads/"></example-component>
    <form enctype="multipart/form-data" method="POST" action="/image" class="mt-5">
        @csrf
        <input type="file" name="image" onchange="this.form.submit()">
    </form>
    @foreach ($images as $image)
        <img src="{{ $image->image_base }}" alt="">
    @endforeach
</div>
@endsection
