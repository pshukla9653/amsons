<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>AMSONS Admin</title>
        <meta name="description" content="Singh.">
        <meta name="author" content="Tarwinder Singh">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo base_url().IMG; ?>favicon.png">
        <link rel="apple-touch-icon" href="<?php echo base_url().IMG; ?>icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="<?php echo base_url().IMG; ?>icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="<?php echo base_url().IMG; ?>icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="<?php echo base_url().IMG; ?>icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="<?php echo base_url().IMG; ?>icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="<?php echo base_url().IMG; ?>icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="<?php echo base_url().IMG; ?>icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="<?php echo base_url().IMG; ?>icon180.png" sizes="180x180">
        <!-- END Icons -->
        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>bootstrap.min.css">
        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>plugins.css">
        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>main.css">
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>vss.css">
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>cc.css">
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>themes.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().CSS; ?>mdp.css">
        <!-- END Stylesheets -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().JS; ?>jquery-ui-1.11.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url().JS; ?>jquery-ui.multidatespicker.js"></script>
        <script src="<?php echo base_url().JS; ?>vendor/modernizr-respond.min.js"></script>		
    </head>
    <body>
        <!-- Page Wrapper -->
        <div id="loader" style=" display: none;"></div>
        <div id="page-wrapper">
            <!-- Preloader -->
            <div class="preloader themed-background">
                <h1 class="push-top-bottom text-light text-center"><strong>AMSONS</strong>ADMIN</h1>
                <div class="inner">
                    <h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
                    <div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
                </div>
            </div>
            <!-- END Preloader -->
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
                <!-- Main Sidebar -->
                <div id="sidebar">
                    <!-- Wrapper for scrolling functionality -->
                    <div id="sidebar-scroll">
                        <!-- Sidebar Content -->
                        <div class="sidebar-content">
                            <!-- Brand -->
                            <a href="<?php echo base_url(); ?>" class="sidebar-brand">
                                <img src="<?php echo base_url().IMG; ?>favicon.png" alt="" width="57" height="57" border="0" /><span class="sidebar-nav-mini-hide"><strong> AMSONS</strong> </span>
                            </a>
                            <!-- END Brand -->
                            <!-- User Info -->
                            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                                <div class="sidebar-user-avatar">
                                    <a href="<?php echo base_url(); ?>">
                                        <img src="<?php echo base_url().IMG; ?>placeholders/avatars/admin.png" alt="avatar">
                                    </a>
                                </div>
                                <div class="sidebar-user-name"><?php echo $this->session->userdata('admin')['name'] ; ?></div>
                                <div class="sidebar-user-links">
                                    <a href="" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
                                    <a href="" data-toggle="tooltip" data-placement="bottom" title="Messages"><i class="gi gi-envelope"></i></a>
                                    <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                                    <a href="" class="enable-tooltip" data-placement="bottom" title="Settings" onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a>
                                    <a href="<?php echo base_url()?>admin/dashboard/logout" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
                                </div>
                            </div>
                            <!-- END User Info -->
                            <!-- Sidebar Navigation -->
                            <ul class="sidebar-nav">
                                <li class="<?php echo activate_menu('dashboard'); ?>">
                                    <a href="<?php echo base_url()?>admin/dashboard" class="<?php echo activate_menu('dashboard'); ?>"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>
                                </li>
                                <?php if (isset($this->session->userdata('access')->creat_m)&&$this->session->userdata('access')->creat_m==1){?>

                                <li class="
                                           <?php 
                                            echo activate_menu('sub_admin');
                                            echo activate_menu('group');
                                            echo activate_menu('user');
                                            echo activate_menu('newspaper');
                                            echo activate_menu('news_type');
                                            echo activate_menu('categories');
                                            echo activate_menu('employee');
                                            echo activate_menu('bank');
                                            echo activate_menu('account_group');
                                            echo activate_menu('ledger');
                                            echo activate_menu('tax');
                                            echo activate_menu('discount');
                                            echo activate_menu('price');
                                            echo activate_menu('scheme');
                                            echo activate_menu('fm');
                                            echo activate_menu('magazine');
                                            echo activate_menu('premimum');
                                            echo activate_menu('heading');
                                            echo activate_menu('disp_price');
                                            echo activate_menu('package');
                                            echo activate_menu('add_on');
                                            echo activate_menu('r_rate');
                                            echo activate_menu('scheme_attach');
                                            echo activate_menu('cd_scheme_attach');
                                            echo activate_menu('hd_scheme_attach');
                                            echo activate_menu('cd_r_rate');
                                            echo activate_menu('cd_categories');
                                            echo activate_menu('cd_heading');
                                            echo activate_menu('cd_add_on');
                                            echo activate_menu('position');
                                            echo activate_menu('hd_package');
                                            echo activate_menu('hd_price');
                                            echo activate_menu('hd_r_rate');
                                            echo activate_menu('hd_add_on');
                                           ?>
                                           ">
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-indent sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Create Masters</span></a>
                                    <ul>
                                        <li class="<?php 
                                            echo activate_menu('sub_admin');
                                            echo activate_menu('group');
                                            echo activate_menu('user');
                                            echo activate_menu('newspaper');
                                            echo activate_menu('bank');
                                            echo activate_menu('account_group');
                                            echo activate_menu('ledger');
                                            echo activate_menu('tax');
                                            echo activate_menu('discount');
                                            echo activate_menu('scheme');
                                            echo activate_menu('fm');
                                            echo activate_menu('magazine');
                                            echo activate_menu('premimum');
                                            echo activate_menu('package');	
                                            echo activate_menu('import');	
                                            ?>">
                                            <a href="#" class=" sidebar-nav-submenu"><i class="fa fa-angle-left sidebar-nav-indicator"></i>Master Enteris</a>
                                            <ul>
                                                <li>
                                                    <a class="<?php echo active_link('sub_admin','index'); ?>" href="<?php echo base_url()?>admin/sub_admin">Create Users</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('bank','index'); ?>" href="<?php echo base_url()?>admin/bank">Bank Master</a>
                                                </li>
                                                <li>
                                                    <a  class="<?php echo active_link('account_group','index'); ?>" href="<?php echo base_url()?>admin/account_group/main_group">Account Groups</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('ledger','index'); ?>" href="<?php echo base_url()?>admin/ledger/all">Account Ledgers</a>
                                                </li>
                                               
                                                <li>
                                                    <a class="<?php echo active_link('user','index'); ?>" href="<?php echo base_url()?>admin/user">Client Master</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('newspaper','index'); ?>" href="<?php echo base_url()?>admin/newspaper">Newspaper Group</a>
                                                </li>	
                                               
                                                <li>
                                                    <a class="<?php echo active_link('newspaper','show'); ?>" href="<?php echo base_url()?>admin/newspaper/show">Newspaper </a>
                                                </li>

                                                <li>
                                                    <a class="<?php echo active_link('fm','index'); ?>" href="<?php echo base_url()?>admin/fm">FM Group Master</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('fm','show'); ?>" href="<?php echo base_url()?>admin/fm/show">FM Channel Master </a>
                                                </li>
                                                <li>
                                               <!--     <a class="<?php //echo active_link('magazine','index'); ?>" href="<?php //echo base_url()?>admin/magazine">Magazine Group Master</a>
                                                </li>
                                                <li>
                                                    <a class="<?php //echo active_link('magazine','show'); ?>" href="<?php //echo base_url()?>admin/magazine/show">Magazine Master </a>
                                                </li>
                                              

                                                <li> -->
                                                    <a class="<?php echo active_link('discount','index'); ?>" href="<?php echo base_url()?>admin/discount">Discount Master </a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('scheme','index'); ?>" href="<?php echo base_url()?>admin/scheme">Scheme Master </a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('premimum','index'); ?>" href="<?php echo base_url()?>admin/premimum">Premimum Master </a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('package','index'); ?>" href="<?php echo base_url()?>admin/package">Package Master </a>
                                                </li>

                                                <li>
                                                    <a class="<?php echo active_link('tax','index'); ?>" href="<?php echo base_url()?>admin/tax">Tax Master </a>
                                                </li>
                                                 <li>
                                                    <a class="<?php echo active_link('import','index'); ?>" href="<?php echo base_url()?>admin/import">Import CSV </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="<?php 
                                                        echo activate_menu('news_type');
                                                        echo activate_menu('categories');
                                                        echo activate_menu('price');
                                                        echo activate_menu('heading');
                                                        echo activate_menu('add_on');
                                                        echo activate_menu('r_rate');
                                                        echo activate_menu('scheme_attach');

                                                   ?>">
                                            <a href="#" class="sidebar-nav-submenu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="fa fa-text-width sidebar-nav-icon"></i> Classified</a>
                                            <ul>
                                                <li>
                                                    <a class="<?php echo active_link('categories','index'); ?>" href="<?php echo base_url()?>admin/categories">Heading Master</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('categories','sub_list'); ?>" href="<?php echo base_url()?>admin/categories/sub_list">Sub Heading Master</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('heading','index'); ?>" href="<?php echo base_url()?>admin/heading">Heading Attach</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('scheme_attach','index'); ?>" href="<?php echo base_url()?>admin/scheme_attach">Scheme Attach</a>
                                                </li>

                                                <li>
                                                    <a class="<?php echo active_link('price','index'); ?>" href="<?php echo base_url()?>admin/price">Rates Master</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('r_rate','index'); ?>" href="<?php echo base_url()?>admin/r_rate">Revise Rates</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('add_on','index'); ?>" href="<?php echo base_url()?>admin/add_on">Add On Master</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="<?php
                                                        echo activate_menu('disp_price');
                                                        echo activate_menu('cd_categories');
                                                        echo activate_menu('cd_heading');
                                                        echo activate_menu('cd_scheme_attach');
                                                        echo activate_menu('cd_r_rate');
                                                        echo activate_menu('cd_add_on');
                                                   ?>">
                                            <a href="#" class="sidebar-nav-submenu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="fa fa-picture-o sidebar-nav-icon"></i> Classified Display</a>
                                            <ul>
                                                <li>
                                                    <a class="<?php echo active_link('cd_categories','index'); ?>" href="<?php echo base_url()?>admin/cd_categories">Heading Master</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('cd_categories','sub_list'); ?>" href="<?php echo base_url()?>admin/cd_categories/sub_list">Sub Heading Master</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('cd_heading','index'); ?>" href="<?php echo base_url()?>admin/cd_heading">Heading Attach</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('cd_scheme_attach','index'); ?>" href="<?php echo base_url()?>admin/cd_scheme_attach">Scheme Attach</a>
                                                </li>
                                               
                                                <li>
                                                    <a class="<?php echo active_link('disp_price','index'); ?>" href="<?php echo base_url()?>admin/disp_price">Classified Display Rates </a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('cd_r_rate','index'); ?>" href="<?php echo base_url()?>admin/cd_r_rate">CD Revise Rates</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('cd_add_on','index'); ?>" href="<?php echo base_url()?>admin/cd_add_on">Classified Display Add On</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="<?php 
                                                        echo activate_menu('position');
                                                        echo activate_menu('hd_scheme_attach');
                                                        echo activate_menu('hd_package');
                                                        echo activate_menu('hd_price');
                                                        echo activate_menu('hd_r_rate');
                                                        echo activate_menu('hd_add_on');
                                                   ?>">
                                            <a href="#" class="sidebar-nav-submenu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="fa fa-camera sidebar-nav-icon"></i> Display</a>
                                            <ul>
                                                <li>
                                                    <a class="<?php echo active_link('position','index'); ?>" href="<?php echo base_url()?>admin/position/">Category Master</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('hd_scheme_attach','index'); ?>" href="<?php echo base_url()?>admin/hd_scheme_attach">Scheme Attach</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('hd_package','index'); ?>" href="<?php echo base_url()?>admin/hd_package">HD Packages</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('hd_price','index'); ?>" href="<?php echo base_url()?>admin/hd_price">HD Rates Master</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('hd_r_rate','index'); ?>" href="<?php echo base_url()?>admin/hd_r_rate">HD Revise Rates</a>
                                                </li>
                                                <li>
                                                    <a class="<?php echo active_link('hd_add_on','index'); ?>" href="<?php echo base_url()?>admin/hd_add_on">HD Display Add On</a>
                                                </li> 
                                            </ul>
                                        </li>
                                        <li>
                                            <a class="<?php echo activate_menu('employee'); ?>" href="<?php echo base_url()?>admin/employee">Employee Master</a>
                                        </li>
                                        <li>
                                            <a class="<?php echo activate_menu('emploee'); ?>" href="<?php echo base_url()?>admin/employee">LEDGER</a>
                                        </li>

                                    </ul>
                                </li>
                                <?php 
}								
                                if (isset($this->session->userdata('access')->transaction)&&$this->session->userdata('access')->transaction==1)
                                {
                                ?>
                                <li class="<?php 
                                    echo activate_menu('book_ads'); 
                                    echo activate_menu('fm_ro');
                                    echo activate_menu('client_bill');
                                    echo activate_menu('fm_bill');
                                    echo activate_menu('newspaper_bill');
                                    echo activate_menu('pending_ro');
                                    echo activate_menu('display_ro');
                                    echo activate_menu('hd_ro');
                                    echo activate_menu('booking_text_ro');
                                    echo activate_menu('booking_cd_ro');
                                    echo activate_menu('booking_hd_ro');

                                    ?>">
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-exchange sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Transaction</span></a>
                                    <ul>
                                        <li>
                                            <a class="<?php 
                                    echo activate_menu('hd_ro');
                                    echo activate_menu('display_ro');echo activate_menu('book_ads');			
                                                      ?>" href=""  data-toggle="modal" data-target="#myModal">Ro Entery</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?>admin/fm_ro">FM Ro </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?>admin/client_bill/">Client Billing</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?>admin/fm_bill/">FM Billing</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?>admin/newspaper_bill/">Publication Billing</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?>admin/pending_ro/">Pending Ro</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?>admin/vouchers/">Vouchers</a>
                                        </li>
                                         <li>
                                            <a href="<?php echo base_url()?>admin/booking_text_ro/">Text Ro Booking</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php 
                                }
                                if (isset($this->session->userdata('access')->letters)&&$this->session->userdata('access')->letters==1)
                                {
                                ?>
                                <li class="<?php 
                                    echo activate_menu('ins_letter'); 
                                    echo activate_menu('cancel_letter');
                                    echo activate_menu('postpone_letter');								

                                           ?>">
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-envelope sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Letters</span></a>
                                    <ul>
                                        <li>
                                            <a class="<?php echo active_link('ins_letter','index'); ?>" href="<?php echo base_url()?>admin/ins_letter">Insertion Letter</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?>admin/cancel_letter">Canceling Letter</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?>admin/postpone_letter">Postpone Letter</a>
                                        </li>
                                        <li>
                                            <a href="#">Complaint Letter</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php 
                                }
                                if (isset($this->session->userdata('access')->reports)&&$this->session->userdata('access')->reports==1)
                                {
                                ?>
                                <li>
                                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-list-alt sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Reports</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url()?>admin/categories">Abc</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?>admin/categories/add">xyz</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php 
                                }
                                ?>
                                <li>
                                    <a href="<?php echo base_url()?>admin/settings/pass_c"><i class="fa fa-wrench sidebar-nav-icon"></i> Change Password</a>
                                </li>


                                <!-- Sidebar Notifications -->
                                <div class="sidebar-header sidebar-nav-mini-hide">
                                    <span class="sidebar-header-options clearfix">
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Refresh"><i class="gi gi-refresh"></i></a>
                                    </span>
                                    <span class="sidebar-header-title">Activity</span>
                                </div>
                                <div class="sidebar-section sidebar-nav-mini-hide">
                                    <div class="alert alert-success alert-alt">
                                        <small>Last Login</small><br>
                                        <i class="fa fa-sign-in fa-fw"></i> <?php echo $this->session->userdata('admin')['last_login'];?>
                                    </div>

                                </div>
                                <!-- END Sidebar Notifications -->
                                </div>
                            <!-- END Sidebar Content -->
                        </div>
                        <!-- END Wrapper for scrolling functionality -->
                    </div>
                    <!-- END Main Sidebar -->
                    <!-- Main Container -->
                    <div id="main-container">
                       
                        <header class="navbar navbar-default">
                            <!-- Left Header Navigation -->
                            <ul class="nav navbar-nav-custom">
                                <!-- Main Sidebar Toggle Button -->
                                <li>
                                    <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                        <i class="fa fa-bars fa-fw"></i>
                                    </a>
                                </li>
                                <!-- END Main Sidebar Toggle Button -->

                                <!-- Template Options -->
                                <!-- Change Options functionality can be found in js/app.js - templateOptions() -->
                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="gi gi-settings"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-custom dropdown-options">
                                        <li class="dropdown-header text-center">Header Style</li>
                                        <li>
                                            <div class="btn-group btn-group-justified btn-group-sm">
                                                <a href="javascript:void(0)" class="btn btn-primary" id="options-header-default">Light</a>
                                                <a href="javascript:void(0)" class="btn btn-primary" id="options-header-inverse">Dark</a>
                                            </div>
                                        </li>
                                        <li class="dropdown-header text-center">Page Style</li>
                                        <li>
                                            <div class="btn-group btn-group-justified btn-group-sm">
                                                <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style">Default</a>
                                                <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style-alt">Alternative</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END Template Options -->
                            </ul>
                            <!-- END Left Header Navigation -->

                            <!-- Search Form -->
                            <form action="page_ready_search_results.html" method="post" class="navbar-form-custom" role="search">
                                <div class="form-group">
                                    <input type="text" id="top-search" name="top-search" class="form-control" placeholder="Search..">
                                </div>
                            </form>
                            <!-- END Search Form -->

                            <!-- Right Header Navigation -->
                            <ul class="nav navbar-nav-custom pull-right">

                                <!-- User Dropdown -->
                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo base_url().IMG; ?>placeholders/avatars/admin.png" alt="avatar"> <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                        <li class="dropdown-header text-center">Account</li>

                                        <li class="divider"></li>
                                        <li>
                                            <a href="<?php echo base_url();?>admin/settings/pass_c">
                                                <i class="fa fa-user fa-fw pull-right"></i>
                                                Change Password
                                            </a>
                                            <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                                            <a href="" data-toggle="modal">
                                                <i class="fa fa-cog fa-fw pull-right"></i>
                                                Settings
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>                                        
                                            <a href="<?php echo base_url()?>admin/dashboard/logout"><i class="fa fa-ban fa"></i> Logout</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END User Dropdown -->
                            </ul>
                            <!-- END Right Header Navigation -->
                        </header>
                        <!-- END Header -->
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">    
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">RO Selection</h4>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            <li>
                                                <a class="<?php echo active_link('book_ads','index'); ?>" href="<?php echo base_url()?>admin/book_ads">Classified Text Ro</a>
                                            </li>
                                            <li>
                                                <a class="<?php echo active_link('display_ro','index'); ?>" href="<?php echo base_url()?>admin/display_ro">Classified Display Ro</a>
                                            </li>
                                            <li>
                                                <a class="<?php echo active_link('hd_ro','index'); ?>" href="<?php echo base_url()?>admin/hd_ro">Display</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Modal End-->
                        <!--Booking Modal-->
                        <div class="modal fade" id="myModal_booking" role="dialog">
                            <div class="modal-dialog">    
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">RO Booking</h4>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            <li>
                                                <a class="<?php echo active_link('book_ads','index'); ?>" href="<?php echo base_url()?>admin/booking_text_ro/add">Classified Text Ro</a>
                                            </li>
                                            <li>
                                                <a class="<?php echo active_link('display_ro','index'); ?>" href="<?php echo base_url()?>admin/booking_cd_ro/add">Classified Display Ro</a>
                                            </li>
                                            <li>
                                                <a class="<?php echo active_link('hd_ro','index'); ?>" href="<?php echo base_url()?>admin/booking_hd_ro/add">Display</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Modal End-->
