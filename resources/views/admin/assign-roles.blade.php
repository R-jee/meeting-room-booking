@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Assign Roles and Permissions</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('assign.roles.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">Select User</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">-- Select User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="roles" class="form-label">Assign Roles</label>
                <select name="roles[]" id="roles" class="form-select" multiple>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="permissions" class="form-label">Assign Permissions</label>
                <select name="permissions[]" id="permissions" class="form-select" multiple>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection
