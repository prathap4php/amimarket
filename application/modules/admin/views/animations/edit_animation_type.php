<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title> <?php echo $url_title; ?></title>
  	<?php $this->load->view(ADMIN_CSS_VIEW_PATH); ?>
		<script src="<?php echo ADMIN_ASSETS; ?>plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
    <?php echo $this->load->view(ADMIN_HEADER_PATH); ?>
    <?php echo $this->load->view(ADMIN_SIDEBAR_PATH); ?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header ">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
					<ol class="breadcrumb ">
            <?php
            $breadcrumb_details = json_decode($breadcrumb);
            $breadcrumb_count = count($breadcrumb_details);
            foreach ($breadcrumb_details as $breadcrumb) {
                ?>
                <li class="breadcrumb-item <?php echo $breadcrumb->class; ?>">
                    <a href="<?php echo $breadcrumb->link; ?>">    <i class="material-icons"><?php echo $breadcrumb->icon; ?></i> <?php echo fetch_ucfirst($breadcrumb->title); ?></a>
                </li>
            <?php } ?>
        </ol>
          </div>
        </div>
    </section>

    <!-- Main content -->
		<section class="content">
			<?php 
				$type_result = json_decode($animation_result);
				// print_r($type_result);
			?>
			<div class="row">
				<div class="col-md-12">
				<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $main_title; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" role="form" class="form-elments1" action="" method="post" id="<?php echo $form_setup['form_id']; ?>">
                <div class="card-body">
                  <div class="form-group col-md-5">
										<label for="title">Title <sup> *</sup> <span class="error_label" id="title_error"></span></label>
							  		<input type="text" class="form-control" name="title" id="title" placeholder="Title" autocomplete="off" value="<?php echo $type_result->type_title; ?>">
                  </div>
                  <div class="form-group col-md-5">
										<label for="description">Description <sup> *</sup> <span class="error_label" id="description_error"></span></label>
										<textarea class="form-control" name="description" id="description" placeholder="Description" autocomplete="off" rows="3"><?php echo $type_result->description; ?></textarea>
                  </div>
                </div>
								
						<input type="hidden" name="type_id" id="type_id" value="<?php echo base64_encode($type_result->type_id); ?>" />
                <!-- /.card-body -->
                <div class="card-footer">
									<div class="btn_section">
										<a onclick="return confirm('Confirm to cancel..?')" href="<?php echo $form_setup['cancel_link']; ?>" class="btn btn-danger" >Cancel</a>
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
									<div class="form-group col-lg-12 submissionMessage"></div>									
                </div>
              </form>
            </div>
				</div>
			</div>
    </section>
    <!-- /.content -->
		<!-- form end -->
  </div>
  <!-- /.content-wrapper -->
		<?php echo $this->load->view(ADMIN_FOOTER_PATH); ?>
    <?php echo $this->load->view(ADMIN_JS_VIEW_PATH); ?>
		<script src="<?php echo ADMIN_JS_PATH.'project.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo $form_setup['form_jspath']; ?>" type="text/javascript"></script>
		<script type="text/javascript">
			var redirectionURL = "<?php echo base_url().'admin/Admin/list_animation_types'; ?>";
		</script>
</body>
</html>
