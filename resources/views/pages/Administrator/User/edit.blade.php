@extends('layouts.app')

@section('title','Edit Admin')
@section('content_header_title','Edit Admin')

@section('main-content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Admin</h3>
            <div class="box-tools">
                test
            </div>
        </div>
        <div class="box-body">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="employeeFirstName">Name<span class="text-red">*</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
               
                <div class="form-group">
                    <label for="employeeFirstName">Role<span class="text-red">*</label>
                    <select class="form-control" name="roleId" id="cars" value="{{ old('roleId') }}" >
                    @foreach ($roles->items as $role)
                        <option value="{{$role->roleId}}" {{ $user->roleId == $role->roleId ? 'selected':'' }} >{{$role->name}}</option>
                    @endforeach
                    </select>
                @error('roleId')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Username<span class="text-red">*</label>
                    <input type="text" class="form-control" name="username" value="{{ $user->username }}" required>
                @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>  
                <div class="form-group">
                    <label for="employeeFirstName">Email<span class="text-red">*</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Avatar</label>
                    <br>
                    <img src="{{ $user->avatar }}" alt="" width="150px">
                    <input type="file" class="form-control" name="avatar"  accept="image/*" >
                <h5><span class="text-red">*Silahkan diisi jika anda ingin mengganti image</h5>
                </div>  
                <div class="form-group">
                    <label for="employeeFirstName">Birthdate<span class="text-red">*</label>
                    <input type="date" class="form-control" name="birthdate" value="{{ $user->birthDate }}" required>
                @error('birthdate')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Password</label>
                    <input type="password" class="form-control" name="password"  >
                <h5><span class="text-red">*Silakan diisi jika anda ingin mengubah password</h5>
                </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                <div class="form-group">
                    <label for="employeeFirstName">ComfirmPassword </label>
                    <input type="password" class="form-control" name="confirmpassword" >
               
                </div>
            </form>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <button class="btn btn-default" onclick="history.back()">Back</button>
                <button class="btn btn-primary" form="form">Save</button>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
