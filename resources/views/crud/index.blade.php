
<!-- Include the DataTables library and CSS -->
<!-- ... -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

<!-- bootstrap links -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


<style>
  .push-top {
    margin-top: 50px;
  }
  .table{
    margin: 9% 19% 17% 3%;
  }
  h1{
        text-align: center;
    color: aqua;
    font-family: cursive;
  }
 
</style>



<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <h1>Crud Operations in laravel</h1>
  <table id="table table-hover bg-dark">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Name</td>
          <td>Email</td>
          <td>Phone</td>
          <td>Password</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($student as $students)
        <tr>
            <td>{{$students->id}}</td>
            <td>{{$students->name}}</td>
            <td>{{$students->email}}</td>
            <td>{{$students->phone}}</td>
            <td>{{$students->password}}</td>
            <td class="text-center">
                <a href="{{ route('crud.edit', $students->id)}}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('crud.destroy', $students->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>

<div>
  <script>
    $(document).ready(function(){
      $('#table').dataTable();
    });

  </script>
<a href="{{ route('crud.create')}}" class="btn btn-warning" style=" margin: 22px 0 0 89%">Add New</a>



