
@extends('admin.layout')
@section('title',$title)
@section('meta_desc',$title)
@section('content')
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>
                        
                    </div>

                    <!-- Table Start -->
                      <!-- DataTales Example -->
                      <div class="card shadow mb-4">
                        <div class="card-header py-3 clearfix">
                            <h6 class="m-0 font-weight-bold text-primary" style="display:initial">{{$title}}</h6>
                            <button class="btn btn-primary float-right" onclick="window.location.href='/admin/post/create'">Add Post</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="errors"></div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Title</th>
                                            <th>Thumbnail</th>
                                            <th>Full Image</th>
                                            <th>Detail</th>
                                            <th>Tags</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                                        @for($i=0;$i<count($data);$i++)
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>{{$data[$i]['title']}}</td>
                                            <td><img src="/storage/images/post/thumb/{{$data[$i]['thumbnail']}}" style="height:100px;" alt="{{$data[$i]['title']}}"/></td>
                                            <td><img src="/storage/images/post/fullimg/{{$data[$i]['full_image']}}" style="height:100px;" alt="{{$data[$i]['title']}}"/></td>
                                            <td>{{$data[$i]['detail']}}</td>
                                            <td>{{$data[$i]['tags']}}</td>
                                            @for($j=0;$j<count($data2);$j++)
                                                @if($data2[$j]['id']==$data[$i]['category_id'])
                                                <td>{{$data2[$j]['title']}}</td>
                                                @endif
                                            @endfor
                                            <td><button onclick="editpost(this.id)" id="{{$data[$i]['id']}}" class="btn btn-warning">Edit</button><button onclick="deletepost(this.id)" id="{{$data[$i]['id']}}" class="btn btn-danger" style="margin-left:10px;">Delete</button></td>
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
        function errors(err,type){
             return '<div class="alert '+type+'" role="alert">'+err+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
        function deletepost(id){
            var messages='';
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
            type: 'DELETE',
            url: '/admin/post/'+id,
            dataType:"json",
            success: function(response){
                console.log(response);
                var message=response.message;
                if(message=="success"){
                    messages=errors('Post Deleted Successfully','alert-success');
                    window.location.href='/admin/postlist';
                }
                else{
                    messages=errors(message,'alert-danger');
                }
                $('#errors').html(messages);
            }
            });
        }
        function editpost(id){
            window.location.href="/admin/post/"+id;
        }
    </script>
