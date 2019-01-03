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

        <!-- patient -->
        <li class="<?php if ($page_name == 'patient') echo 'active'; ?> ">
            <a href="<?php echo $account_url; ?>patient">
                <i class="entypo-user"></i>
                <span>Patients</span>
            </a>
        </li>

        <!-- Report -->
        <li class="<?php if ($page_name == 'report' || $page_name == 'add_report' || $page_name == 'edit_report' || $page_name == 'view_report') echo 'active'; ?> ">
            <a href="<?php echo $account_url; ?>report">
                <i class="entypo-book"></i>
                <span>Report</span>
            </a>
        </li>

        <!-- TESTS -->
        <li class="<?php if ($page_name == 'test' || $page_name == 'add_test' || $page_name == 'edit_test') echo 'active'; ?> ">
            <a href="<?php echo $account_url; ?>test">
                <i class="entypo-book-open"></i>
                <span>Lab Test</span>
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