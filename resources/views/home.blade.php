@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            @include('includes.message')
            
            @foreach($images as $image)
                @include('includes.image', ['image'=>$image])
            @endforeach
            
            <!-- Paginacion -->
            <div class="clearfix"></div>
            {{ $images->links() }}
        
        </div> 
    </div>
</div>
@endsection
