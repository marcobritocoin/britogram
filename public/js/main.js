var url = 'http://localhost/instagram/proyecto-laravel/public/';
window.addEventListener("load", function(){
   
   //Cambio el puntero por la manito de btn
   $('.btn-like').css('cursor', 'pointer');
   $('.btn-dislike').css('cursor', 'pointer');
    
   //Boton de like
   function like(){
        $('.btn-like').unbind('click').click(function(){

            var id = $(this).data('id');
            var cont_like = $('#'+id).text();
            var like = parseInt(cont_like) + 1;
            $('#'+id).text(like);
            
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src',url+'img/heart-red.png');
            
            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Has dado like a publicacion');
                    }else{
                        console.log('Error dando like');
                    }
                }
            });
            
            dislike();
        });
   }
   like();
   
   //Boton de dislike
   function dislike(){
        $('.btn-dislike').unbind('click').click(function(){

            var id = $(this).data('id');
            var cont_like = $('#'+id).text();
            var dislike = parseInt(cont_like) - 1;
            $('#'+id).text(dislike);
            
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',url+'img/heart-black.png');
            
            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Has dado dislike a publicacion');
                    }else{
                        console.log('Error dando dislike');
                    }
                }
            });
            
            like();
        });
   }
   dislike();
   
});


