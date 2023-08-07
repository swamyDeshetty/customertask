<!DOCTYPE html>
<html>
<head>
  <title> Admin Dashboard</title>
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>


   <!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<!----------------------------------------------- Start Add New Modal ---------------------------------------------------------------------->
<div class="modal fade" id="add_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">ADD USER</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="AddModel" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                  <ul class="alert alert-warning d-none" id="saveform_errList"></ul>
                    <div class="form-group-md-3">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group-md-3">
                      <label>Email</label>
                      <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group-md-3">
                      <label>Profile</label>
                      <input type="file" name="profile" class="form-control">
                    </div>
                    <div class="form-group-md-3">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control">
                    </div>
           </div>
      </form>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary add_user">Save</button>
      </div>
    </div>
  </div>
</div>
<!---------------------------------------- End Add New Modal --------------------------------------------------------------------------- -->




<div class="container mt-4">
      <!-- Display the flash message if it exists in the session -->
      @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
    <div class="row">
        <div class="col-md-12">
          <div id="success_message"></div>
              <div class="card">
                  <div class="card-header">
                    <center><h1 style="color:green"> Admin Dashboard</h1></center> 
                    <a href="" class="btn btn-info" style="">Aproove User</a>
                    <a  class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#add_user" style="float:right">Add User</a>
                  </div>
                  <div class="card-body">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Profile</th>
                                  <th>Role</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                      </table>
                      <a href="/logout" class="fa fa-sign-out fa-2x" style="margin: 1% 0 0 90%;"></a>
                  </div>   
              </div>
        </div>
    </div>
</div>


<!---------------------------------------------------------------- Update User Model --------------------------------------------------->
<div class="modal fade" id="update_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="Update_user_form" method="POST" enctype="multipart/form-data">
            
          <div class="modal-body">

              <input type="hidden" name="emp_id" id="emp_id">

                  <ul class="alert alert-warning d-none" id="update_errorList"></ul>

                    <div class="form-group-md-3">
                      <label>Name</label>
                      <input type="text" name="name" id="edit_name" class="form-control">
                    </div>
                    <div class="form-group-md-3">
                      <label>Email</label>
                      <input type="text" name="email" id="edit_email" class="form-control">
                    </div>
                    <div class="form-group-md-3">
                      <label>Profile</label>
                      <input type="file" name="profile"  class="form-control">
                    </div>
           </div>
      </form>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn_update">Update</button>
      </div>
    </div>
  </div>
</div>

<!-------------------------------------------- Update User Model ----------------------------------------------------------------------->
<!-- start Delete User Model -->

<div class="modal fade" id="Delete_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">ADD USER</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                
            <h4>Are you Sure ? you want to delete this user?</h4>
            <input type="hidden" id="deleting_emp_id">
           </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="delete_modal_btn btn btn-primary add_user">Yes Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- End Delete User Model -->

<script>
          $(document).ready(function (){

                            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //Fetch Users data from the database in the page using the Jquery..
                fetchUsers();
                function fetchUsers()
                {
                   $.ajax({
                    type: "GET",
                    url : "/fetch",
                    dataType:'json',  
                    success: function (response) {
                        $('tbody').html(''),   // whenever the page loads this empty the table...
                        $.each(response.data, function (key, item){
                            $('tbody').append('<tr>\
                                        <td>'+item.id+'</td>\
                                        <td>'+item.name+'</td>\
                                        <td>'+item.email+'</td>\
                                        <td>'+item.role+'</td>\
                                        <td><img src="storage/'+item.profile+'" alt="Profile Image" width="100"></td>\
                                    <td>\
                                      <button type="button" value='+item.id+' class="edit_btn btn btn-success btn-sm">Edit</button>\
                                      <button type="button" value='+item.id+' class="delete_btn btn btn-danger btn-sm">Delete</button>\
                                    </td>\
                                    </tr>');

                        });

                  }

                });
              }

              // Add User Jquery code
              $(document).on('click','.add_user', function (e){
                  e.preventDefault();
                  // console.log('swamy');

                  let formData = new FormData($('#AddModel')[0]);


                  $.ajax({
                    type: "POST",
                    url : "/add_user",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response){

                      if (response.status == 400) 
                      {
                          $('#saveform_errList').html('');
                          $('#saveform_errList').removeClass('d-none');
                          $.each(response.errors, function (key, err_values) {
                            $('#saveform_errList').append('<li>' + err_values + '</li>');
                      });
                    } 
                    else if(response.status == 200)
                    {
                        $('#saveform_errList').html('');
                        $('#saveform_errList').addClass('d-none');

                        $('#AddModel').find('input').val('');
                        $('#add_user').modal('hide');

                        fetchUsers();
                        // Show SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2500 // Display the popup for 2.5 seconds
                        });

                    }
                     

                    },
             
                  });
              })


              // Edit  User's Jquery code...
              $(document).on('click', '.edit_btn', function(e){
                    e.preventDefault();
                    
                    var emp_id = $(this).val();
                    $('#update_modal').modal('show');
                    // alert(emp_id);

                    $.ajax({
                    type: "GET",
                    url : "/edit_user/"+emp_id,
                    success: function (response) {
                    
                    if(response.status == 404)
                    {
                        alert(response.message);
                        $('#update_modal').modal('hide');
                      
                    }
                    else
                    {

                      $('#edit_name').val(response.data.name);
                      $('#edit_email').val(response.data.email);
                      $('#emp_id').val(emp_id);


                    }


                    

                    }
                    
              })
            });

            // Update Users Jquery code....
                $(document).on('click','.btn_update',function(e){
                  e.preventDefault();
                  // alert('hello');
                  var id = $('#emp_id').val();
                  let EditformData = new FormData($('#Update_user_form')[0]);

                  $.ajax({
                    type: "POST",
                    url : "/update_user/"+id,
                    data: EditformData,
                    contentType: false,
                    processData: false,
                    success: function (response){
                      if(response.status == 400)
                      {
                        $('#update_errorList').html('');
                          $('#update_errorList').removeClass('d-none');
                          $.each(response.errors, function (key, err_values) {
                            $('#update_errorList').append('<li>' + err_values + '</li>');
                      });
                        
                      }
                      else if(response.status == 404)
                      {
                          alert(response.message);
                      }
                      else if(response.status == 200)
                      {
                        $('#update_errorList').html('');
                        $('#update_errorList').addClass('d-none');

                        $('#update_modal').modal('hide');
                       // Show SweetAlert success message
                       Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2500 // Display the popup for 1.5 seconds
                        });

                        fetchUsers();


                      }
                      
                      
                    }

                  });

                });
              
          // Delete Users Jquery code...

          $(document).on('click','.delete_btn',function(e){
            e.preventDefault();
            
            var emp_id = $(this).val();
            $('#Delete_user').modal('show');
            $('#deleting_emp_id').val(emp_id);

          });

          $(document).on('click','.delete_modal_btn',function(e){
              e.preventDefault();

              var id = $('#deleting_emp_id').val();

              $.ajax({
                type: "DELETE",
                url: "/delete-user/"+id,
                dataType: "json",
                success: function(response){
                  if(response.status == 404)
                  {
                    alert(response.message);
                    $('#Delete_user').modal('hide');
                     
                  }else if(response.status == 200)
                  {
                    fetchUsers();
                    $('#Delete_user').modal('hide');
                    Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000 // Display the popup for 2.5 seconds
                        });


                  }

                }
              });

          })

























          })
</script>
<!-- Add New User Model -->
<!-- Edit User Model -->
<script>

</script>