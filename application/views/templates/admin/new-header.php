<!-- Navigation Bar-->
<header id="topnav">
    <nav class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topbar-right-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <small class="pro-user-name ml-1" ><?php echo get_login_name(); ?></small>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                        <!-- item-->
                        <a href="<?php echo base_url(); ?>admin/user/logout" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <a href="#" class="logo" style="font-size: 1.5em;">
                       New Project
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- end topbar-main -->

    <div class="topbar-menu">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="<?php echo base_url() ?>admin/index/dashboard">
                            <i class="fe-layers"></i>Teacher
                        </a>
                    </li>

                    <li><a href="<?php echo base_url(); ?>admin/candidate_selection/list_candidate_selection">Student</a></li>  
                    <li><a href="<?php echo base_url(); ?>admin/Student/list_student">Fees</a></li>   



                </ul>
                <!-- End navigation menu -->
                <div class="clearfix"></div>
            </div>
            <!-- end #navigation -->
        </div>
        <!-- end container -->
    </div>
    <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->
