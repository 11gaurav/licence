<!-- Navigation Bar-->
<header id="topnav" style="padding-right: 10px" >
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
                        <?php
                            if ($user_type == "User")
                            {
                                ?>

                                <a href="<?php echo base_url(); ?>admin/change_password/change_password" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Change Password</span>
                                </a>

                            <?php } ?>

                        <a href="<?php echo base_url(); ?>admin/user/logout" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>
            </ul>
            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <a href="#" class="logo">

                        <span class="logo-lg">
                            <img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="">
                        </span>
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
                            <i class="fe-layers"></i>Dashboard
                        </a>
                    </li>


                    <li class="has-submenu">
                        <a href="#">
                            <i class="fe-layers"></i>Master</a>
                        <ul class="submenu">

                            <?php
                                if ($user_type == "Admin")
                                {
                                    if (in_array("users", $menu))
                                    {
                                        ?>
                                        <li><a href="<?php echo base_url(); ?>admin/user/list_users">Users</a></li>
                                        <?php
                                    }
                                }
                            ?>

                            <?php
                                if (in_array("client", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/client/list_client">Client</a></li>   
                                <?php } ?>


                            <?php
                                if (in_array("offer_status", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/offer_status/list_offer_status">Offer Status</a></li> 
                                <?php } ?>

                            <?php
                                if (in_array("order_status", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/order_status/list_order_status">Order Status</a></li> 
                                <?php } ?>



                            <?php
                                if (in_array("enduser", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/enduser/list_enduser">End User</a></li> 
                                <?php } ?>

                            <?php
                                if (in_array("sector", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/sector/list_sector">Sector</a></li>  
                                <?php } ?>


                            <?php
                                if (in_array("order_possibility", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/order_possibility/list_order_possibility">Order Possibility</a></li>                           
                                <?php } ?>


                            <?php
                                if (in_array("plant", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/plant/list_plant">Plant</a></li>  
                                <?php } ?>


                            <?php
                                if (in_array("enquiry_type", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/enquiry_type/list_enquiry_type">Enquiry Type</a></li>   
                                <?php } ?>

                            <?php
                                if (in_array("vendor", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/vendor/list_vendor">Vendor</a></li>  
                                <?php } ?>


                            <?php
                                if (in_array("pricing", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/pricing/list_pricing">Pricing</a></li>   
                                <?php } ?>


                            <?php
                                if (in_array("currency", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/currency/list_currency">Currency</a></li>   
                                <?php } ?>

                            <?php
                                if (in_array("project", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/project/list_project">Project</a></li>   
                                <?php } ?>

                            <?php
                                if (in_array("stage", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/stage/list_stage">Stage</a></li>   
                                <?php } ?>
                            <?php
                                if (in_array("task", $menu))
                                {
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>admin/task/list_task">Task</a></li>   
                                <?php } ?>

                            <!--<li><a href="<?php echo base_url(); ?>admin/email_template/list_email_template">Email Template</a></li>-->
                        </ul>
                    </li>


                    <?php
                        if (in_array("enquiry", $menu))
                        {
                            ?>
                            <li><a href="<?php echo base_url(); ?>admin/enquiry/list_enquiry"><i class="fe-layers"></i>Enquiry</a></li>  
                        <?php } ?>

                    <?php
//                        p($menu);
                        if (in_array("target_opportunity", $menu))
                        {
                            ?>
                            <li><a href="<?php echo base_url(); ?>admin/target_opportunity/list_target_opportunity"><i class="fe-layers"></i>Target Opportunity</a></li>                           

                        <?php } ?>

                    <?php
//                        p($menu);
                        if (in_array("offer_letter", $menu))
                        {
                            ?>
                            <li><a href="<?php echo base_url(); ?>admin/offer_letter/list_offer_letter"><i class="fe-layers"></i>Offer Letter</a></li>  
                        <?php } ?>
                    <?php
                        if ($user_type == "Admin")
                        {
                            ?>
                            <li><a href="<?php echo base_url(); ?>admin/user_activities/user_activity_report"><i class="fe-layers"></i>User Activities</a></li>                           
                        <?php } ?>

                    <?php
                        if (in_array("task-list", $menu))
                        {
                            ?>
                            <li><a href="<?php echo base_url(); ?>admin/task_list/list_task_list"><i class="fe-layers"></i>Task List</a></li>                           
                        <?php } ?>

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
