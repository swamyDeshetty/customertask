
@extends('layout')
@section('content')


<div class="container mt-4">
  <h1 style="color:powderblue">Customer list</h1>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

  <!-- Date filter form -->
  <form method="POST" action="{{ route('customer.filter') }}" class="mb-3">
    @csrf
    <label for="selected_date">Filter by Date of Birth:</label>
    <input type="date" name="selected_date" id="selected_date" value="{{ old('selected_date') }}">
    <button type="submit" class="btn btn-primary">Filter</button>



  <!-- Display the user list -->
  <table class="table">
    <thead>
      <tr class="table-warning">
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Date_of_birth</th>
        <th>Created_at</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $user)
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->phonenumber}}</td>
        <td>{{$user->date_of_birth}}</td>
        <td>{{$user->created_at}}</td>
        <td class="text-center">
          <a class="btn btn-primary" href="{{ url('customers/'.$user->id.'/edit') }}">Edit</a>
        </td>
      </tr>
      @endforeach
    </tbody>
    <a href="index" class="btn btn-dark">Create Customer</a>
    <br>
  </table>
  </form>
</div>


<div>




