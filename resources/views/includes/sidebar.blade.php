<aside class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-primary d-flex sticky-top">
    <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
        <a href="/" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5">{{ config('app.name') }}</span>
        </a>
        {{-- class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start" --}}
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
            id="menu">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link px-sm-0 px-2">
                    <i class="fa-solid fa-house-chimney"></i><span class="ms-1 d-none d-sm-inline text-white">Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a href="{{route('teachers.index')}}" class="nav-link px-sm-0 px-2">
                    <i class="fa-solid fa-person-chalkboard"></i><span class="ms-1 d-none d-sm-inline text-white">Teachers</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('students.index')}}" class="nav-link px-sm-0 px-2">
                    <i class="fa-solid fa-graduation-cap"></i><span class="ms-1 d-none d-sm-inline text-white">Students</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('courses.index')}}" class="nav-link px-sm-0 px-2">
                    <i class="fa-solid fa-book"></i><span class="ms-1 d-none d-sm-inline text-white">Courses</span></a>
            </li>
            {{-- <li class="dropdown">
                <a href="#" class="nav-link dropdown-toggle px-sm-0 px-1" id="dropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fs-5 bi-bootstrap"></i><span class="ms-1 d-none d-sm-inline">Bootstrap</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </li> --}}

        </ul>
        <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="hugenerd" width="28" height="28"
                    class="rounded-circle">
                <span class="d-none d-sm-inline mx-1">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>
</aside>
