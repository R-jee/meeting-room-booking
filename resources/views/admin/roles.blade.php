@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Roles</h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Role Name</th>
                <th>Permissions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @if($role->permissions->isNotEmpty())
                            <ul>
                                @foreach($role->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <em>No permissions assigned</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No roles found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
