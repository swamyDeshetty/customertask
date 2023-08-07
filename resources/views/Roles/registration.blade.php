<!DOCTYPE html>
<html>
<head>
  <title>Add User</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">


</head>
<style>
    h1{
    color: #00faff;
    font-family: cursive;
    font-style: initial;
    }
</style>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8"> 
                <div class="card">
                    <div class="card-header">
                        <h1> Register Here
                            <a href=""></a>
                        </h1>
                        @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif	
                        @csrf
                    <div class="card-body">
                    <form method="post" action="{{route('register-user')}}" enctype="multipart/form-data">
                       @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                <b><label>Name</label></b>
                                <input type="text" class="form-control" name="name" placeholder="Enter the Name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                <b><label>Email</label></b>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                <b><label for="">Profile</label></b>
                                <input type="file" class="form-control" name="profile" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">        
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" required  />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <button type="submit" class="btn btn-primary">Create User</button>
                            <a href="/custom-login" class="btn btn-secondary">Return Back</a>
                                 </div>

                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
