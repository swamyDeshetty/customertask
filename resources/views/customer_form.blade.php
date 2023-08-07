<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
h4{
    color: aqua;
    font-family: cursive;
    font-size: x-large;

}
</style>
<body>
    <div class="container mt-4  ">
        <div class="row ">
        @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
            <h4>Customers form</h4>
            <form  action="store_data" method="post">
                @csrf
                       
            <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="name" class="form-control" name="first_name"  placeholder="Enter firstname">
            </div>
                   
            <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="name" class="form-control" name="last_name"  placeholder="Enter lastname">
                </div>
                   
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email"  placeholder="Enter email">
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Phone</label>
                <input type="tel" class="form-control" name="phone"  placeholder="Enter Phone">
                </div>

         
            <div class="form-group">
                <label for="exampleInputPassword1">Date_of_birth</label>
                <input type="date" class="form-control" name="date_of_birth" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
</div>
    
</body>
</html>