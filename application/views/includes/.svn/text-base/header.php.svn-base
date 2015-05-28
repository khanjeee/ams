 <?php
            $sSiteTitle     =   SITE_TITLE;
            $BaseUrl        =   site_url();
            $sMessage       =   '';
            $style          =   '';

            if ($this->session->flashdata('flash_message')) {
                $sMessage =  '<div class="text-success">'.$this->session->flashdata('flash_message').'</div>';
            }
            if ($this->session->flashdata('flash_error')) {
                $sMessage =  '<div class="text-error">'.$this->session->flashdata('flash_error').'</div>';
            }
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="apple-touch-icon" href="<?php echo getAssetsPath(); ?>ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo getAssetsPath(); ?>ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo getAssetsPath(); ?>ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo getAssetsPath(); ?>ico/152.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description">
    <meta content="" name="author">

    <!-- BEGIN Vendor CSS-->
    <link href="<?php echo getAssetsPath(); ?>plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css">
    <link href="<?php echo getAssetsPath(); ?>plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo getAssetsPath(); ?>plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="<?php echo getAssetsPath(); ?>plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo getAssetsPath(); ?>plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo getAssetsPath(); ?>plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo getAssetsPath(); ?>plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo getAssetsPath(); ?>plugins/bootstrap-datepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo getAssetsPath(); ?>plugins/magnific-popup-master/css/magnific-popup.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo getAssetsPath(); ?>plugins/owl-carousel/assets/owl.carousel.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo getAssetsPath(); ?>plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen">

    <!-- Data Tables -->
    <link href="<?php echo getAssetsPath(); ?>/plugins/jquery-datatable/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo getAssetsPath(); ?>/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo getAssetsPath(); ?>/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />

    <!-- BEGIN Pages CSS-->
    <link href="<?php echo getAssetsPath(); ?>pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="<?php echo getAssetsPath(); ?>pages/css/pages.css" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="<?php echo getAssetsPath(); ?>css/style.min.css" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="<?php echo getAssetsPath(); ?>css/bootstrap.min.css">-->

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo getAssetsPath(); ?>img/favicon.ico">
    

    <!--[if lte IE 9]>
        <link href="<?php echo getAssetsPath(); ?>css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->

    <script type="text/javascript">
        
            // Global JS Variable for get Assets Path
            getAssetsPath = '<?php echo getAssetsPath(); ?>';
        
    </script>
    
    <script src="<?php echo getAssetsPath(); ?>plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="<?php echo getAssetsPath(); ?>plugins/jquery-migrate/jquery-migrate-1.2.1.js" type="text/javascript"></script>
    <script type="text/javascript">
        window.onload = function() {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="<?php echo getAssetsPath(); ?>css/windows.chrome.fix.css" />'
        }
    </script>


    <!-- ============================ -->
    <!-- Styles for WhiteLabel -->
    <!-- ============================ -->
     <?php
            if(isUserLoggedIn())
                { 
                    $aUser  = getLoggedInUserData(); 
                    $sProfileImage = (empty($aUser['image'])) ? getAssetsPath().'img/profiles/avatar.jpg' : site_url('media/register/user_image/'.$aUser['image'])  ;

                    if(!empty($aUser['selected_theme']))
                        {
                            $aColors = json_decode($aUser['selected_theme']);
                            $logoBg         = $aColors->logo_background;  
                            $menuBg         = $aColors->menu_color;
                            $primaryColor   = $aColors->theme_primary_color;
                            $secondaryColor = $aColors->theme_secondary_color;
    ?>
                            <style type="text/css">
                                body:not(.sidebar-visible) .sidebar-header .logo img{
                                    float: right;
                                    margin: 0;
                                    width: 50px;
                                }
                                body:not(.sidebar-visible) .page-sidebar .sidebar-header{
                                    padding-right: 10px;
                                }

                                 .page-sidebar .sidebar-header{
                                    background-color: <?php echo $logoBg; ?>;
                                    border: none;
                                }
                                .page-sidebar{
                                    background-color: <?php echo $menuBg; ?>;
                                }
                                .sidebar-menu .menu-items li.current .c-icon, .sidebar-menu .menu-items li:hover .c-icon,
                                .nav-tabs-simple>li:after,
                                .c-box__head .count{
                                    background-color: <?php echo $secondaryColor; ?>;
                                }
                                .heading-sty-3{
                                    color: <?php echo $secondaryColor; ?>;
                                }
                                .c-box__head .heading{
                                    color: <?php echo $primaryColor; ?>;
                                }
                                .dashboard-title strong,
                                .heading-sty-1{
                                    color: <?php echo $primaryColor; ?>;
                                }
                                .page-sidebar .sidebar-menu .menu-items > li ul.sub-menu,
                                .page-sidebar .sidebar-menu .menu-items > li ul.sub-menu > li .icon-thumbnail{
                                    background: rgba(0,0,0,0.2);
                                }
                                .btn-complete, .btn-complete:focus, .btn-complete:hover, .btn-complete:active, .btn-complete:active:focus,
                                .btn-primary, .btn-primary:focus, .btn-primary:hover, .btn-primary:active, .btn-primary:active:focus,
                                form.JSUploadForm .JSFileChoos, form.JSUploadForm .JSFileChoos:focus, form.JSUploadForm .JSFileChoos:hover, form.JSUploadForm .JSFileChoos:active, form.JSUploadForm .JSFileChoos:active:focus,
                                form.JSUploadForm .startJSuploadButton, form.JSUploadForm .startJSuploadButton:focus, form.JSUploadForm .startJSuploadButton:hover, form.JSUploadForm .startJSuploadButton:active, form.JSUploadForm .startJSuploadButton:active:focus{
                                    background-color: <?php echo $secondaryColor; ?>;
                                    border-color: <?php echo $secondaryColor; ?>;
                                }        
                                .btn-success,  .btn-success:focus,  .btn-success:hover,  .btn-success:active,  .btn-success:active:focus{
                                    background: <?php echo $primaryColor; ?>;
                                    border-color: <?php echo $primaryColor; ?>;
                                }
                                .btn-success:hover,
                                .btn-complete:hover,
                                .btn-primary:hover,
                                form.JSUploadForm .JSFileChoos:hover,
                                form.JSUploadForm .startJSuploadButton:hover{
                                    opacity: 0.8;
                                }
                                .btn-complete:active,
                                .btn-success:active,
                                .btn-primary:active,
                                form.JSUploadForm .JSFileChoos:active,
                                form.JSUploadForm .startJSuploadButton:active{
                                    opacity: 1;
                                }                                
                            </style>
    
                <?php } //end if logged in  
                 
                
                } //end if theme ?>      
                    
                    
                    
            
    <!-- ============================ -->
    <!-- END - Styles for WhiteLabel -->
    <!-- ============================ -->

