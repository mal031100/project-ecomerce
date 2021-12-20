@extends('admin.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit User</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('amin/user/update-user/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" value="{{$user->name}}" name="name" id="">
                        @error('name')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" value="{{$user->email}}" name="email">
                        @error('email')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" value="{{$user->phone}}" name="phone">
                        @error('phone')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" value="{{$user->address}}" name="address">
                        @error('address')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="role" >
                            <option selected><h4>{{$user->role}}</h4></option>
                            <option value="1">Member</option>
                            <option value="2">Admin</option>
                            <option value="3">Super Admin</option>
                          </select>
                          @error('role')
                              <small class="help-block">{{ $message }}</small>
                          @enderror
                    </div>
                    <div class="col-md-12 ">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection