<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--<link rel="shortcut icon" href="../images/favicon.png" type="image/png">-->
<link rel="shortcut icon"  href="#"/>
  <title>SMS Portal</title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>lib/fontawesome/css/font-awesome.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>css/quirk.css">
  <style>
  .error {
 color: #2780e3;

}
  </style>

  <script src="<?php echo base_url(); ?>lib/modernizr/modernizr.js"></script>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../lib/html5shiv/html5shiv.js"></script>
  <script src="../lib/respond/respond.src.js"></script>
  <![endif]-->
</head>

<body class="signwrapper">

  <div class="sign-overlay"></div>
  <div class="signpanel"></div>

  <div class="panel signin">
    <div class="panel-heading">
      
      <h4 class="panel-title" style="margin-top:0px;">Welcome! Please signin.</h4>
    </div>
    <div class="panel-body">
     <!--  <button class="btn btn-primary btn-quirk btn-fb btn-block">Connect with Facebook</button>
      <div class="or">or</div> -->
      <div class="error"><?php echo validation_errors(); ?></div>
   <?php echo form_open('verifylogin'); ?>
     <!--  <form action="index.html"> -->
        <div class="form-group mb10">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" placeholder="Enter Username"  id="username" name="username">
          </div>
        </div>
        <div class="form-group nomargin">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" placeholder="Enter Password" id="passowrd" name="password">
          </div>
        </div>
     <div><a href="" class="forgot"> </a></div> 
        <div class="form-group">
          <button class="btn btn-success btn-quirk btn-block"  type="submit" value="Login">Sign In</button>
        </div>
      </form>
      <hr class="invisible">
     <!--  <div class="form-group">
        <a href="signup.html" class="btn btn-default btn-quirk btn-stroke btn-stroke-thin btn-block btn-sign">Not a member? Sign up now!</a>
      </div> -->
    </div>
  </div><!--panel -->

</body>
</html>