</head>

<body class="fixed-header ">
    <span class="site_url" style="display:none;"><?php echo site_url(); ?></span>
    <?php if(isUserLoggedIn())
        { 
        //$aUser  = getLoggedInUserData(); //d($aUser);
        $logo   = (!empty($aUser['logo'])) ? site_url('media/whitelabel/logo/'.$aUser['logo']) : getAssetsPath().'img/logo-horizontal-white.svg';
    ?>
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar" data-pages="sidebar">
      <div id="appMenu" class="sidebar-overlay-slide from-top">
      </div>
       
        <!-- BEGIN SIDEBAR HEADER -->
        <div class="sidebar-header">
           <a href="<?php echo site_url(); ?>" class="logo"><img src="<?php echo $logo; ?>" alt="Automation Mailing System" class="brand"></a>
           <div class="sidebar-header-controls hide">
            <button data-pages-toggle="#appMenu" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" type="button"><i class="fa fa-angle-down fs-16"></i></button>
            <button data-toggle-pin="sidebar" class="btn btn-link visible-lg-inline" type="button"><i class="fa fs-12"></i></button>
          </div>
        </div>
        <!-- END SIDEBAR HEADER -->
        <!-- BEGIN SIDEBAR MENU -->
        <div class="sidebar-menu">
            <ul class="menu-items">
                <?php

                if(!isSuperAdmin())
                {

                ?>

                <li class="m-t-30 current has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">Campaigns</span>
                        <i class="c-icon icon-create-package c-icon--email"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('campaigns/create'); ?>">Create<span class="icon-thumbnail"></span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('campaigns/view'); ?>">View<span class="icon-thumbnail"></span></a>
                        </li>
                    </ul>
                </li>


                    <?php

                    if(hasPreDefinedCampaigns())
                    {
                        ?>
                            <li class="m-t-30">
                                <a href="#" class="detailed">
                                    <span class="title">Templates</span>
                                    <i class="c-icon icon-create-package c-icon--order-management"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo site_url('predefined_campaigns/display'); ?>">View<span class="icon-thumbnail"></span></a>
                                        <a href="<?php echo site_url('predefined_campaigns/in_use'); ?>">In-Use<span class="icon-thumbnail"></span></a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                    }
                    ?>


                    <li class="m-t-30 has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">Contacts</span>
                        <i class="c-icon icon-create-package c-icon--contact"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('contacts/import'); ?>">Import<span class="icon-thumbnail"></span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('contacts/create'); ?>">Create<span class="icon-thumbnail"></span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('contacts/view'); ?>">View<span class="icon-thumbnail"></span></a>
                        </li>
                    </ul>
                 </li>
                <li class="m-t-30 has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">Lists</span>
                        <i class="c-icon icon-create-package c-icon--list"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('lists/create'); ?>">Create<span class="icon-thumbnail"></span></a>						 </li>
                       
					   <li>
                            <a href="<?php echo site_url('lists/view'); ?>">View<span class="icon-thumbnail"></span></a>						</li>
					 
					   
                    </ul>
                </li>    
                <li class="m-t-30 has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">Flags</span>
                        <i class="c-icon icon-create-package c-icon--list"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('flags/create'); ?>">Create<span class="icon-thumbnail"></span></a>						 </li>
                       
					   <li>
                            <a href="<?php echo site_url('flags/view'); ?>">View<span class="icon-thumbnail"></span></a>						</li>
					 
					   
                    </ul>
                </li>    
                     
                <?php }
                
                
                
				
                
                if(isSuperAdmin())
                { ?>
				
				
				
				
				
				
                <!--ONLY FOR SUPER ADMIN START-->
        
                <li class="m-t-30 current">
                    <a href="<?php echo site_url('orders/view'); ?>" class="detailed">
                        <span class="title">Orders</span>
                        <i class="c-icon icon-create-package c-icon--email"></i>
                    </a>
                </li>
                <li class="m-t-30 current has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">Predefined Campaigns</span>
                        <i class="c-icon icon-create-package c-icon--email"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('predefined_campaigns/create'); ?>">Create<span class="icon-thumbnail"></span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('predefined_campaigns/view'); ?>">View<span class="icon-thumbnail"></span></a>
                        </li>
                    </ul>
                </li>
                <li class="m-t-30  has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">Packages</span>
                        <i class="c-icon icon-create-package"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('packages/create'); ?>">Create<span class="icon-thumbnail"></span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('packages/view'); ?>">View<span class="icon-thumbnail"></span></a>                                
                        </li>
                    </ul>
                </li>
                <li class="m-t-30 has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">White Label</span>
                        <i class="c-icon icon-create-package c-icon--list"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('whitelabel/create'); ?>">Create<span class="icon-thumbnail"></span></a>                                
                        </li>
                        <li>
                            <a href="<?php echo site_url('whitelabel/view'); ?>">View<span class="icon-thumbnail"></span></a>                                
                        </li>
                    </ul>
                </li>

                <li class="m-t-30 has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">Users</span>
                        <i class="c-icon icon-create-package c-icon--contact"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('users/create'); ?>">Create<span class="icon-thumbnail"></span></a>                                
                        </li>
                        <li>
                            <a href="<?php echo site_url('users/view'); ?>">View<span class="icon-thumbnail"></span></a>                                
                        </li>
                    </ul>
                </li>
                <li class="m-t-30 has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">Roles</span>
                        <i class="c-icon icon-create-package c-icon--white-label"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('roles/create'); ?>">Create<span class="icon-thumbnail"></span></a>                                
                        </li>
                        <li>
                            <a href="<?php echo site_url('roles/view'); ?>">View<span class="icon-thumbnail"></span></a>                                
                        </li>                            
                    </ul>
                </li>
                <li class="m-t-30 has-submenu">
                <a href="#" class="detailed">
                    <span class="title">Jobs</span>
                    <i class="c-icon icon-create-package c-icon--white-label"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo site_url('crons/manage_cutoff'); ?>">Update orders<span class="icon-thumbnail"></span></a>
                    </li>
                </ul>
            </li>
           

			
				
				
				
				
				
        <!--ONLY FOR SUPER ADMIN END-->
                <?php } ?>
		 <li class="m-t-30 has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">Milestones</span>
                        <i class="c-icon icon-create-package c-icon--white-label"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('milestones/create'); ?>">Create<span class="icon-thumbnail"></span></a>                                
                        </li>
                        <li>
                            <a href="<?php echo site_url('milestones/view'); ?>">View<span class="icon-thumbnail"></span></a>                                
                        </li>                            
                    </ul>
                </li>
		
			 <li class="m-t-30 has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">Tasks</span>
                        <i class="c-icon icon-create-package c-icon--white-label"></i>
                    </a>
                    <ul class="sub-menu">
<!--                        <li>
                            <a href="<?php echo site_url('tasks/create'); ?>">Create<span class="icon-thumbnail"></span></a>                                
                        </li>-->
                        <li>
                            <a href="<?php echo site_url('tasks/view'); ?>">View<span class="icon-thumbnail"></span></a>                                
                        </li>                            
                    </ul>
                </li>
		
		
		
		
		<?php 
		$aUserData   = (object)getLoggedInUserData();
		
		if(isset($aUserData->PackageModule) && !empty($aUserData->PackageModule)){?>
               <li class="m-t-30 has-submenu">
                    <a href="#" class="detailed">
                        <span class="title">CRM</span>
                        <i class="c-icon icon-create-package c-icon--list"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo site_url('crm/create'); ?>">Create<span class="icon-thumbnail"></span></a>						 </li>
					   <li>
                            <a href="<?php echo site_url('crm/view'); ?>">View<span class="icon-thumbnail"></span></a>						</li>
                    </ul>
                </li>
		<?php } ?>
        
       
	
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- END SIDEBAR MENU -->
         
    </div>
    <!-- END SIDEBAR -->
    
    <!-- START PAGE-CONTAINER -->
    <div class="page-container">
        <!-- START PAGE HEADER WRAPPER -->
        <!-- START HEADER -->
        <div class="header ">
            <!-- START MOBILE CONTROLS -->
            <!-- LEFT SIDE -->
            <div class="pull-left full-height visible-sm visible-xs">
                <!-- START ACTION BAR -->
                <div class="sm-action-bar">
                    <a href="#" class="btn-link toggle-sidebar" data-toggle="sidebar">
                        <span class="icon-set menu-hambuger"></span>
                    </a>
                </div>
                <!-- END ACTION BAR -->
            </div>
            <!-- RIGHT SIDE -->
            <div class="pull-right full-height visible-sm visible-xs">
                <!-- START ACTION BAR -->
                <div class="sm-action-bar">
                    <!-- <a href="#" class="btn-link" data-toggle="quickview" data-toggle-element="#quickview">
                        <span class="header-setting-icon fa"></a>
                    </a> -->

                    <a href="<?php echo site_url('home/logout'); ?>" class="fa m-l-20 m-t-5 sm-no-margin header-logout-icon"></a>
                </div>
                <!-- END ACTION BAR -->
            </div>
            <!-- END MOBILE CONTROLS -->
            <div class="pull-left sm-table">
                <div class="header-inner">

                    <div class="brand inline">
                        <a href="<?php echo site_url(); ?>">
                            <?php
                            if(!empty($aUser['selected_theme']))
                            {
                            ?>                            
                            <img src="<?php echo $logo; ?>" alt="Automation Mailing System" class="mobile-header-logo">
                            <?php 
                            }
                            else
                            {
                            ?>
                            <img src="<?php echo getAssetsPath(); ?>img/logo-horizontal-black.svg" alt="logo" width="140">
                            <?php 
                            }
                            ?>
                        </a>
                    </div>

                    <?php 
                        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        if($actual_link != site_url().'home/dashboard'){
                    ?>
                    <a class="btn-back m-l-20 tablet-hide" href="javascript:window.history.back()"><i class="fa m-r-5"></i> Back</a>
                    <?php 
                        }
                    ?>

                    <a href="#" class="search-link" data-toggle="search"><i class="pg-search"></i><span class="bold"></span>search</a>

                    <!-- 
                    START NOTIFICATION LIST
                    <ul class="notification-list no-margin b-grey b-l b-r no-style p-l-30 p-r-20">
                      <li class="p-r-15 inline">
                        <div class="dropdown">
                          <a href="javascript:;" id="notification-center" class="icon-set globe-fill" data-toggle="dropdown">
                            <span class="bubble">2</span>
                          </a>
                          START Notification Dropdown
                          <div class="dropdown-menu notification-toggle" role="menu" aria-labelledby="notification-center">
                            START Notification
                            <div class="notification-panel">
                              START Notification Body
                              <div class="notification-body scrollable">
                                START Notification Item
                                <div class="notification-item unread clearfix notification-item--new">
                                  START Notification Item
                                  <div class="heading open">
                                    <a href="#" class="text-complete">
                                      <i class="fa-print fa fs-16 m-r-10"></i>
                                      <span class="bold">XYZ Mail</span>
                                      <span class="fs-12 m-l-10">has gone under cutoff period.</span>
                                    </a>
                                    <div class="pull-right">
                                      <span class="time hidden-xs">few sec ago</span>
                                    </div>
                                  </div>
                                  END Notification Item                                  
                                </div>
                                START Notification Body
                                START Notification Item
                                <div class="notification-item unread clearfix notification-item--new">
                                  START Notification Item
                                  <div class="heading open">
                                    <a href="#" class="text-complete">
                                      <i class="fa-user fa fs-16 m-r-10"></i>
                                      <span class="bold">Jhon Doe</span>
                                      <span class="fs-12 m-l-10">registered.</span>
                                    </a>
                                    <div class="pull-right">
                                      <span class="time hidden-xs">few sec ago</span>
                                    </div>
                                    <h6 class="semi-bold m-t-5 ">
                                        Package used: <a href="#">Xyz Package</a><br>
                                    </h6>
                                  </div>
                                  END Notification Item
                                </div>
                                START Notification Body
                                START Notification Item
                                <div class="notification-item  clearfix">
                                  <div class="heading">
                                    <a href="#" class="text-danger">
                                      <i class="fa fa-exclamation-triangle m-r-10"></i>
                                      <span class="bold">Xyz Mail</span>
                                      <span class="fs-12 m-l-10">was canceld by Admin.</span>
                                    </a>
                                    <span class="pull-right time hidden-xs">2 days</span>
                                  </div>
                                </div>
                                END Notification Item
                                START Notification Item
                                <div class="notification-item  clearfix">
                                  <div class="heading">
                                    <a href="#" class="text-warning-dark">
                                      <i class="fa fa-exclamation-triangle m-r-10"></i>
                                      <span class="bold">Warning Notification</span>
                                      <span class="fs-12 m-l-10">Some text</span>
                                    </a>
                                    <span class="pull-right time hidden-xs">yesterday</span>
                                  </div>
                                </div>
                                END Notification Item
                              </div>
                              END Notification Body
                            </div>
                            END Notification
                          </div>
                          END Notification Dropdown
                        </div>
                      </li>
                    </ul>
                    END NOTIFICATIONS LIST -->


                </div>
            </div>
            <div class=" pull-right">
                <div class="header-inner">
                    <!-- <a href="#" class="fa m-l-20 sm-no-margin hidden-sm hidden-xs header-setting-icon" data-toggle="quickview" data-toggle-element="#quickview"></a> -->
                    <a href="<?php echo site_url('home/logout'); ?>" class="fa m-l-20 m-t-5 sm-no-margin hidden-sm hidden-xs header-logout-icon"></a>
                </div>
            </div>
            <div class=" pull-right">
                <!-- START User Info-->
                <div class="visible-lg visible-md m-t-10">
                    <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
                       <a href="<?php echo site_url('register/profile'); ?>">
						   <span class="semi-bold"><?php echo $aUser['first_name']; ?></span>
						   <span class="semi-bold"><?php echo $aUser['last_name']; ?></span>
					   </a>
						<!--<span class="text-master"><?php #echo $aUser['last_name']; ?></span>-->
                    </div>
                    <div class="thumbnail-wrapper d32 circular inline m-t-5">
                        <img src="<?php echo $sProfileImage; ?>" alt="" data-src="<?php echo $sProfileImage; ?>" data-src-retina="<?php echo $sProfileImage; ?>" width="32" height="32">
                    </div>
                </div>
                <!-- END User Info-->
            </div>
        </div>
        <!-- END HEADER -->
        <!-- END PAGE HEADER WRAPPER -->
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper">
            <!-- START PAGE CONTENT -->
            <div class="content">
                
                <!-- START CONTAINER FLUID -->
                <div class="p-r-20 p-l-20">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->


        <?php } ?>
        
        <?php echo $sMessage; ?>        
            

