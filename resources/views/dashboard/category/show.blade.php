@extends('dashboard.master')


@section('content')


    <div class="form-group">
        <label for="title">Titulo</label>
    <input readonly class="form-control" type="text" name="title" id="title" value="{{ $category->title }}">
    
    </div>

    <div class="form-group">
        <label for="url_clean">Url limpiar</label>
        <input readonly class="form-control" type="text" name="url_clean" id="url_clean" value="{{ $category->url_clean }}">
    </div>


@endsection