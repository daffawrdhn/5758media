@extends('layouts.dashboard')

@section('content')
<div class="container">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">User</a>
        </li>
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="row justify-content-center">
              <div class="col-md-8">
              <br>
                  <div class="card">
                      <div class="card-header">Edit</div>

                      <div class="card-body">
                        <form action="/dashboard/user/edit/update/{{ $users -> id }}" method="POST">

                          {{ csrf_field() }}
                          {{ method_field('PUT') }}

                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="{{ $users -> name}}" value="{{ $users -> name}}">
                          </div>
                          <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" class="form-control" id="phone" aria-describedby="phone" placeholder="{{ $users -> phone}}" value="{{ $users -> phone}}">
                          </div>
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="{{ $users -> email}}" value="{{ $users -> email}}">
                            <small id="PhonelHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                          </div>
                          <div class="form-group">
                            <label for="usertype">User Type</label>
                            <select class="form-control" id="usertype" name="usertype" value="{{ $users -> usertype}}">
                              <option value="admin">Admin</option>
                              <option value="user">User</option>
                            </select>
                          </div>
                            <button type="reset" class="btn btn-danger pull-right">Reset</button>
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </div>
</div>

@endsection
