<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $url_title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php echo $this->load->view(ADMIN_CSS_VIEW_PATH); ?>
</head>
<body class="hold-transition sidebar-mini">
    <?php echo $this->load->view(ADMIN_HEADER_PATH); ?>
    <?php echo $this->load->view(ADMIN_SIDEBAR_PATH); ?>
    <?php echo $this->load->view('admin/includes/content.php'); ?>
    <?php echo $this->load->view(ADMIN_FOOTER_PATH); ?>
    <script src="<?php echo ADMIN_JS_PATH; ?>jquery-3.3.1.min.js"></script>
    <?php echo $this->load->view(ADMIN_JS_VIEW_PATH); ?>
</body>
</html>
