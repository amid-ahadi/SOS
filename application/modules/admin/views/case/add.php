<link href="<?php echo base_url('assets/css/chosen.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/jquery.datetimepicker.css')?>" rel="stylesheet" type="text/css" />
<style>
.row{
	margin-bottom:10px;
}
</style>
 <section class="content-header">
    <h1>
        <?php echo lang('case')?>
        <small><?php echo lang('add')?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo base_url('admin/cases')?>"><?php echo lang('case')?></a></li>
        <li class="active"><?php echo lang('add')?></li>
    </ol>
</section>
<?php 
	if(validation_errors()){
?>
<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                        <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
                                    </div>

<?php  } ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('add')?></h3>
                </div><?php echo form_open_multipart('admin/cases/add/'); ?>
				    <div class="box-body">
                        <div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('case')?> <?php echo lang('title')?></b>
								</div>
								<div class="col-md-4">
                                    
									<input type="text" name="title" class="form-control" value="<?php echo set_value('title'); ?>">
                                </div>
                            </div>
                        </div>
					   
					   
					    <div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('case')?> <?php echo lang('number')?></b>
								</div>
								<div class="col-md-4">
                                    <input type="text" name="case_no" class="form-control" value="<?php echo isset($next_case_no) ? $next_case_no : set_value('case_no'); ?>" readonly>
                                </div>
                            </div>
                        </div>
						
					
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('client')?> <?php echo lang('name')?></b>
								
								</div>
								<div class="col-md-4">
                                    <select name="client_id" class="form-control chzn">
									<option value="">--<?php echo lang('select')?> <?php echo lang('client')?>--</option>
									<?php foreach($clients as $new) {
											$sel = "";
											if(set_select('client_id', $new->id)) $sel = "selected='selected'";
											echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
										}
										
										?>
									</select>
                                </div>
								  <!--<div class="col-md-3">
                                	<a href="#myModal" data-toggle="modal" class="btn bg-olive btn-flat margin"><?php echo lang('add')?>  <?php echo lang('new')?> <?php echo lang('client')?>	</a>		
								</div> -->
                            </div>
                        </div>
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('location')?></b>
								</div>
								<div class="col-md-4" id="location_result">
                                    <select name="location_id" id="location_id" class="chzn col-md-12" >
										<option value="">--<?php echo lang('select')?> <?php echo lang('location')?>--</option>
										<?php foreach($locations as $new) {
											$sel = "";
											if(set_select('location_id', $new->id)) $sel = "selected='selected'";
											echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
										}
										
										?>
									</select>
                                </div>
                            </div>
                        </div>
						
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('category')?> <?php echo lang('court')?></b>
								</div>
								<div class="col-md-4" id="court_category_result">
                                    <select name="court_category_id"  id="court_category_id" class="chzn col-md-12" > <option value="">--<?php echo lang('select')?> <?php echo lang('category')?> <?php echo lang('court')?>--</option>
										<?php foreach($court_categories as $new) {
											$sel = "";
											if(set_select('court_category_id', $new->id)) $sel = "selected='selected'";
											echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
										}
										
										?>
									</select>
                                </div>
                            </div>
                        </div>
					
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('court')?></b>
								</div>
								<div class="col-md-4" id="court_result">
                                    <select name="court_id" id="court_id" class="chzn col-md-12" > <option value="">--<?php echo lang('court')?> <?php echo lang('select')?>--</option>
										<?php foreach($courts as $new) {
											$sel = "";
											if(set_select('court_id', $new->id)) $sel = "selected='selected'";
											echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
										}
										
										?>
									</select>
                                </div>
                            </div>
                        </div>
						
						
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('category')?>  <?php echo lang('case')?></b>
								</div>
								<div class="col-md-4">
                                    <select name="case_category_id[]" class="chzn col-md-12" multiple="multiple" >
										<?php foreach($case_categories as $new) {
											$sel = "";
											// For multiple selects, set_select needs the specific value as the second argument
											if(is_array(set_value('case_category_id')) && in_array($new->id, set_value('case_category_id'))) $sel = "selected='selected'";
											echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
										}
										
										?>
									</select>
                                </div>
                            </div>
                        </div>
						
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('stage')?> <?php echo lang('case')?></b>
								</div>
								<div class="col-md-4">
                                    <select name="case_stage_id" class="chzn col-md-12">
										<option value="">--<?php echo lang('select')?> <?php echo lang('case')?> <?php echo lang('stage')?>--</option>
										<?php foreach($stages as $new) {
											$sel = "";
											if(set_select('case_stage_id', $new->id)) $sel = "selected='selected'";
											echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
										}
										
										?>
									</select>
                                </div>
                            </div>
                        </div>
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('act')?></b>
								</div>
								<div class="col-md-4">
                                    <select name="act_id[]" class="chzn col-md-12" multiple="multiple" >
										<?php foreach($acts as $new) {
											$sel = "";
                                            // For multiple selects, set_select needs the specific value as the second argument
											if(is_array(set_value('act_id')) && in_array($new->id, set_value('act_id'))) $sel = "selected='selected'";
											echo '<option value="'.$new->id.'" '.$sel.'>'.$new->title.'</option>';
										}
										
										?>
										
									</select>
                                </div>
                            </div>
                        </div>
						
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('description')?></b>
								</div>
								<div class="col-md-4">
                                   <textarea name="description" class="form-control"><?php echo set_value('description'); ?></textarea>
                                </div>
                            </div>
                        </div>
						
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('filling_date')?></b>
								</div>
								<div class="col-md-4">
									<input type="text" name="start_date" value="<?php echo set_value('start_date') ?>" class="form-control " placeholder="1404-03-11"> </div>
                            </div>
                        </div>
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('courtdate')?></b> </div>
								<div class="col-md-4">
									<input type="text" name="hearing_date" value="<?php echo set_value('hearing_date') ?>" class="form-control " placeholder="1404-03-11"> </div>
                            </div>
                        </div>
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('opposite_lawyer')?></b>
								</div>
								<div class="col-md-4">
                                   <input type="text" name="o_lawyer" value="<?php echo set_value('o_lawyer'); ?>" class="form-control"/>
                                </div>
                            </div>
                        </div>
						
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-3">
                                	<b><?php echo lang('total_fees')?></b>
								</div>
								<div class="col-md-4">
                                   <input type="text" name="fees" value="<?php echo set_value('fees'); ?>" class="form-control"/>
                                </div>
                            </div>
                        </div>
						
						<?php 
						if($fields){
							foreach($fields as $doc){
							//$output = ''; // Not used
							if($doc->field_type==1) //testbox
							{
						?>
						<div class="form-group">
                              <div class="row">
                                <div class="col-md-3">
                                    <label for="reply_<?php echo $doc->id; ?>" style="clear:both;"><?php echo $doc->name; ?></label> </div>
								<div class="col-md-4">
							<input type="text" class="form-control" name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>" value="<?php echo set_value("reply[{$doc->id}]"); ?>" /> </div>
                            </div>
                        </div>
					 <?php 	}	
							if($doc->field_type==2) //dropdown list
							{
								$values = explode(",", $doc->values);
					?>	<div class="form-group">
                              <div class="row">
                                <div class="col-md-3">
                                    <label for="reply_<?php echo $doc->id; ?>" style="clear:both;"><?php echo $doc->name; ?></label> </div>
								<div class="col-md-4">	
							<select name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>" class="form-control"> <?php	
										foreach($values as $key=>$val) {
											$selected = (set_value("reply[{$doc->id}]") == $val) ? "selected='selected'" : ""; // Added selected logic
											echo '<option value="'.htmlspecialchars($val).'" '.$selected.'>'.htmlspecialchars($val).'</option>'; // Added htmlspecialchars
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
                                <div class="col-md-3">
                                    <label style="clear:both;"><?php echo $doc->name; ?></label> </div>
								<div class="col-md-4">
							<?php	
										foreach($values as $key=>$val) { 
                                            $checked = (set_value("reply[{$doc->id}]") == $val) ? "checked='checked'" : ""; // Added checked logic
                                        ?>
										
										<input type="radio" name="reply[<?php echo $doc->id ?>]" value="<?php echo htmlspecialchars($val);?>" <?php echo $checked; ?> />	<?php echo htmlspecialchars($val);?> &nbsp; &nbsp; &nbsp; &nbsp; <?php 			}
							?>			
								</div>
                            </div>
                        </div>
						
						<?php }
						if($doc->field_type==4) //checkbox
							{
								// Checkbox groups are tricky with set_value if name is an array. 
                                // Assuming single checkbox for now based on original structure. If multiple, logic needs adjustment.
								$values = explode(",", $doc->values); 
					?>	<div class="form-group">
                              <div class="row">
                                <div class="col-md-3">
                                    <label for="reply_<?php echo $doc->id; ?>" style="clear:both;"><?php echo $doc->name; ?></label> </div>
								<div class="col-md-4">
							<?php	
										foreach($values as $key=>$val) { // If it's a group of checkboxes with the same name, this loop is fine.
                                            // For a single checkbox, this loop might render multiple if $values has more than one item.
                                            // Assuming it's a group where multiple can be selected if name was reply[<?php echo $doc->id ?>][]
                                            // But current name is reply[<?php echo $doc->id ?>], so only one can be selected (like radio)
                                            $checked = (set_value("reply[{$doc->id}]") == $val) ? "checked='checked'" : ""; // if it's a single value checkbox
                                        ?>
										
										<input type="checkbox" name="reply[<?php echo $doc->id ?>]" value="<?php echo htmlspecialchars($val);?>" <?php echo $checked; ?> />	<?php echo htmlspecialchars($val);?> &nbsp; &nbsp; &nbsp; &nbsp; <?php 			}
							?>			
								</div>
                            </div>
                        </div>
					<?php }	if($doc->field_type==5) //Textarea
						  {		?>	<div class="form-group">
                              <div class="row">
                                <div class="col-md-3">
                                    <label for="reply_<?php echo $doc->id; ?>" style="clear:both;"><?php echo $doc->name; ?></label> </div>
								<div class="col-md-4">
										<textarea class="form-control" name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>"><?php echo set_value("reply[{$doc->id}]"); ?></textarea> </div>
                            </div>
                        </div>
							
						
						
					<?php 
								}	if($doc->field_type==6) //url
						  		{?>
						<div class="form-group">
                              <div class="row">
                                <div class="col-md-3"> <label for="reply_<?php echo $doc->id; ?>" style="clear:both;"><?php echo $doc->name; ?></label>
                                </div>
								<div class="col-md-4"> <input type="url" value="<?php echo set_value("reply[{$doc->id}]"); ?>" name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>" class="form-control" > </div>
                            </div>
                        </div>
							
					<?php 
								}	if($doc->field_type==7) //Email
						  		{?>
						<div class="form-group">
                              <div class="row">
                                 <div class="col-md-3"> <label for="reply_<?php echo $doc->id; ?>" style="clear:both;"><?php echo $doc->name; ?></label>
                                 </div>
								<div class="col-md-4"> <input type="email"  value="<?php echo set_value("reply[{$doc->id}]"); ?>" name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>" class="form-control" > </div>
                            </div>
                        </div>
									
					<?php 
								}	if($doc->field_type==8) //Phone
						  		{?>
						<div class="form-group">
                              <div class="row">
                                <div class="col-md-3"> <label for="reply_<?php echo $doc->id; ?>" style="clear:both;"><?php echo $doc->name; ?></label>
                                </div>
								<div class="col-md-4"> <input type="text" value="<?php echo set_value("reply[{$doc->id}]"); ?>" name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>" class="form-control" > </div>
                            </div>
                        </div>
													
						
						
					<?php 
								}	
							}
						}
					?>	

			   			
                      
						
                    </div><div class="box-footer">
                        <button  type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>
             </form>
            </div></div>
     </div>
</section>  



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
			 <div id="err">  
				<?php 
			// This validation_errors() here might not work as expected if the modal is loaded via JS without a page reload.
			// It's better to handle modal form validation errors via AJAX response.
			if(validation_errors()){ 
		?>
		<div class="alert alert-danger alert-dismissable">
												<i class="fa fa-ban"></i>
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
												<b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
											</div>
		
		<?php  } ?>  
			</div>
	   
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('add')?> <?php echo lang('new')?> <?php echo lang('client')?></h4>
      </div>
      <div class="modal-body">
			<form method="post" action="<?php echo site_url('admin/clients/add_client_ajax') ?>" id="my_form"> <div class="box-body">
                        <div class="form-group">
                        	<div class="row">
                                <div class="col-md-4"> <label for="name" style="clear:both;"><?php echo lang('name')?></label>
									<input type="text" name="name" id="name_modal" class="form-control"> </div>
                            </div>
                        </div>
						
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-8"> <label for="gender" style="clear:both;"><?php echo lang('gender')?></label><br/>
									<input type="radio" name="gender" id="gender_male_modal" value="Male" /> <?php echo lang('male')?>
									<input type="radio" name="gender" id="gender_female_modal" value="Female" /> <?php echo lang('female')?>
                                </div>
                            </div>
                        </div>
               <div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="meli" style="clear:both;"><?php echo lang('meli')?></label>
									<input type="text" name="meli" id="meli_modal" class="form-control">
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="fname" style="clear:both;"><?php echo lang('father')?></label>
									<input type="text" name="father" id="father_modal" class="form-control">
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="lob" style="clear:both;"><?php echo lang('lob')?></label>
									<input type="text" name="lob" id="lob_modal" class="form-control">
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="ss" style="clear:both;"><?php echo lang('ss')?></label>
									<input type="text" name="ss" id="ss_modal" class="form-control">
                                </div>
                            </div>
                        </div>
				
					
               
			   			 <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="dob_modal" style="clear:both;"><?php echo lang('date_of_birth');?></label>
									<input type="text" name="dob" id="dob_modal" class="form-control datepicker_modal"> </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="moaref_modal" style="clear:both;"><?php echo lang('moaref')?></label>
									<input type="text" name="moaref" id="moaref_modal" class="form-control">
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="job_modal" style="clear:both;"><?php echo lang('job')?></label>
									<input type="text" name="job" id="job_modal" class="form-control">
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact_modal" style="clear:both;"><?php echo lang('phone')?></label>
									<input type="text" name="contact" id="contact_modal" class="form-control">
                                </div>
                            </div>
                        </div>
						
						 <div class="form-group">
                              <div class="row">
                                <div class="col-md-8"> <label for="address_modal" style="clear:both;"><?php echo lang('address')?></label>
									<textarea name="address"  id="address_modal" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                        	<div class="row">
                                <div class="col-md-4">
                                    <label for="postcode_modal" style="clear:both;"><?php echo lang('postcode')?></label>
									<input type="text" name="postcode" id="postcode_modal" class="form-control">
                                </div>
                            </div>
                        </div>
						
							
						<?php 
						if($fields_clients){
							foreach($fields_clients as $doc_client){ // Changed variable name to avoid conflict
							// $output = ''; // Not used
							if($doc_client->field_type==1) //testbox
							{
						?>
						<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="reply_client_<?php echo $doc_client->id; ?>" style="clear:both;"><?php echo $doc_client->name; ?></label>
							<input type="text" class="form-control" name="reply[<?php echo $doc_client->id ?>]" id="reply_client_<?php echo $doc_client->id; ?>" />
								</div>
                            </div>
                        </div>
					 <?php 	}	
							if($doc_client->field_type==2) //dropdown list
							{
								$values_client = explode(",", $doc_client->values); // Changed variable name
					?>	<div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="reply_client_<?php echo $doc_client->id; ?>" style="clear:both;"><?php echo $doc_client->name; ?></label>
							<select name="reply[<?php echo $doc_client->id ?>]" id="reply_client_<?php echo $doc_client->id; ?>" class="form-control">
							<?php	
										foreach($values_client as $key_client=>$val_client) { // Changed variable names
											echo '<option value="'.htmlspecialchars($val_client).'">'.htmlspecialchars($val_client).'</option>';
										}
							?>			
							</select>	
								</div>
                            </div>
                        </div>
						<?php	}	
								if($doc_client->field_type==3) //radio buttons
							{
								$values_client = explode(",", $doc_client->values); // Changed variable name
					?>	<div class="form-group">
                              <div class="row">
                                <div class="col-md-8"> <label style="clear:both;"><?php echo $doc_client->name; ?></label><br/>
							
							<?php	
										foreach($values_client as $key_client=>$val_client) { ?>
										
										<input type="radio" name="reply[<?php echo $doc_client->id ?>]" value="<?php echo htmlspecialchars($val_client);?>" />	<?php echo htmlspecialchars($val_client);?> &nbsp; &nbsp;
 							<?php 			}
							?>			
								</div>
                            </div>
                        </div>
						
						<?php }
						if($doc_client->field_type==4) //checkbox
							{
								$values_client = explode(",", $doc_client->values); // Changed variable name
					?>	<div class="form-group">
                              <div class="row">
                                <div class="col-md-8"> <label style="clear:both;"><?php echo $doc_client->name; ?></label><br/>
							
							<?php	
										foreach($values_client as $key_client=>$val_client) { ?>
										
										<input type="checkbox" name="reply[<?php echo $doc_client->id ?>][]" value="<?php echo htmlspecialchars($val_client);?>" />	<?php echo htmlspecialchars($val_client);?> &nbsp; &nbsp; <?php 			}
							?>			
								</div>
                            </div>
                        </div>
					<?php }	if($doc_client->field_type==5) //Textarea
						  {		?>	<div class="form-group">
                              <div class="row">
                                <div class="col-md-8"> <label for="reply_client_<?php echo $doc_client->id; ?>" style="clear:both;"><?php echo $doc_client->name; ?></label>
										<textarea class="form-control" name="reply[<?php echo $doc_client->id ?>]" id="reply_client_<?php echo $doc_client->id; ?>" ></textarea>	
								</div>
                            </div>
                        </div>
							
						
						
					<?php 
								}	
							}
						}
					?>	



                    </div><div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>
             </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close')?></button>  
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url('assets/js/chosen.jquery.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jquery.datetimepicker.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	
	$('.chzn').chosen({width: "100%"}); // Added width option for better responsiveness
	
});

