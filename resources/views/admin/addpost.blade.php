
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
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="detail">Detail</label>
                    <textarea class="form-control" id="detail" rows="3" placeholder="Enter detail"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Thumbnail</label>
                    <input type="file" class="form-control-file" id="thumb">
                </div>
                <div class="form-group">
                    <label for="image">Full Image</label>
                    <input type="file" class="form-control-file" id="fullimg">
                </div>
                <div class="form-group">
                    <label for="image">Tags</label>
                    <input type="text" class="form-control" id="tags">
                </div>
                <div class="form-group">
                <label for="image">Category</label>
                <select class="custom-select" id="category">
                    <option value='' selected>Choose...</option>
                    @for($i=0;$i<count($data);$i++)
                    <option value="{{$data[$i]['id']}}">{{$data[$i]['title']}}</option>
                    @endfor
                </select>
                </div>
                <button class="btn btn-secondary" onclick="addpost()">Create</button>
                </div>
                <!-- Add Categort End---->
@endsection
<script>
    function errors(err,type){
             return '<div class="alert '+type+'" role="alert">'+err+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
        function addpost(){
            var title=document.getElementById('title').value;
            var detail=document.getElementById('detail').value;
            var tags=document.getElementById('tags').value;
            var category=document.getElementById('category').value;


            var messages='';
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var data;
data = new FormData();
data.append( 'thumb', $( '#thumb' )[0].files[0] );
data.append( 'fullimg', $( '#fullimg' )[0].files[0] );
data.append('title',title);
data.append('detail',detail);
data.append('tags',tags);
data.append('category',category);
            $.ajax({
                url: 'http://localhost:8000/admin/post/create',
                data: data,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function ( data ) {
                    var message=data.message;
                    if(message['title']){
                    messages=errors(message['title'],'alert-danger');

                    }
                    else if(message['detail']){
                        messages=errors(message['detail'],'alert-danger');

                    }
                    else if(message['thumb']){
                        messages=errors(message['thumb'],'alert-danger');

                    }
                    else if(message['fullimg']){
                        messages=errors(message['fullimg'],'alert-danger');

                    }
                    else if(message['tags']){
                        messages=errors(message['tags'],'alert-danger');

                    }
                    else if(message['category']){
                        messages=errors(message['category'],'alert-danger');

                    }
                    else if(message='success'){
                        messages=errors('Post created successfully','alert-success');
                        window.location.href='/admin/postlist';

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