<!-- Content Header (Page header) -->
<style>
.row{
	margin-bottom:10px;
}
</style>
 <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo lang('clients')?>
        <small><?php echo lang('add')?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/clients')?>"><?php echo lang('clients')?></a></li>
        <li class="active"><?php echo lang('add')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
	<?php 
	if(validation_errors()){
?>
<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                        <b><?php echo lang('alert');?>!</b><?php echo validation_errors(); ?>
                                    </div>

<?php  } ?>
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('add')?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				
				<?php echo form_open_multipart('admin/clients/add/'); ?>
                    <div class="box-body">
                        <div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="name" style="clear:both;"><?php echo lang('name')?></label>
									<input type="text" name="name" value="<?php echo set_value('name')?>" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
							<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="gender" style="clear:both;"><?php echo lang('gender')?></label>
									<input type="radio" name="gender" value="Male" /> <?php echo lang('male')?>
									<input type="radio" name="gender" value="Female" /> <?php echo lang('female')?>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="meli" style="clear:both;"><?php echo lang('meli')?></label>
									<input type="text" name="meli" value="<?php echo set_value('meli')?>" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="fname" style="clear:both;"><?php echo lang('father')?></label>
									<input type="text" name="father" value="<?php echo set_value('father')?>" class="form-control">
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="lob" style="clear:both;"><?php echo lang('lob')?></label>
									<input type="text" name="lob" value="<?php echo set_value('lod')?>" class="form-control">
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="ss" style="clear:both;"><?php echo lang('ss')?></label>
									<input type="text" name="ss" value="<?php echo set_value('ss')?>" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
				
					
               
			   			 <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="dob" style="clear:both;"><?php echo lang('date_of_birth');?></label>
									<input type="text" name="dob" id="dob" value="<?php echo set_value('dob')?>" class="form-control" autocomplete="off">
									
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="moaref" style="clear:both;"><?php echo lang('moaref')?></label>
									<input type="text" name="moaref" value="<?php echo set_value('moaref')?>" class="form-control">
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="job" style="clear:both;"><?php echo lang('job')?></label>
									<input type="text" name="job" value="<?php echo set_value('job')?>" class="form-control">
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" style="clear:both;"><?php echo lang('phone')?></label>
									<input type="text" name="contact" value="<?php echo set_value('contact')?>" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
						
						 <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" style="clear:both;"><?php echo lang('address')?></label>
									<textarea name="address"  class="form-control"><?php echo set_value('address')?></textarea>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="postcode" style="clear:both;"><?php echo lang('postcode')?></label>
									<input type="text" name="postcode" value="<?php echo set_value('postcode')?>" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
						
						<?php 
						if($fields){
							foreach($fields as $doc){
							$output = '';
							if($doc->field_type==1) //testbox
							{
						?>
						<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" style="clear:both;"><?php echo $doc->name; ?></label>
							<input type="text" class="form-control" name="reply[<?php echo $doc->id ?>]" id="req_doc" />
								</div>
                            </div>
                        </div>
					 <?php 	}	
							if($doc->field_type==2) //dropdown list
							{
								$values = explode(",", $doc->values);
					?>	<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" style="clear:both;"><?php echo $doc->name; ?></label>
							<select name="reply[<?php echo $doc->id ?>]" class="form-control">
							<?php	
										foreach($values as $key=>$val) {
											echo '<option value="'.$val.'">'.$val.'</option>';
										}
							?>			
							</select>	
								</div>
                            </div>
                        </div>
						<?php	}	
								if($doc->field_type==3) //radio buttons
							{
								$values = explode(",", $doc->values);
					?>	<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" style="clear:both;"><?php echo $doc->name; ?></label>
							
							<?php	
										foreach($values as $key=>$val) { ?>
										
										<input type="radio" name="reply[<?php echo $doc->id ?>]" value="<?php echo $val;?>" />	<?php echo $val;?> &nbsp; &nbsp; &nbsp; &nbsp;
 							<?php 			}
							?>			
								</div>
                            </div>
                        </div>
						
						<?php }
						if($doc->field_type==4) //checkbox
							{
								$values = explode(",", $doc->values);
					?>	<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" style="clear:both;"><?php echo $doc->name; ?></label>
							
							<?php	
										foreach($values as $key=>$val) { ?>
										
										<input type="checkbox" name="reply[<?php echo $doc->id ?>]" value="<?php echo $val;?>" class="form-control" />	&nbsp; &nbsp; &nbsp; &nbsp;
 							<?php 			}
							?>			
								</div>
                            </div>
                        </div>
					<?php }	if($doc->field_type==5) //Textarea
						  {		?>	<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" style="clear:both;"><?php echo $doc->name; ?></label>
										<textarea class="form-control" name="reply[<?php echo $doc->id ?>]" ></textarea		
								></div>
                            </div>
                        </div>
							
						
						
					<?php 
								}	if($doc->field_type==6) //url
						  		{?>
						<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" style="clear:both;"><?php echo $doc->name; ?></label>
										<input type="url"  value=""name="reply[<?php echo $doc->id ?>]" class="form-control" >
								</div>
                            </div>
                        </div>
							
					<?php 
								}	if($doc->field_type==7) //Email
						  		{?>
						<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" style="clear:both;"><?php echo $doc->name; ?></label>
										<input type="email"  value=""name="reply[<?php echo $doc->id ?>]" class="form-control" >
								</div>
                            </div>
                        </div>
									
					<?php 
								}	if($doc->field_type==8) //Phone
						  		{?>
						<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" style="clear:both;"><?php echo $doc->name; ?></label>
										<input type="number"  value=""name="reply[<?php echo $doc->id ?>]" class="form-control" >
								</div>
                            </div>
                        </div>
													
						
						
					<?php	 
								}	
							}
						}
					?>	

                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  

<script src="<?php echo base_url('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jquery.datetimepicker.js')?>" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function() { 
    if (document.getElementById('dob')) { 
        kamaDatepicker('dob', { 
            buttonsColor: "blue",  
            forceFarsiDigits: true,
            markToday: true,       
            gotoToday: true,       
            format: 'YYYY/MM/DD' 
        }); 
    }

     {
    kamaDatepicker('start_date', { buttonsColor: "blue", forceFarsiDigits: true, markToday: true, gotoToday: true });
     }
});
</script>