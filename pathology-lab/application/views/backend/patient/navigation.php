<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url();?>uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style=""></div>
    <ul id="main-menu" class="">


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo $account_url; ?>dashboard">
                <i class="entypo-gauge"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Report -->
        <li class="<?php if ($page_name == 'report' || $page_name == 'view_report') echo 'active'; ?> ">
            <a href="<?php echo $account_url; ?>report">
                <i class="entypo-book"></i>
                <span>Report</span>
            </a>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo $account_url; ?>manage_profile">
                <i class="entypo-lock"></i>
                <span>Account</span>
            </a>
        </li>

    </ul>

</div>