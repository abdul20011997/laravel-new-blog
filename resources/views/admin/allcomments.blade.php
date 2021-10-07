
@extends('admin.layout')
@section('title','Comments List')
@section('meta_desc','Comments List')
@section('content')
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Comments List</h1>
                        
                    </div>

                    <!-- Table Start -->
                      <!-- DataTales Example -->
                      <div class="card shadow mb-4">
                        <div class="card-header py-3 clearfix">
                            <h6 class="m-0 font-weight-bold text-primary" style="display:initial">Comments List</h6>
                            <!-- <button class="btn btn-primary float-right" onclick="window.location.href='/admin/category/create'">Add Category</button> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="errors"></div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Post By</th>
                                            <th>Post Title</th>
                                            <th>Comment</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i=0;$i<count($data);$i++)
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>{{$data[$i]->user->name}}</td>
                                            <td>{{$data[$i]->post->title}}</td>
                                            <td>{{$data[$i]['comment']}}</td>
                                            <td>{{$data[$i]['created_at']}}</td>
                                            <td><button class="btn btn-danger" onclick="deletecomment(this.id)" id="{{$data[$i]['id']}}">Delete</button></td>

                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Table End -->


    @endsection
    <script>
        function deletecomment(id){
            var messages='';
            var data;
            data = new FormData();
            data.append('id',id);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
            url: '/admin/deletecomment',
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(response){
                console.log(response);
                var message=response.message;
                if(message=="success"){
                    messages=errors('Comment Deleted Successfully','alert-success');
                    window.location.href='/admin/comments';
                }
                else{
                    messages=errors(message,'alert-danger');
                }
                $('#errors').html(messages);
            }
            });
        }

        function errors(err,type){
             return '<div class="alert '+type+'" role="alert">'+err+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
        
        function editcategory(id){
            window.location.href="/admin/category/"+id;
        }
    </script>
