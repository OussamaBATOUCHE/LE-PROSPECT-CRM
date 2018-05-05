
@extends('admin')

@section('content')
<script>
    $(document).on('keydown','.send',function(e){
        var message = $(this).val();
        var element = $(this);
        if(message && e.keyCode == 13 && !e.shiftKey){
            // $('.chat-box').append('<div class="alert alert-info">'+message+'</div>');
             $.ajax({
                 url:'{{ url("messages/add") }}',
                 type:'post',
                 data:{_token:'{{ csrf_token() }}',message:message},

             });
             element.val('');
        }
    });

    $(function(){
        livechat();
    }); 

    function livechat(){
        $.ajax({
               url:'{{ url("messages/ajax") }}',
               data:{_token:'{{ csrf_token() }}'},
               success:function(data){
                   $('.chat-box').append('<div class="alert alert-info">'+data['message']+'</div>');
                   livechat();
               },
               error:function(){
                   setTimeout(livechat,5000);
               }
        });
    }
</script>

<div class="container">
<div class="row">
    <div class="col-md-8">
        <div class="chat-box">
            @foreach ($messages as $message)
            <div class="alert alert-info"> {{ $message->message }} </div>     
            @endforeach

        </div>
        <input type="text" class="form-control send">
    </div>
</div>
</div>

@endsection