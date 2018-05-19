
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $url_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="<?php echo ADMIN_JS_PATH; ?>jquery-3.3.1.min.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo ADMIN_ASSETS; ?>plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo ADMIN_ASSETS; ?>plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo ADMIN_ASSETS; ?>plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo ADMIN_ASSETS; ?>plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo ADMIN_ASSETS; ?>plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo ADMIN_ASSETS; ?>plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo ADMIN_ASSETS; ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="<?php echo ADMIN_CSS_PATH; ?>fontstyles.css" rel="stylesheet">
  <script src="<?php echo ADMIN_JS_PATH; ?>date-picker.min.js" type="text/javascript"></script>
	<link href="<?php echo ADMIN_CSS_PATH; ?>date-picker.min.css" rel="stylesheet" type="text/css"/>
  <style>
    sup{color:red;}
    textarea{resize:none;}
    .error_label{color:red;}
  </style>
</head>
<body class="hold-transition sidebar-mini">
    <?php echo $this->load->view(ADMIN_HEADER_PATH); ?>
    <?php echo $this->load->view(ADMIN_SIDEBAR_PATH); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $main_title; ?></h3>
              </div>
              <?php $animations = json_decode($animation_styles); //print_r($animations); ?>
              <form role="form" role="form" class="form-elments1" action="" method="post" id="<?php echo $form_setup['form_id']; ?>">
              <div class="card-body">
                  <div class="form-group col-md-5">
                    <label for="category">Category <sup> *</sup> <span class="error_label" id="category_error"></span></label>
                      <select class="form-control select2" multiple="multiple" data-placeholder="Select Category"
                          style="width: 100%;" id="category" name="category">
                        <?php
                          if($animations->code==SUCCESS_CODE){
                              foreach($animations->common_result as $animation){ ?>
                                <option value="<?php echo $animation->id; ?>"><?php echo $animation->title; ?></option>
                              <?php }
                          }
                        ?>
                      </select>
                  </div>
                  <div class="form-group col-md-5 col-md-offset-1">
										<label for="casting">Casting <sup> *</sup> <span class="error_label" id="casting_error"></span></label>
                  	<input type="text" class="form-control" name="casting" id="casting" placeholder="Casting" autocomplete="off">
                  </div>
                  <div class="form-group col-md-5 col-md-offset-1">
										<label for="title">Title <sup> *</sup> <span class="error_label" id="title_error"></span></label>
							  		<input type="text" class="form-control" name="title" id="title" placeholder="Title" autocomplete="off">
                  </div>
									<div class="form-group col-md-5 col-md-offset-1">
										<label for="date">Date <sup> *</sup> <span class="error_label" id="date_error"></span></label>
							  		<input type="text" class="form-control" name="datepicker" id="datepicker" placeholder="Date" autocomplete="off">
                  </div>
                  <div class="bootstrap-timepicker col-md-5 col-md-offset-1">                  
                    <div class="form-group">
                      <label>Start Time <sup> *</sup> <span class="error_label" id="starttime_error"></span></label>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" id="start_time" name="start_time">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
									<div class="bootstrap-timepicker col-md-5 col-md-offset-1">                  
                    <div class="form-group">
                      <label>End Time <sup> *</sup> <span class="error_label" id="end_error"></span></label>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" id="end_time" name="end_time">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
									<!-- <input id="datepicker" width="270" /> -->
                  <div class="form-group col-md-5 col-md-offset-1">
										<label for="description">Description <span class="error_label" id="description_error"></span></label>
										<textarea class="form-control" name="description" id="description" placeholder="Description" autocomplete="off" rows="3"></textarea>
                  </div>
                <!-- time Picker -->
                
              </div>
              <div class="card-footer">
									<div class="btn_section">
										<a onclick="return confirm('Confirm to cancel..?')" href="<?php echo $form_setup['cancel_link']; ?>" class="btn btn-danger" >Cancel</a>
										<button type="submit" class="btn btn-primary">Add Now</button>
									</div>
									<div class="form-group col-lg-12 submissionMessage"></div>									
                </div>
              </form>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php echo $this->load->view(ADMIN_FOOTER_PATH); ?>
  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="<?php echo ADMIN_ASSETS; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo ADMIN_ASSETS; ?>plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo ADMIN_ASSETS; ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo ADMIN_ASSETS; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo ADMIN_ASSETS; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="<?php echo ADMIN_JS_PATH; ?>moment.min.js"></script>
<script src="<?php echo ADMIN_ASSETS; ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo ADMIN_ASSETS; ?>plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo ADMIN_ASSETS; ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo ADMIN_ASSETS; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_ASSETS; ?>plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo ADMIN_ASSETS; ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo ADMIN_ASSETS; ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo ADMIN_ASSETS; ?>dist/js/demo.js"></script>
<!-- <script>
var date = new Date();
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
  $(document).ready(function () {
      $('#datepicker').datepicker({
        uiLibrary: 'bootstrap',
        minDate: today,
        format: 'dd/mm/yyyy'
      });
  });
  //Timepicker
  $('.timepicker').timepicker({
    showInputs: true
  })
</script> -->
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker         : true,
      timePickerIncrement: 30,
      format             : 'MM/DD/YYYY h:mm A'
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<script src="<?php echo ADMIN_JS_PATH.'project.js'; ?>" type="text/javascript"></script>
<script src="<?php echo $form_setup['form_jspath']; ?>" type="text/javascript"></script>
<script type="text/javascript">
  var redirectionURL = "<?php echo base_url().'admin/Admin/list_compitions'; ?>";
</script>
</body>
</html>
