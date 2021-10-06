
@extends('admin.layout')
@section('title','Users List')
@section('meta_desc','Users List')
@section('content')
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Users List</h1>
                        
                    </div>

                    <!-- Table Start -->
                      <!-- DataTales Example -->
                      <div class="card shadow mb-4">
                        <div class="card-header py-3 clearfix">
                            <h6 class="m-0 font-weight-bold text-primary" style="display:initial">Users List</h6>
                            <!-- <button class="btn btn-primary float-right" onclick="window.location.href='/admin/category/create'">Add Category</button> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="errors"></div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i=0;$i<count($data);$i++)
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>{{$data[$i]['name']}}</td>
                                            <td>{{$data[$i]['email']}}</td>
                                            <td>{{$data[$i]['created_at']}}</td>
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
        function deletecategory(id){
            var messages='';
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
            type: 'DELETE',
            url: '/admin/category/'+id,
            dataType:"json",
            success: function(response){
                console.log(response);
                var message=response.message;
                if(message=="success"){
                    messages=errors('Category Deleted Successfully','alert-success');
                    window.location.href='/admin/category';
                }
                else{
                    messages=errors(message,'alert-danger');
                }
                $('#errors').html(messages);
            }
            });
        }
        function editcategory(id){
            window.location.href="/admin/category/"+id;
        }
    </script>
