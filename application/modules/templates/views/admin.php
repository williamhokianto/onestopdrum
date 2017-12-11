<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>OneStopDrum Admin Panel</title>
    <meta name="description" content="Bootstrap Metro Dashboard">
    <meta name="author" content="Dennis Ji">
    <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <!-- end: Meta -->
    
    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->
    
    <!-- start: CSS -->
    <link id="bootstrap-style" href="<?php echo base_url(); ?>assets/adminfiles/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adminfiles/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="<?php echo base_url(); ?>assets/adminfiles/css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="<?php echo base_url(); ?>assets/adminfiles/css/style-responsive.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <!-- end: CSS -->
    

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <link id="ie-style" href="<?php echo base_url(); ?>assets/adminfiles/css/ie.css" rel="stylesheet">
    <![endif]-->
    
    <!--[if IE 9]>
        <link id="ie9style" href="<?php echo base_url(); ?>assets/adminfiles/css/ie9.css" rel="stylesheet">
    <![endif]-->
        
    <!-- start: Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- end: Favicon -->
    
        
        
        
</head>

<body>

<?php
if (isset($sort_this)) {
    require_once('sort_this_code.php');
}
?>

        <!-- start: Header -->
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="index.html"><span>OneStopDrum</span></a>
                                
                <!-- start: Header Menu -->
                <div class="nav-no-collapse header-nav">
                    <ul class="nav pull-right">
                        <li class="dropdown hidden-phone">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-bell"></i>
                                <span class="badge red">
                                7 </span>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li class="dropdown-menu-title">
                                    <span>You have 11 notifications</span>
                                    <a href="#refresh"><i class="icon-repeat"></i></a>
                                </li>   
                                <li>
                                    <a href="#">
                                        <span class="icon blue"><i class="icon-user"></i></span>
                                        <span class="message">New user registration</span>
                                        <span class="time">1 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon green"><i class="icon-comment-alt"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">7 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon green"><i class="icon-comment-alt"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">8 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon green"><i class="icon-comment-alt"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">16 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon blue"><i class="icon-user"></i></span>
                                        <span class="message">New user registration</span>
                                        <span class="time">36 min</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon yellow"><i class="icon-shopping-cart"></i></span>
                                        <span class="message">2 items sold</span>
                                        <span class="time">1 hour</span> 
                                    </a>
                                </li>
                                <li class="warning">
                                    <a href="#">
                                        <span class="icon red"><i class="icon-user"></i></span>
                                        <span class="message">User deleted account</span>
                                        <span class="time">2 hour</span> 
                                    </a>
                                </li>
                                <li class="warning">
                                    <a href="#">
                                        <span class="icon red"><i class="icon-shopping-cart"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">6 hour</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon green"><i class="icon-comment-alt"></i></span>
                                        <span class="message">New comment</span>
                                        <span class="time">yesterday</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon blue"><i class="icon-user"></i></span>
                                        <span class="message">New user registration</span>
                                        <span class="time">yesterday</span> 
                                    </a>
                                </li>
                                <li class="dropdown-menu-sub-footer">
                                    <a>View all notifications</a>
                                </li>   
                            </ul>
                        </li>
                        <!-- start: Notifications Dropdown -->
                        <li class="dropdown hidden-phone">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-calendar"></i>
                                <span class="badge red">
                                5 </span>
                            </a>
                            <ul class="dropdown-menu tasks">
                                <li class="dropdown-menu-title">
                                    <span>You have 17 tasks in progress</span>
                                    <a href="#refresh"><i class="icon-repeat"></i></a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="header">
                                            <span class="title">iOS Development</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim red">80</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="header">
                                            <span class="title">Android Development</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim green">47</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="header">
                                            <span class="title">ARM Development</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim yellow">32</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="header">
                                            <span class="title">ARM Development</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim greenLight">63</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="header">
                                            <span class="title">ARM Development</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim orange">80</div> 
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-menu-sub-footer">View all tasks</a>
                                </li>   
                            </ul>
                        </li>
                        <!-- end: Notifications Dropdown -->
                        <!-- start: Message Dropdown -->
                        <li class="dropdown hidden-phone">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-envelope"></i>
                                <span class="badge red">
                                4 </span>
                            </a>
                            <ul class="dropdown-menu messages">
                                <li class="dropdown-menu-title">
                                    <span>You have 9 messages</span>
                                    <a href="#refresh"><i class="icon-repeat"></i></a>
                                </li>   
                                <li>
                                    <a href="#">
                                        <span class="avatar"><img src="<?php echo base_url(); ?>img/avatar.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Admin
                                             </span>
                                            <span class="time">
                                                6 min
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="avatar"><img src="<?php echo base_url(); ?>img/avatar.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Admin
                                             </span>
                                            <span class="time">
                                                56 min
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="avatar"><img src="<?php echo base_url(); ?>img/avatar.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Admin
                                             </span>
                                            <span class="time">
                                                3 hours
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="avatar"><img src="<?php echo base_url(); ?>img/avatar.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Admin
                                             </span>
                                            <span class="time">
                                                yesterday
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="avatar"><img src="<?php echo base_url(); ?>img/avatar.jpg" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Admin
                                             </span>
                                            <span class="time">
                                                Jul 25, 2012
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-menu-sub-footer">View all messages</a>
                                </li>   
                            </ul>
                        </li>
                        
                        <!-- start: User Dropdown -->
                        <li class="dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="halflings-icon white user"></i> Admin
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-menu-title">
                                    <span>Account Settings</span>
                                </li>
                                <li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
                                <li><a href="login.html"><i class="halflings-icon off"></i> Logout</a></li>
                            </ul>
                        </li>
                        <!-- end: User Dropdown -->
                    </ul>
                </div>
                <!-- end: Header Menu -->
                
            </div>
        </div>
    </div>
    <!-- start: Header -->
    
        <div class="container-fluid-full">
        <div class="row-fluid">
                
            <!-- start: Main Menu -->
            <div id="sidebar-left" class="span2">
                <div class="nav-collapse sidebar-nav">
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li><a href="<?= base_url() ?>dashboard/home"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                        <?php
                        echo Modules::run('store_order_status/_draw_left_nav_links');
                        ?> 
                        <li><a href="<?= base_url() ?>sliders/manage"><i class="icon-picture"></i><span class="hidden-tablet"> Manage Sliders</span></a></li> 
                        <li><a href="<?= base_url() ?>store_order_status/manage"><i class="icon-file-alt"></i><span class="hidden-tablet"> Order Status Options</span></a></li> 
                        <li><a href="<?= base_url() ?>enquiries/inbox"><i class="icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>  
                        <li><a href="<?= base_url() ?>store_items/manage"><i class="icon-tag"></i><span class="hidden-tablet"> Manage Items</span></a></li>
                        <li><a href="<?= base_url() ?>store_categories/manage"><i class="icon-align-justify"></i><span class="hidden-tablet"> Manage Categories</span></a></li>
                        <li><a href="<?= base_url() ?>homepage_blocks/manage"><i class="icon-star"></i><span class="hidden-tablet"> Homepage Offers</span></a></li>
                        <li><a href="<?= base_url() ?>webpages/manage"><i class="icon-file"></i><span class="hidden-tablet"> CMS</span></a></li>
                        <li><a href="<?= base_url() ?>blog/manage"><i class="icon-file-alt"></i><span class="hidden-tablet"> Manage Blog</span></a></li>
                        <li><a href="<?= base_url() ?>store_accounts/manage"><i class="icon-briefcase"></i><span class="hidden-tablet"> Accounts</span></a></li>
                        <li><a href="<?= base_url() ?>btm_nav/manage"><i class="icon-th-list"></i><span class="hidden-tablet"> Footer Links</span></a></li>
                    </ul>
                </div>
            </div>
            <!-- end: Main Menu -->
            
            <noscript>
                <div class="alert alert-block span10">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
            </noscript>
            
            <!-- start: Content -->
            <div id="content" class="span10">
            
