<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Blog - Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <!-- <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9"> -->

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <div id="errors"></div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." >
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Password" >
                                        </div>

                                        <button onclick="login()" class="btn btn-primary btn-user btn-block" >
                                            Login
                                        </button>
                                    </form>

                                    <div class="text-center" style="margin-top:10px;">
                                        <a class="small" href="register">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- </div>

        </div> -->

    </div>
    <script>
        function errors(err,type){
             return '<div class="alert '+type+'" role="alert">'+err+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
        function login(){
            var email=document.getElementById('email').value;
            var password=document.getElementById('password').value;
            var messages='';
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
            $.ajax({
            type: 'POST',
            url: '/login',
            data:{email:email,password:password},
            dataType:"json",
            success: function(response){
                var message=response.message;
                console.log(message);
                if(message['email']){
                    messages=errors(message['email'],'alert-danger');
                }
                else  if(message['password']){
                    messages=errors(message['password'],'alert-danger');
                }
                else if(message=='success'){
                    messages=errors('Login Successfully!!','alert-success');
                    window.location.href='/';
                }
                else{
                    messages=errors(message,'alert-danger');
                }
                $('#errors').html(messages);
                
            }
            });
  

        }
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>