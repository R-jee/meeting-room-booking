@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users with Roles and Permissions</h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Permissions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->roles->isNotEmpty())
                            <ul>
                                @foreach($user->roles as $role)
                                    <li>{{ $role->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <em class="text-danger">No roles assigned</em>
                        @endif
                    </td>
                    <td>
                        @if($user->roles->isNotEmpty())
                            <ul>
                                @foreach($user->roles as $role)
                                    @foreach($role->permissions as $permission)
                                        <li class="badge rounded-pill text-bg-dark">{{ $permission->name }}</li>
                                    @endforeach
                                @endforeach
                            </ul>
                        @else
                            <em class="text-danger">No permissions assigned</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No users found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
