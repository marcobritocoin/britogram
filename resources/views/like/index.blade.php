@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Mis Imagenes Favoritas</h1>
            
            @foreach($likes as $like)
                @include('includes.image', ['image'=>$like->image])
            @endforeach
            
            <!-- Paginacion -->
            <div class="clearfix"></div>
            {{ $likes->links() }}
            
        </div> 
    </div>
</div>
@endsection