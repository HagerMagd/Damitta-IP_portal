<aside class="sidebar">

    <div class="logo">

        <div class="logo-icon">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <div>
            <h5>Damietta</h5>
            <span>IP Portal</span>
        </div>

    </div>


    <ul>

        <li class="active">
            <a href="{{route('student.dashboard.home')}}">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{route('student.dashboard.projects.index')}}">
                <i class="fa-solid fa-folder"></i>
                My Projects
            </a>
        </li>

        <li>
            <a href="{{route('student.dashboard.projects.create')}}">
                <i class="fa-solid fa-upload"></i>
                Submit Project
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-shield"></i>
                Blockchain Certificates
            </a>
        </li>

        <li>
            <a href="{{route('student.dashboard.notifications.index')}}">
                <i class="fa-regular fa-bell"></i>

                Notifications

                <span class="badge rounded-pill bg-primary ms-auto">
                    {{auth()->user()->unreadNotifications()->count()}}
                </span>

            </a>
        </li>

        <li>
            <a href="{{route('student.dashboard.profile.index')}}">
                <i class="fa-regular fa-user"></i>
                Profile
            </a>
        </li>

    </ul>


    <div class="sidebar-footer">

        <a href="#" class="logout">

            <i class="fa-solid fa-arrow-right-from-bracket"></i>

            Logout

        </a>

    </div>

</aside>