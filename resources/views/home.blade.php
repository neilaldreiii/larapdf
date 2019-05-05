@extends('layouts.app')

@section('content')
<div class="container">

    <a href="/importExportView">Files</a>
    
    <example-component :images="{{ $images }}" :products="{{ $products }}"></example-component>

    <form enctype="multipart/form-data" method="POST" action="/image" class="mt-5">
        @csrf
        <input type="file" name="image" onchange="this.form.submit()">
    </form>

</div>
@endsection
