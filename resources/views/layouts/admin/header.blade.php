   <header class="top-navbar">

        <label for="mobileSidebarToggle" class="mobile-menu-btn">
            <i class="fa-solid fa-bars"></i>
        </label>


        <div class="page-heading">

            <h4>
                Dashboard
            </h4>

            <ol class="breadcrumb">

                <li class="breadcrumb-item">
                    <a href="{{route('admin.dashboard.home')}}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    Dashboard
                </li>

            </ol>

        </div>


        <div class="nav-actions">

            <div class="navbar-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    placeholder="Search users, research..."
                >

            </div>


            <!-- Notification -->

            <div class="css-dropdown">

                <button class="nav-icon-btn">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notification-dot"></span>
                </button>

                <div class="css-dropdown-menu" style="width:300px;">

                    <div class="px-2 py-2 border-bottom">

                        <strong style="font-size:12px;">
                            Notifications
                        </strong>

                    </div>

                    <a href="#">

                        <span class="notification-icon icon-green">
                            <i class="fa-solid fa-check"></i>
                        </span>

                        <span>
                            Research #IP-204 approved
                            <small class="d-block text-muted">
                                5 minutes ago
                            </small>
                        </span>

                    </a>

                    <a href="#">

                        <span class="notification-icon icon-gold">
                            <i class="fa-solid fa-link"></i>
                        </span>

                        <span>
                            Blockchain verification completed
                            <small class="d-block text-muted">
                                18 minutes ago
                            </small>
                        </span>

                    </a>

                    <a href="#" class="text-center d-block">
                        View all notifications
                    </a>

                </div>

            </div>


            <!-- Profile -->

            <div class="css-dropdown">

                <div class="admin-profile">

                    <div class="admin-avatar">
                        AM
                    </div>

                    <div class="admin-info">

                        <strong>
                            Admin Manager
                        </strong>

                        <small>
                            Administrator
                        </small>

                    </div>

                    <i class="fa-solid fa-chevron-down"
                       style="font-size:9px;color:#94A3B8;"></i>

                </div>


                <div class="css-dropdown-menu">

                    <a href="#">
                        <i class="fa-regular fa-user"></i>
                        My Profile
                    </a>

                    <a href="#">
                        <i class="fa-solid fa-gear"></i>
                        Account Settings
                    </a>

                    <a href="#">
                        <i class="fa-solid fa-lock"></i>
                        Change Password
                    </a>

                    <hr class="my-1">

                    <a href="#" class="text-danger">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </a>

                </div>

            </div>

        </div>

    </header>