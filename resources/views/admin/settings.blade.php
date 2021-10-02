
@extends('admin.layout')
@section('title',$title)
@section('meta_desc',$title)
@section('content')

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>
                        
                    </div>
                <!-- Add Categort Start---->
                <div style="background:#ffffff;border-radius:10px;padding:20px;">
                <div id="errors"></div>
                <div class="form-group">
                    <label for="comment_auto">Comments Auto</label>
                    <input type="number" class="form-control" id="comment_auto" value="{{$data[0]['comment_auto']}}" placeholder="Comments Auto">
                </div>
                <div class="form-group">
                    <label for="user_auto">User Auto</label>
                    <input type="number" class="form-control" id="user_auto" value="{{$data[0]['user_auto']}}"  placeholder="User Auto">
                </div>
                <div class="form-group">
                    <label for="recent_limit">Recent Post Limit</label>
                    <input type="number" class="form-control" id="recent_limit" value="{{$data[0]['recent_limit']}}"  placeholder="Recent Post Limit">
                </div>
                <div class="form-group">
                    <label for="popular_limit">Popular Post Limit</label>
                    <input type="number" class="form-control" id="popular_limit" value="{{$data[0]['popular_limit']}}" placeholder="Popular Post Limit">
                </div>
                <div class="form-group">
                    <label for="recent_comment_limit">Recent Comments Limit</label>
                    <input type="number" class="form-control" id="recent_comment_limit" value="{{$data[0]['recent_comment_limit']}}" placeholder="Recent Comments Limit">
                </div>
                <button class="btn btn-secondary" onclick="addsettings()">Settings</button>
                </div>
                <!-- Add Categort End---->
@endsection
<script>
    function errors(err,type){
             return '<div class="alert '+type+'" role="alert">'+err+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
        function addsettings(){
            var comment_auto=document.getElementById('comment_auto').value;
            var user_auto=document.getElementById('user_auto').value;
            var recent_limit=document.getElementById('recent_limit').value;
            var popular_limit=document.getElementById('popular_limit').value;
            var recent_comment_limit=document.getElementById('recent_comment_limit').value;



            var messages='';
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var data;
data = new FormData();
data.append('comment_auto',comment_auto);
data.append('user_auto',user_auto);
data.append('recent_limit',recent_limit);
data.append('popular_limit',popular_limit);
data.append('recent_comment_limit',recent_comment_limit);

            $.ajax({
                url: 'http://localhost:8000/admin/settings',
                data: data,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function ( data ) {
                    console.log(data);
                    var message=data.message;
                    if(message='success'){
                        messages=errors('Settings added successfully','alert-success');
                        window.location.href='/admin/settings';
                    }
                    else if(message='failure'){
                        messages=errors('Something went wrong','alert-danger');
                    }
                    $('#errors').html(messages);

                }
            });

        }   
</script>
</body>

</html>