
@extends('layout')
@section('content')
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<div class="card push-top">
  <div class="card-header">
    Edit & Update
  </div>
  <div class="card-body">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
    
    <form method="post" action="{{ route('customer.update', ['customerId' => $customer->id]) }}">
          <div class="form-group">
              @csrf
              @method('put')
              <?php
    // Split the 'name' into an array containing first name and last name
    $nameArray = explode(' ', $customer->name);
    $first_name = $nameArray[0];
    $last_name = $nameArray[1] ?? ''; // In case the last name is not provided, set it to an empty string
    ?> 
        <div class="form-group">
            <label for="name">firstname</label>
              <input type="text" class="form-control" name="first_name"  id="first_name" value="{{ $first_name }}" >
          </div>
          <div class="form-group">
              <label for="email">lastname</label>
              <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $last_name }}" />
          </div>
          <div class="form-group">
              <label for="phone">Email</label>
              <input  type="email" class="form-control" name="email" id="email" value="{{ $customer->email }}"/>
          </div>
         
          <button type="submit" class="btn btn-block btn-secondary">Update User</button>
          <a  class="btn btn-block btn-danger " href="/display">back</a>
         


      </form>
  </div>
</div>
@endsection








