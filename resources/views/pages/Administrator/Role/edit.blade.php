@extends('layouts.app')

@section('title','Roles')
@section('content_header_title','Roles')

@section('main-content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Admin</h3>
            <div class="box-tools">
                test
            </div>
        </div>
        <div class="box-body table-responsive">
            <form action="" id="form" method="POST">
                @csrf
                <input type="hidden"
                name="roleId"
                value="{{ $role->roleId }}">
                <div class="form-group">
                    <label for="employeeFirstName">Name<span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $role->name }}">
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Description</label>
                    <input type="text" class="form-control" name="description" value="{{  $role->description }}">
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Menu</th>
                        <th width="10%">View</th>
                        <th width="10%">Add</th>
                        <th width="10%">Edit</th>
                        <th width="10%">Delete</th>
                        <th width="10%">Other</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menuItems as $i => $menuItem)
                        <input type="hidden"
                        name="privileges[{{ $i }}][menuItemId]"
                        value="{{ $menuItem->menuItemId }}">
                        <input type="hidden"
                        @if($menuItem->privilegeId != null)
                        name="privileges[{{ $i }}][privilegeId]"
                        value="{{ $menuItem->privilegeId }}">
                        @endif
                       
                        <tr>
                            <td>{{ $menuItem->name }}</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"
                                               class=""
                                               name="privileges[{{ $i }}][view]"
                                               value="1" @if($menuItem->view) checked @endif>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"
                                               class=""
                                               name="privileges[{{ $i }}][add]"
                                               value="1" @if($menuItem->add) checked @endif>
                                    </label>
                                </div>
                            </td>
                            
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" 
                                               class="" 
                                               name="privileges[{{ $i }}][edit]" 
                                               value="1" @if($menuItem->edit) checked @endif>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" 
                                               class=""     
                                               name="privileges[{{ $i }}][delete]" 
                                               value="1" @if($menuItem->delete) checked @endif>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" 
                                               class="" 
                                               name="privileges[{{ $i }}][other]" 
                                               value="1" @if($menuItem->other) checked @endif>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