// Initialize datepickers for the main form
jQuery('.datepicker').datetimepicker({
 lang:'en',
 i18n:{
  de:{ // German localization, you might want to remove or change this if not needed
   months:[
    'Januar','Februar','März','April',
    'Mai','Juni','Juli','August',
    'September','Oktober','November','Dezember',
   ],
   dayOfWeek:[
    "So.", "Mo", "Di", "Mi", 
    "Do", "Fr", "Sa.",
   ]
  }
 },
 timepicker:false,
 format:'Y-m-d' // Standard date format
});

// Initialize datepicker for the modal form
jQuery('.datepicker_modal').datetimepicker({
 lang:'en',
 timepicker:false,
 format:'Y-m-d'
});


</script>


<script>

$(document).on('change', '#location_id', function(){
 	vch = $(this).val();
  var ajax_load = '<div class="text-center"><img src="<?php echo base_url('assets/img/ajax-loader.gif')?>"/></div>'; // Improved loader display
  $('#court_category_result').html(ajax_load);
  $('#court_result').html('<select name="court_id" id="court_id" class="chzn col-md-12" ><option value="">--<?php echo lang('court')?> <?php echo lang('select')?>--</option></select>'); // Reset court dropdown
  $('#court_id').chosen("destroy").chosen({width: "100%"}); // Re-initialize chosen for reset dropdown

  $.ajax({
    url: '<?php echo site_url('admin/cases/get_court_categories') ?>',
    type:'POST',
    data:{id:vch},
    success:function(result){
	  $('#court_category_result').html(result);
	  $("#court_category_id").chosen({width: "100%"}); // Initialize new select with chosen
	 },
    error: function() {
        $('#court_category_result').html('<p class="text-danger">Error loading court categories.</p>');
    }
  });
});


