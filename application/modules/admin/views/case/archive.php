<link href="<?php echo base_url('assets/css/chosen.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/jquery.datetimepicker.css')?>" rel="stylesheet" type="text/css" />
<!-- Content Header (Page header) -->
<style>
.row{
	margin-bottom:10px;
}
</style>
 <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo lang('archived');?>
        <small><?php echo lang('case');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/cases')?>">Case</a></li>
        <li class="active"><?php echo lang('archive');?> <?php echo lang('case');?></li>
    </ol>
</section>

<section class="content">


    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('archive');?> <?php echo lang('case');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
		<?php if(validation_errors()){ ?>		
			<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                        <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
                                    </div>
		<?php } ?>							
				<?php echo form_open_multipart('admin/cases/archived/'.$id); ?>
                    <div class="box-body">
                        <div class="box-body">
                        
						 <div class="form-group">
                        	<div class="row">
                                <div class="col-md-1">
                                	<b><?php echo lang('case');?> <?php echo lang('title');?></b>
								</div>
								<div class="col-md-2">
                                    
									<?php echo $case->title;?>
                                </div>
								
								 <div class="col-md-1">
                                	<b><?php echo lang('case');?> <?php echo lang('number');?></b>
								</div>
								<div class="col-md-2">
                                    
									<?php echo $case->case_no;?>
                                </div>
								
								 <div class="col-md-1">
                                	<b><?php echo lang('client');?></b>
								</div>
								<div class="col-md-2">
										<?php foreach($clients as $new) {
												$sel = "";
												if($new->id==$case->client_id) echo $new->name;
											}
											
											?>
                                </div>
                            </div>
                        </div>
						
						
						
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('notes');?></b>
								</div>
								<div class="col-md-4">
                                   <textarea name="notes" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
						
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('close');?> <?php echo lang('date');?></b>
								</div>
								<div class="col-md-4">
                                   <input type="text" name="close_date" id="close_date" value="" class="form-control" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
						
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('close');?></button>
                    </div>
             <?php echo form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  
<script src="<?php echo base_url('assets/js/chosen.jquery.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jquery.datetimepicker.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/kamaDatepicker.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {

	$('.chzn').chosen({width: "100%"}); // Added width option for better responsiveness

});
// --- Persian Datepicker Initialization ---
$(document).ready(function() {
    if (document.getElementById('close_date')) {
        kamaDatepicker('close_date', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            markToday: true,
            gotoToday: true,
            format: 'YYYY/MM/DD'
        });
    }
});
// --- End Persian Datepicker Initialization ---

</script>
