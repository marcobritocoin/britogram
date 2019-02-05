<?php

namespace App\Http\Controllers;

//importo mis clases
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(Request $request){
        
        //validacion
        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);
        
        //recoger datos
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        
        // Asigno los valores a mi nuevo objeto
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        //Guardar en la base de datos
        $comment->save();
        
        //redireccion
        return redirect()->route('image.detail', ['id'=> $image_id])
                         ->with(['message' => 'Has enviado tu mensaje correctamente']);
    }
    
    public function delete($id){
        //Conseguir datos del usuario identificado
        $user = \Auth::user();
        
        //Conseguir el objeto del comentario
        $comment = Comment::find($id);
        
        //Comprobar si soy el dueño del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();
            
            //redireccion
            return redirect()->route('image.detail', ['id'=> $comment->image->id])
                         ->with(['message' => 'Comentario eliminado correctamente']);
        }else{
            return redirect()->route('image.detail', ['id'=> $comment->image->id])
                         ->with(['message' => 'Comentario no se ha eliminado']);
            
        }
        
        
    }
}
