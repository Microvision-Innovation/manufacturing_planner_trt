<div class="az-navbar az-navbar-two">
    <div class="container-fluid">
        <div><a href="index.html" class="az-logo">TRT <span>Planner</span></a></div>
        <div class="az-navbar-search">
            <input type="search" class="form-control" placeholder="Search for schedules and events...">
            <button class="btn"><i class="fas fa-search "></i></button>
        </div><!-- az-navbar-search -->
        <ul class="nav">
            <li class="nav-label">Main Menu</li>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>" class="nav-link"><i class="typcn typcn-clipboard"></i>Dashboard</a>
            </li><!-- nav-item -->
            <li class="nav-item active">
                <a href="<?php echo base_url(); ?>" class="nav-link"><i class="typcn typcn-calendar-outline"></i>Planner</a>
            </li><!-- nav-item -->
            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="typcn typcn-cog"></i>Settings</a>
                <nav class="nav-sub">
                    <a href="<?php echo base_url(); ?>" class="nav-sub-link">Manage Job Types</a>
                    <a href="<?php echo base_url(); ?>" class="nav-sub-link">Job Areas</a>
                    <a href="<?php echo base_url(); ?>" class="nav-sub-link">Lines/Tanks</a>
                </nav>
            </li><!-- nav-item -->
            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="typcn typcn-user"></i>Users</a>
                <nav class="nav-sub">
                    <a href="<?php echo base_url(); ?>" class="nav-sub-link">Manage Users</a>
                </nav>
            </li><!-- nav-item -->

        </ul><!-- nav -->
    </div><!-- container -->
</div><!-- az-navbar -->
