<!DOCTYPE html>
<html>
<head>
  <title> Admin Dashboard</title>
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>

<div class="container mt-4">
      <!-- Display the flash message if it exists in the session -->
      @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <center><h1>Super Admin Dashboard</h1></center> 
                   


                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <td>Pic</td>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $user) 
                                    <tr>
                                     <td><?= $user['id'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td>
                                                <!-- Display the user's profile image -->
                                                <img src="{{ asset('storage/' . $user->profile) }}" alt="Profile Image" width="100">
                                            </td>
                                        <td><?= $user['role'] ?></td>
                                        <td>
                                        <a class="btn btn-secondary" href="" aria-label="Delete">
                                        <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('users.delete', ['id' => $user->id]) }}"
                                                    class="btn btn-danger"
                                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                                        <i class="fas fa-trash-alt"></i> 
                                                    </a>
                                                    <form id="delete-form-{{ $user->id }}" action="{{ route('users.delete', ['id' => $user->id]) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>                  


                                        </td>
                                    </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="/logout" class="fa fa-sign-out fa-2x" style="margin: 1% 0 0 90%;"></a>


                </div>
            </div>
        </div>
    </div>
</div>
