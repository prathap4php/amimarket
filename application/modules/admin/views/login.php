<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $url_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo ADMIN_CSS_PATH; ?>bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo ADMIN_CSS_PATH; ?>jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="<?php echo ADMIN_CSS_PATH; ?>style.css"/>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo ADMIN_CSS_PATH; ?>admin1.css">
  <link rel="stylesheet" href="<?php echo ADMIN_CSS_PATH; ?>_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo ADMIN_CSS_PATH; ?>login.css">
  <style>
    sup{color:red;}
    textarea{resize:none;}
    .error_label{color:red;}
  </style>
</head>
<body>
  <div class="container">
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <section class="login-form">
        <form method="post" action="#" role="login" id="<?php echo $form_setup['form_id']; ?>">
          <!--  <img src="" class="img-responsive" alt="Logo" /> -->
          <h1 class="text-center"><?php echo $main_title; ?></h1 >
          <input type="text" name="email" id="email" placeholder="Email" required class="form-control input-lg" /><span class="error_label" id="email_error"></span>
          <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password" /><span class="error_label" id="password_error"></span>
          <div class="pwstrength_viewport_progress"></div>
          <!-- <a href="<?php echo base_url().'login/Login/dashboard'; ?>" class="btn btn-md btn-primary btn-block">Login </a> -->
          <button type="submit" class="btn btn-md btn-primary btn-block" name="form-submit" id="form-submit">Submit</button>
          <div class="form-group col-lg-12 submissionMessage"></div>
        </form>
      </section>  
      </div>
      <div class="col-md-4"></div>
  </div>
</div>
<script src="<?php echo ADMIN_JS_PATH.'jquery-3.3.1.min.js'; ?>" type="text/javascript" ></script>
<script src="<?php echo ADMIN_JS_PATH.'project.js'; ?>" type="text/javascript" ></script>
<script src="<?php echo $form_setup['form_jspath']; ?>" type="text/javascript"></script>
<script type="text/javascript">
  var redirectionURL = "<?php echo base_url().'admin/dashboard' ?>"
  var actionLink="<?php echo $form_setup['action_link']; ?>";      
</script>
</body>
</html>