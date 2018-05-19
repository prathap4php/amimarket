<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title> <?php echo $url_title; ?></title>
  	<?php $this->load->view(ADMIN_CSS_VIEW_PATH); ?>
    <script src="<?php echo ADMIN_JS_PATH; ?>jquery-3.3.1.min.js"></script>
    <style>
        .error_label{color:red;}
        sup{color: red;}
	    textarea{resize: none;}
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <?php echo $this->load->view(ADMIN_HEADER_PATH); ?>
    <?php echo $this->load->view(ADMIN_SIDEBAR_PATH); ?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
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
        <div >
            <center><div id="successmessage" class="temp"></div></center>
            <center><div id="failmessage"  class="temp"></div></center>
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
                <div class="card-tools">
                    <form action="<?php echo base_url('admin/Admin/list_animation_types'); ?>" method="post" >
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search_title" id="search_title" class="form-control" placeholder="Search by title..">
                            <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>                  
                    </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                    <div class="float-right">
                    <button class="btn btn-success " style="margin-bottom:5px;" onclick="updateActivationStatus('1')" ><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Active</button>
                    <button class="btn btn-warning btn-md" style="margin-bottom:5px;margin-left:18px;" onclick="updateActivationStatus('0')"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;In active</button>
                    <button class="btn btn-danger btn-md" style="margin-bottom:5px;margin-left:18px;" onclick="commonDelete()"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;Delete</button>
                    <a href="<?php echo $form_setup['add_link']; ?>" class="btn btn-primary btn-md" style="margin-bottom:5px;margin-left:18px;">Add New</a>
                    </div>
                <table class="table table-bordered">
                  <tr>
                    <th style="width: 10px"><input type="checkbox" class="inline-checkbox" name="multiAction" id="multiAction"></th>
                    <th> S.No </th>
                    <th> Title </th>
                    <th> Description </th>
                    <th> Created On </th>
                    <th> Modified On</th>
                    <th> Staus</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                  <?php
                    $types_req = json_decode($types_result);
                    // print_r($types_req);
                    $p=1;
                    if($types_req->code==SUCCESS_CODE){
                      foreach($types_req->types_result as $type){ ?>
                           <tr>
                              <td><input type="checkbox" class="inline-checkbox" name="multiple[]" id="checkbox[]" value="<?php echo $type->type_id; ?>"></td>
                              <td class=""><?php echo $p; ?></td>
                              <td class="sorting_1"><?php echo ucwords($type->type_name); ?></td>
                              <td><?php echo ucwords($type->description); ?></td>
                              <td><?php echo date('d-M-Y h:i A',strtotime($type->createdOn)); ?></td>
                              <td><?php if(strlen(strtotime($type->modifiedOn))!=0){echo date('d-M-Y h:i A',strtotime($type->modifiedOn));} ?></td>
                              <td><?php  
                                if($type->status!=1){
                                    ?>
                                    <span style="color: red"><b><?php echo "Not active"; ?></b></span>
                                    <?php
                                }
                                else{
                                    ?>
                                    <span style="color: green"><b><?php echo "Active"; ?></b></span>
                                    <?php
                                }
                                ?></td>
                              <td><a href="<?php echo base_url().'admin/Admin/edit_animation_type/'.base64_encode($type->type_id); ?>" class="btn btn-warning" />Edit </a>
                              </td>
                            </tr>
                      <?php  $p++; }
                    }
                    else{ ?>
                      <tbody>
                      <tr><td colspan="20"><div class="alert alert-danger"><center><b>No Data Found</b></center></div></td></tr>
                      </tbody>
                    <?php }
                ?>
                  
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><?php echo $links; ?></li>
                </ul>
              </div>
            </div>
            </div>
            </div>
        </div>
    </section>
            <!-- /.card -->
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
<SCRIPT language="javascript">
    /*>>checking multiple checkboxes code starts*/
    $("#multiAction").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
    /*<<checking multiple checkboxes code ends*/
    /*>>Removing the messages after some time code starts*/
    $( document ).ready(function() {
        $("#temp").delay(4000).fadeOut("slow");
    });
    /*<<Removing the messages after some time code endss*/
    /*>>Confirm message before deleting a records/records*/
    function ConfirmDelete()
    {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
    }
    /*>>Confirm message before deleting a records/records*/
    /*>>Changing owner status active/In-active code starts*/
    function updateActivationStatus(s) {
        var listarray = new Array();
        $('input[name="multiple[]"]:checked').each(function () {
         listarray.push($(this).val());
        });
        var checklist = "" + listarray;
        if (!isNaN(s) && (s == '1' || s == '0') && checklist != '') {
            $('#fail').hide();
            $.ajax({
                dataType: 'json',
                type: 'post',
                data: {'tablename': 'animation_types', 'updatelist': checklist, 'activity': s},
                url: '<?php echo base_url(); ?>Common/commonStatusActivity',
                success: function (u) {
                    console.log(u);
                    if (u.code == '200') {
                        $('#success').show();
                        $('#successmessage').html(u.description);
                        setTimeout(function () {
                            window.location = location.href;
                        }, 2000);
                    }
                    if (u.code == '204' || u.code == '301' || u.code == '422') {
                        $('#fail').show();
                        $('#failmessage').html(u.description);
                    }
                },
                error: function (er) {
                    console.log(er);
                }
            });
        }
        else {
            $('#fail').show();
            $('#failmessage').html('*  Please select a record');
            //$('#failmessage').delay(1000).fadeOut();
        }
    }
    /*<<Changing owner status active/In-active code ends*/
    /***common delete***/
    function commonDelete(){
        var listarray=new Array();
        $('input[name="multiple[]"]:checked').each(function(){listarray.push($(this).val());});
        var checklist=""+listarray;
        if(checklist!=''){
            $('#fail').hide();
            $.ajax({
                dataType:'JSON',
                type:'post',
                data:{'tablename':'animation_types','updatelist':checklist},
                url:'<?php echo base_url();?>Common/commonDelete',
                success:function(u){
                    console.log(u);
                    if(u.code=='200'){
                        $('#success').show();
                        $('#successmessage').html(u.description).addClass('alert alert-success');
                        setTimeout(function() {window.location=location.href;},2000);
                    }
                    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');}
                    },
                error:function(er){
                    console.log(er);
                }
            });
      }
      else{
       $('#fail').show();$('#failmessage').html('*  Please Select ').addClass('alert alert-danger');
      }
    }
    /***common delete***/
</SCRIPT>