
@extends('admin.layout')
@section('title','Add Category')
@section('meta_desc','Add Category')
@section('content')

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Category</h1>
                        
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
                    <label for="image">Upload Image</label>
                    <input type="file" class="form-control-file" id="image">
                </div>
                <button class="btn btn-secondary" onclick="addcategory()">Create</button>
                </div>
                <!-- Add Categort End---->
@endsection
<script>
    function errors(err,type){
             return '<div class="alert '+type+'" role="alert">'+err+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
        function addcategory(){
            var title=document.getElementById('title').value;
            var detail=document.getElementById('detail').value;

            var messages='';
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var data;
data = new FormData();
data.append( 'image', $( '#image' )[0].files[0] );
data.append('title',title);
data.append('detail',detail);


            $.ajax({
                url: 'http://localhost:8000/admin/category',
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
                    else if(message['image']){
                        messages=errors(message['image'],'alert-danger');

                    }
                    else if(message='success'){
                        messages=errors('Category created successfully','alert-success');
                        window.location.href='/admin/category';

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