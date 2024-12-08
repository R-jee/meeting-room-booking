<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Meeting Room Booking</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guest-bookings.create') }}">Room Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employees.index') }}">Manage Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bookings.index') }}">Manage Bookings</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('calendar') }}">Shared Calendar</a></li>

                    {{--                    <li class="nav-item"><a class="nav-link" href="{{ route('roles.view') }}">View Roles</a></li>--}}
                    {{--                    <li class="nav-item"><a class="nav-link" href="{{ route('permissions.view') }}">View Permissions</a></li>--}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Roles & Users</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('roles.view') }}">View Roles-Permissions</a></li>
                            <li><a class="dropdown-item" href="{{ route('assign.roles') }}">Assign Roles & Permissions</a></li>
                            <li><a class="dropdown-item" href="{{ route('users.roles.view') }}">Users with Roles & Permissions</a></li>

                        </ul>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
