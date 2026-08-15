 <!-- Header/Navigation -->
 <header class="header">
     <div class="container">
         <div class="nav-wrapper">
             <!-- Logo -->
             <div class="logo">
                 <div class="logo-icon">
                     <i class="fas fa-shield-alt"></i>
                 </div>
                 <span class="logo-text">Damietta IP Portal</span>
             </div>

             <!-- Navigation -->
             <nav class="nav">
                 <a href="/submit" class="nav-link">Submit Work</a>
                 <a href="/verify" class="nav-link">Verify Project</a>
                 <a href="/projects" class="nav-link">Browse Projects</a>
                 <a href="/about" class="nav-link">About</a>
                 <a href="/contact" class="nav-link">Contact Us</a>

                 <!-- Authentication -->
                 @guest
                     <a href="/login" class="btn btn-outline">Login</a>
                     <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                 @endguest

                 @auth


                   @switch(auth()->user()->role)
                             @case('student')
                               <a href="{{ route('student.dashboard.home') }}" class="btn btn-outline">
                         Dashboard
                     </a
                                
                             @break

                             @case('committee_member')
                                 <a href="{{ route('committee.dashboard.home') }}">Dashboard</a>
                             @break

                             @case('executive')
                                 <a href="{{ route('executive.dashboard.home') }}">Dashboard</a>
                             @break
                         @endswitch
                   >

                     <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                         @csrf
                         <button type="submit" class="btn btn-primary">
                             Logout
                         </button>
                     </form>
                 @endauth
             </nav>



             <!-- Mobile menu button -->
             <div class="mobile-menu-btn">
                 <i class="fas fa-bars"></i>
             </div>
         </div>
     </div>
 </header>
