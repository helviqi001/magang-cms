@extends('layouts.app')

@section('title','Create Admin')
@section('content_header_title','Create Admin')

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
                    <input type="text" class="form-control" name="name" edit>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
               
                <div class="form-group">
                    <label for="employeeFirstName">Role<span class="text-red">*</label>
                    <select class="form-control" name="roleId" id="cars" value="{{ old('roleId') }}" >
                    @foreach ($roles->items as $role)
                        <option value="{{$role->roleId}}">{{$role->name}}</option>
                    @endforeach
                    </select>
                @error('roleId')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Username<span class="text-red">*</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>  
                <div class="form-group">
                    <label for="employeeFirstName">Email<span class="text-red">*</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Avatar<span class="text-red">*</label>
                    <input type="file" class="form-control" name="avatar" class="form-control" accept="image/*" value="{{ old('avatar') }}" required>
                @error('avatar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>  
                <div class="form-group">
                    <label for="employeeFirstName">Birthdate<span class="text-red">*</label>
                    <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}" required>
                @error('birthdate')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Password<span class="text-red">*</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                <div class="form-group">
                    <label for="employeeFirstName">ComfirmPassword<span class="text-red">*</label>
                    <input type="password" class="form-control" name="confirmpassword" value="{{ old('confirmpassword') }}" required >
                @error('confirmpassword')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                {{-- <h5 class="box-title"><span class="text-red">* red star information is required</h6> --}}
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
