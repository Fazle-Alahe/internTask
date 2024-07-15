@extends('dashboard.dashboard')
@section('content')
@can('role_manage')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>User list</h3>
                </div>
                
                @if (session('role_remove'))
                    <div class="alert alert-danger mt-2">{{session('role_remove')}}</div>
                @endif

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td class="text-wrap">
                                    @forelse ($user->getRoleNames() as $role)
                                        <span class="badge badge-secondary my-1">{{$role}}</span>
                                    @empty
                                        <span class="badge badge-light my-1">Not assigned</span>
                                    @endforelse
                                </td>
                                <td>
                                    <a href="{{route('remove.role',$user->id)}}" class="btn btn-danger">Remove role</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">
                    <h3>Role list</h3>
                </div>
                
                @if (session('delete'))
                    <div class="alert alert-danger mt-2">{{session('delete')}}</div>
                @endif

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{$role->name}}</td>
                                <td class="text-wrap">
                                    @foreach ($role->getPermissionNames() as $permission)
                                        <span class="badge badge-secondary my-1">{{$permission}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('delete.role',$role->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add New Permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('add.permission')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Permission name</label>
                            <input type="text" name="permission_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add permission</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="card mt-5">
                <div class="card-header">
                    <h3>Add New Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('role.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Role name</label>
                            <input type="text" name="role_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            @foreach ($permissions as $permission)  
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permission[]" id="per{{$permission->id}}" value="{{$permission->name}}">
                                    <label class="form-check-label" for="per{{$permission->id}}">
                                        {{$permission->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add role</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">
                    <h3>Assign Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('assign.role')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="user_id" class="form-control">
                                <option value="">Select user</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="role" class="form-control">
                                <option value="">Select role</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Assign role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endcan
@endsection