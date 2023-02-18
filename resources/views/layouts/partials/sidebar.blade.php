<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $auth->userAuth->avatar }}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                {{--                <p style="overflow: hidden;text-overflow: ellipsis;max-width: 160px;" data-toggle="tooltip" title="{{ $auth->userAuth->name }}">{{ $auth->userAuth->name }}</p>--}}
                <p style="overflow: hidden;text-overflow: ellipsis;max-width: 160px;" data-toggle="tooltip" title="{{ $auth->userAuth->name }}">{{ $auth->userAuth->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                {{--                <small>{{ $auth->userAuth->name }}</small>--}}
            </div>
        </div>
        <style>
            .skin-blue .sidebar-form .btn, .skin-blue .sidebar-form input[type="text"] {
                background-color: whitesmoke;
            }
        </style>
        <form action="" method="GET" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search" required>
                <span class="input-group-btn">
        <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
        </button>
        </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Navigation</li>
            <li class="{{ isActiveUrl('/dashboard') }}">
                <a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>
            <li class="treeview {{ areActiveUrl(['/admin', '/role']) }}">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>User</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ isActiveUrl('/admin') }}"><a href="{{route('index.admin')}}"><i class="fa fa-circle-o"></i> Manage Users</a></li>
                    <li class="{{ isActiveUrl('/role') }}"><a href="{{route('index.role')}}"><i class="fa fa-circle-o"></i> Manage Roles</a></li>
                </ul>
            </li>
            <li  class="{{ isActiveUrl('/kuliner') }}">
                <a href="{{route('index.kuliner')}}"><span>Kuliner</span></a>
            </li>
        </ul>
    </section>
</aside>
