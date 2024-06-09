<div class="az-navbar az-navbar-two">
    <div class="container-fluid">
        <div><a href="<?php echo base_url(); ?>" class="az-logo">TRT <span>Planner</span></a></div>
        <div class="az-navbar-search">
            <input type="search" class="form-control" placeholder="Search for schedules and events...">
            <button class="btn"><i class="fas fa-search "></i></button>
        </div><!-- az-navbar-search -->
        <ul class="nav">
            <li class="nav-label">Main Menu</li>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>" class="nav-link"><i class="typcn typcn-clipboard"></i>Dashboard</a>
            </li><!-- nav-item -->
            <?php //if(has_permission('Planner.Planner_calendar.View')): ?>
            <li class="nav-item <?php echo $this->uri->segment(1) == "planner" ? "active" : ""; ?>">
                <a href="<?php echo base_url(); ?>planner" class="nav-link"><i class="typcn typcn-calendar-outline"></i>Planner</a>
            </li><!-- nav-item -->
            <?php //endif; ?>
            <?php if(has_permission('Planner.Mappings.View')): ?>
            <li class="nav-item <?php echo $this->uri->segment(1) == "mapping" ? "active" : ""; ?>">
                <a href="" class="nav-link with-sub"><i class="typcn typcn-cog"></i>Mapping</a>
                <nav class="nav-sub">
                    <a href="<?php echo base_url(); ?>mapping/job_types" class="nav-sub-link">Manage Job Types</a>
                    <a href="<?php echo base_url(); ?>mapping/job_areas" class="nav-sub-link">Job Areas</a>
                    <a href="<?php echo base_url(); ?>mapping/lines" class="nav-sub-link">Lines & Tanks</a>
                </nav>
            </li><!-- nav-item -->
            <?php endif; ?>
            <?php if(has_permission('Planner.User_accounts.View_users')): ?>
            <li class="nav-item <?php echo $this->uri->segment(1) == "user_accounts" ? "active" : ""; ?>">
                <a href="" class="nav-link with-sub"><i class="typcn typcn-user"></i>Users</a>
                <nav class="nav-sub">
                    <a href="<?php echo base_url(); ?>user_accounts" class="nav-sub-link">Manage Users</a>
                </nav>
            </li><!-- nav-item -->
            <?php endif; ?>
        </ul><!-- nav -->
    </div><!-- container -->
</div><!-- az-navbar -->
