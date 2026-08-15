<header class="top-header">

    <div class="dashboard-header">

    <div>

        <span class="welcome-badge">
            <i class="fa-solid fa-sparkles"></i>
            Welcome Back
        </span>

        <h1 class="dashboard-title">
            {{ auth()->user()->name }}
        </h1>

        <p class="dashboard-subtitle">
            Student Dashboard • Damietta Intellectual Property Portal
        </p>

    </div>

</div>


    <div class="header-right">

        <div class="notification">

            <i class="fa-regular fa-bell"></i>

            <span>{{auth()->user()->unreadNotifications()->count()}}</span>

        </div>


        <div class="profile">

            <img src="{{ asset('storage/'.auth()->user()->image_path)}}">

            <div>

                <h6>{{auth()->user()->name}}</h6>

                <small>{{auth()->user()->role}}</small>

            </div>

            <i class="fa-solid fa-angle-down"></i>

        </div>

    </div>

</header>
