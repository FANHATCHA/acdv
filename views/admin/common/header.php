<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $page_title;?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link rel="icon" type="image/png" href="<?php echo $this->config->base_url();?>assets/front/images/favicon.ico"> 
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->base_url();?>assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url();?>assets/plugins/jstree/dist/themes/default/style.min.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo $this->config->base_url();?>assets/css/tasks.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo $this->config->base_url();?>assets/css/components.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->base_url();?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->base_url();?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->base_url();?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo $this->config->base_url();?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url();?>assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url();?>assets/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" href="<?php echo $this->config->base_url();?>assets/plugins/data-tables/DT_bootstrap.css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo $this->config->base_url();?>favicon.ico"/>
<link href="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->base_url();?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->base_url();?>assets/plugins/jquery-nestable/jquery.nestable.css" type="text/css" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url();?>assets/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>


<script src="<?php echo $this->config->base_url();?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/ajaxupload.3.5.js"></script>

<script>
$(document).ready(function(){
   $(".group2").colorbox({rel:'group2', transition:"fade"});
});
</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<a class="navbar-brand" href="<?php echo $this->config->base_url();?>admin/dashboard">
			<img style="margin-top: -30px;" src="<?php echo $this->config->base_url();?>assets/img/logo-big.png" alt="logo" class="img-responsive" width="107px"/>
		</a>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<img src="<?php echo $this->config->base_url();?>assets/img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="<?php echo $this->config->site_url();?>myprofile" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" src="<?php echo $this->config->base_url();?>assets/img/no_user_photo-v1.gif" height="29px" width="29px"/>
					<span class="username">
						 <?php echo $this->session->userdata('admin_username'); ?>
					</span>
					<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo $this->config->site_url();?>admin/myprofile">
							<i class="fa fa-user"></i> <?php echo $this->lang->line('MYPROFILE');?>
						</a>
					</li>
					<li class="chcki">
						<a href="<?php echo $this->config->site_url();?>admin/login/logout">
							<i class="fa fa-key"></i> <?php echo $this->lang->line('LOGOUT');?>
						</a>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>

