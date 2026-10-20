<aside class="sidebar">

    <div class="sidebar-brand">

        <div class="brand-icon">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <div>
            <div class="brand-title">
                Damietta IP Portal
            </div>

            <div class="brand-subtitle">
                Intellectual Property System
            </div>
        </div>

    </div>


    <div class="sidebar-section-title">
        Main Menu
    </div>

    <nav class="sidebar-menu">

        <a href="#" class="active">
            <i class="fa-solid fa-grid-2"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{route('admin.users.index')}}">
            <i class="fa-solid fa-users"></i>
            <span>User Management</span>
        </a>

        <a href="{{route('admin.students.index')}}">
            <i class="fa-solid fa-user-graduate"></i>
            <span>Students</span>
            <span class="menu-badge">248</span>
        </a>

        <a href="{{route('admin.executive-members.index')}}">
            <i class="fa-solid fa-building-columns"></i>
            <span>Executive Office Members</span>
        </a>

        <a href="{{route('admin.committee-members.index')}}">
            <i class="fa-solid fa-users-gear"></i>
            <span>Committee Members</span>
        </a>

        <a href="{{route('admin.ethics-committee-members.index')}}">
            <i class="fa-solid fa-scale-balanced"></i>
            <span>Ethics Committee Members</span>
        </a>


        <div class="sidebar-section-title px-2">
            Intellectual Property
        </div>

        <a href="#">
            <i class="fa-solid fa-file-shield"></i>
            <span>Research Management</span>
            <span class="menu-badge">32</span>
        </a>

        <a href="#">
            <i class="fa-solid fa-link"></i>
            <span>Blockchain Records</span>
        </a>

        <a href="#">
            <i class="fa-solid fa-bell"></i>
            <span>Notifications</span>
            <span class="menu-badge">7</span>
        </a>


        <div class="sidebar-section-title px-2">
            System
        </div>

        <a href="#">
            <i class="fa-solid fa-chart-column"></i>
            <span>Reports & Statistics</span>
        </a>

        <a href="#">
            <i class="fa-solid fa-gear"></i>
            <span>Settings</span>
        </a>

        <a href="#">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>

    </nav>


    <div class="sidebar-footer">

        <div class="sidebar-footer-card">

            <div class="d-flex align-items-center gap-2 mb-2">

                <i class="fa-solid fa-circle-check text-success"></i>

                <strong style="font-size:11px;">
                    System Operational
                </strong>

            </div>

            <small>
                All portal services are running normally.
            </small>

        </div>

    </div>

</aside>