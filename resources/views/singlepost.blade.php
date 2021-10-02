@extends('frontlayout')
@section('title',$title)
@section('content')
<div class="row">
    <div class="col-md-8">
                <div class="card" style="margin:30px;">
                    <img class="card-img-top"  src="{{"/storage/images/post/fullimg/".$data['full_image']}}" alt="{{$data['title']}}">
                    <div class="card-body">
                        <h1>{{$data['title']}}</h1>
                        <p>{{$data['detail']}}</p>

                    </div>
                </div>

                @if(Session::has('user'))
                <div class="card" style="margin:30px;">
                    <div class="card-header" style="font-weight:bold;font-size:19px;">
                            Post a Comment<span id="errors"></span>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" id="comment" rows="3"></textarea>
                        <button class="btn btn-success mt-2" onclick="addcomment()">Comment</button>
                    </div>
                </div>
                @endif

                <div class="card" style="margin:30px;">
                    <div class="card-header" style="font-weight:bold;font-size:19px;">
                    Comments<span class="badge badge-secondary ml-2">{{count($data->comments)}}</span>
                    </div>
                    <div class="card-body">
                        @if($data->comments)
                        @for($j=0;$j<count($data->comments);$j++)
                        <blockquote class="blockquote">
                        <p class="mb-0">{{$data->comments[$j]['comment']}}</p>
                        <footer class="blockquote-footer">{{$data->comments[$j]->user->name}}</footer>
                        </blockquote>
                        @endfor
                        @endif
                    </div>
                </div>
    </div>
    @include('sidebar')
</div>
<script>
    function errors(err,type){
             return '<div class="alert '+type+'" role="alert">'+err+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
        function addcomment(){
            var comment=document.getElementById('comment').value;
            var url = window.location.pathname;
var id = url.substring(url.lastIndexOf('/') + 1);
            var messages='';
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var data;
data = new FormData();
data.append('comment',comment);
data.append('id',id);



            $.ajax({
                url: 'http://localhost:8000/addcomment',
                data: data,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function ( data ) {
                    console.log(data);
                    var message=data.message;
                    if(message['comment']){
                    messages=errors(message['comment'],'alert-danger');

                    }
                    else if(message='success'){
                        messages=errors('Comment added successfully','alert-success');
                        window.location.href=window.location.href;

                    }
                    else if(message='failure'){
                        messages=errors('Something went wrong','alert-danger');

                    }
                    $('#errors').html(messages);

                }
            });

        }   
</script>
@endsection
