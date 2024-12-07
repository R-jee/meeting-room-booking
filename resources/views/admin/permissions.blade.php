@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Permissions</h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Permission Name</th>
            </tr>
            </thead>
            <tbody>
            @forelse($permissions as $permission)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $permission->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">No permissions found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
