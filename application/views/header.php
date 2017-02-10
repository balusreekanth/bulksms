<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--<link rel="shortcut icon" href="../images/favicon.png" type="image/png">-->
<!-- <link rel="shortcut icon"  href="<?php //echo base_url();?>images/favicon.ico.png"/> -->
  <title>SipCo  Bulk SMS</title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>lib/fontawesome/css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>lib/weather-icons/css/weather-icons.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>lib/jquery-toggles/toggles-full.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>lib/select2/select2.css">
<!--<link rel="stylesheet" href="<?php //echo base_url(); ?>/css/jquery.datetimepicker.css">-->
  
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/quirk.css">
  <link href="<?php echo base_url(); ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>css/bootstrap-datetimepicker.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>lib/modernizr/modernizr.js"></script>
 
</head>

<body>

  <header>
    <div class="headerpanel">

      <div class="logopanel">
        <!-- <h2><a href="#">SipCo Bulk SMS</a></h2> -->
        <img class="img-responsive" height="46px" width="111px" src="<?php echo base_url(); ?>/images/logo.png">
      </div><!-- logopanel -->

      <div class="headerbar">

        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

      

        <div class="header-right">
          <ul class="headermenu">
            <li>
              <div class="btn-group">
                <button type="button" class="btn btn-logged" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>images/photos/loggeduser.png" alt="" />
                  Admin
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right">
                  <!-- <li><a href="#"><i class="glyphicon glyphicon-user"></i> My Profile</a></li> -->

                  <li><a  href="<?php echo site_url(); ?>/smsportal/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div><!-- header-right -->
      </div><!-- headerbar -->
    </div><!-- header-->
  </header>
  <section>
    <div class="leftpanel">
      <div class="leftpanelinner">
        <!-- ################## LEFT PANEL PROFILE ################## -->
        <div class="media leftpanel-profile">
          <div class="media-left">
            <a href="#">
              <!-- <img src="../images/photos/loggeduser.png" alt="" class="media-object img-circle"> -->
              <span class="media-object img-circle" style="text-align:center;"><i class="fa fa-user fa-3x" aria-hidden="true"></i></span>
            </a>
          </div>
          <div class="media-body">
            <h4 class="media-heading">Admin <a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><!-- <i class="fa fa-angle-down"></i> --></a></h4>
           <!--  <span>Software Engineer</span> -->
          </div>
        </div><!-- leftpanel-profile -->      
        <div class="tab-content">
          <!-- ################# MAIN MENU ################### -->
          <div class="tab-pane active" id="mainmenu">
            <ul class="nav nav-pills nav-stacked nav-quirk">
              <li><a href="<?php echo site_url('smsportal/sendsms'); ?>"><i class="fa fa-comment" aria-hidden="true"></i><span>Send SMS</span></a></li>
              <li><a href="<?php echo site_url('smsportal/scheduledsms'); ?>"><i class="fa fa-fax" aria-hidden="true"></i><span>Scheduled SMS</span></a></li>
              <li><a href="<?php echo site_url('smsportal');?>"><i class="fa fa-list" aria-hidden="true"></i><span>Contacts</span></a></li>
              <li><a href="<?php echo site_url('smsportal/inbox');?>"><i class="fa fa-inbox" aria-hidden="true"></i><span>Inbox</span></a></li>              
              <li><a href="<?php echo site_url('smsportal/outbox');?>"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Outbox</span></a></li>
              <li><a href="<?php echo site_url('smsportal/sentitems');?>"><i class="fa fa-tasks" aria-hidden="true"></i><span>Sent Items</span></a></li>
              <li><a href="<?php echo site_url('smsportal/groups');?>"><i class="fa fa-group" aria-hidden="true"></i><span>Groups</span></a></li>
              <li><a href="<?php echo site_url('smsportal/info');?>"><i class="fa fa-info" aria-hidden="true"></i><span>Info</span></a></li>
              <li><a href="<?php echo site_url('smsportal/checkbalance');?>"><i class="fa fa-money" aria-hidden="true"></i><span>Balance</span></a></li>
              <li><a href="<?php echo site_url('smsportal/settings');?>"><i class="fa fa-cog" aria-hidden="true"></i><span>Settings</span></a></li>
            </ul>
          </div>
          <!-- tab-pane -->
        </div><!-- tab-content -->
      </div><!-- leftpanelinner -->
    </div><!-- leftpanel -->