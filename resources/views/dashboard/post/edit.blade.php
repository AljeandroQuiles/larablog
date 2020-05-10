@extends('dashboard.master')


@section('content')


@include('dashboard.partials.validation-error')

<form action="{{ route("post.update", $post->id) }}" method="POST">

    @method('PUT')
    @include('dashboard.post._form')
</form>
<br>
<form action="{{ route("post.image", $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col">    
            <input type="file" name="image" value="" class="form-control">
        </div>
        <div class="col">   
            <input type="submit" class="btn btn-primary" value="Subir">
        </div>

    </div>
    
</form>

<div class="row">
    A la hora de mostrar imágenes para borrar o eliminar peta, y no hallo el error; así que he comentado esas líneas de código
 
 {{--   @foreach ($post->images as $image)-->
    <div class="col-3 mt-3">
        <img class="w-100" src="{{ $image->getImageUrl() }}">
    <a href="{{ route("post.image-download", $image->id) }}" class="float-left btn btn-success btn-sm mt-2"> Descargar</a>
   
    <form action="{{ route("post.image-delete", $image->id) }}" method="POST">
        @method("DELETE")
        @csrf
        <button  class="float-right btn btn-danger btn-sm mt-2" type="submit">Borrar</button>
    </form>


</div>
    
@endforeach --}} 
</div>

@endsection