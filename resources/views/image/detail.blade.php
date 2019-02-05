@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            @include('includes.message')
            
            <div class="panel panel-default pub_image detail">
                <div class="panel-heading">
                    
                    @if($image->user->image)
                        <div class="container-avatar">
                            <img class="avatar" src="{{ route('user.avatar', ['filename' => $image->user->image ]) }}" />
                        </div>
                    @endif
                     
                    <div class="data-user">
                        {{ $image->user->name.' '.$image->user->surname }}
                        <span class="nickname">
                            {{ ' | @'.strtolower($image->user->nick) }}
                        </span>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="image-container">
                        <img src="{{ route('image.file',['filename'=> $image->image_path ]) }}" />
                    </div>
                
                    <div class="description">
                        <span class="nickname">{{ '@'.strtolower($image->user->nick) }}</span>
                        <span class="nickname date">{{ ' | '.FormatTime::LongTimeFilter($image->created_at) }}</span>
                        <p>{{ $image->description }}</p>
                    </div>
                    
                    <div class="likes">
                        
                        <!-- Comprobamos si el usuario le dio like a la imagen -->
                        <?php $user_like = false; ?>
                        @foreach($image->likes as $like)
                            @if($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach
                        
                        @if($user_like)
                        <img src="{{ asset('img/heart-red.png') }}" data-id="{{$image->id}}" class="btn-dislike" />
                        @else
                        <img src="{{ asset('img/heart-black.png') }}" data-id="{{$image->id}}" class="btn-like" />
                        @endif
                        
                        <span class="number_likes" >{{ count($image->likes) }}</span>
                        
                    </div>
                    
                    <div class="clearfix"></div>
                    <div class="comments">
                        
                        <h2>Comentarios {{ '('.count($image->comments).')' }}</h2>
                        <hr/>
                        
                        <form method="POST" action="{{ route('comment.save') }}">
                            
                            {{ csrf_field() }}
                            
                            <input type="hidden" name="image_id" value="{{ $image->id }}" />
                            <p>
                                <!-- REVISAR ESTA TEXTAREA CON BOOTSTRAP -->
                                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea>
                                @if($errors->has('content'))
                                <span class="invalid-feedback">
                                    <strong> {{ $errors->first('content')}}</strong>
                                </span>
                                @endif
                            </p>
                            <button type="submit" class="btn btn-success">
                                Enviar
                            </button>
                                
                        </form>
                        <hr/>
                        @foreach($image->comments as $comment)
                        <div class="comment">
                            <span class="nickname">{{ '@'.strtolower($comment->user->nick) }}</span>
                            <span class="nickname date">{{ ' | '.FormatTime::LongTimeFilter($comment->created_at) }}</span>
                            <p>{{ $comment->content }}<br/>
                            @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">Eliminar</a>
                            @endif
                            </p>
                        </div>
                        @endforeach
                        
                    </div>
                    
                </div>
                
            </div>

        
        </div> 
    </div>
</div>
@endsection