<?php
if (isset($view_file)) {
    $this->load->view($view_module.'/'.$view_file);
}
?>
            
       

    </div><!--/.fluid-container-->
    
            <!-- end: Content -->
        </div><!--/#content.span10-->
        </div><!--/fluid-row-->
        

    
    <div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <ul class="list-inline item-details">
                <li><a href="http://themifycloud.com">Admin templates</a></li>
                <li><a href="http://themescloud.org">Bootstrap themes</a></li>
            </ul>
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <footer>

        <p>
            <span style="text-align:left;float:left">&copy; 2013 <a href="http://themifycloud.com/downloads/janux-free-responsive-admin-dashboard-template/" alt="Bootstrap_Metro_Dashboard">JANUX Responsive Dashboard</a></span>
            
        </p>

    </footer>
    
    <!-- start: JavaScript-->

        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery-migrate-1.0.0.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery-ui-1.10.0.custom.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.ui.touch-punch.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/modernizr.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/bootstrap.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.cookie.js"></script>
    
        <script src='<?php echo base_url(); ?>assets/adminfiles/js/fullcalendar.min.js'></script>
    
        <script src='<?php echo base_url(); ?>assets/adminfiles/js/jquery.dataTables.min.js'></script>

        <script src="<?php echo base_url(); ?>assets/adminfiles/js/excanvas.js"></script>
    <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.flot.resize.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.chosen.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.uniform.min.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.cleditor.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.noty.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.elfinder.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.raty.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.iphone.toggle.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.uploadify-3.1.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.gritter.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.imagesloaded.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.masonry.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.knob.modified.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/jquery.sparkline.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/counter.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/adminfiles/js/retina.js"></script>

        <script src="<?php echo base_url(); ?>assets/adminfiles/js/custom.js"></script>
    <!-- end: JavaScript-->
    
</body>
</html>