$(document).on('change', '#court_category_id', function(){
 	location_id = $('#location_id').val();
	c_c_id 		= $('#court_category_id').val();
  var ajax_load = '<div class="text-center"><img src="<?php echo base_url('assets/img/ajax-loader.gif')?>"/></div>';
  $('#court_result').html(ajax_load);
	  
  $.ajax({
    url: '<?php echo site_url('admin/cases/get_courts') ?>',
    type:'POST',
    data:{l_id:location_id,c_id:c_c_id},
	
	success:function(result){
	  $('#court_result').html(result);
	   $("#court_id").chosen({width: "100%"}); // Initialize new select with chosen
	 },
    error: function() {
        $('#court_result').html('<p class="text-danger">Error loading courts.</p>');
    }
  });
});

$( "#my_form" ).submit(function( event ) {
    event.preventDefault(); // Prevent default form submission
    var formData = $(this).serialize();
    $('#err').html(''); // Clear previous errors

	$.ajax({
		url: $(this).attr('action'), // Use form's action attribute
		type:'POST',
		data: formData,
		dataType: 'json', // Expect JSON response
		success:function(result){
			  if(result.status == "success") // Check for a status property in response
				{
					 $('#myModal').modal('hide');
                     // Optionally, refresh the client list in the main form or show a success message.
                     // For example, append the new client to the select dropdown:
                     var newOption = new Option(result.client_name, result.client_id, true, true);
                     $('select[name="client_id"]').append(newOption).trigger("chosen:updated");
                     alert(result.message || 'Client added successfully!'); // Show success message
                     $("#my_form")[0].reset(); // Reset modal form
				}
				else
				{
					// Display errors, assuming result.message contains HTML formatted errors or a simple string
					$('#err').html('<div class="alert alert-danger">' + (result.message || 'An error occurred.') + '</div>');
				}
		 },
         error: function(jqXHR, textStatus, errorThrown) {
             $('#err').html('<div class="alert alert-danger">Request failed: ' + textStatus + ', ' + errorThrown + '</div>');
         }
	  });
	
});
</script>

