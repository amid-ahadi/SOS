<link href="<?php echo base_url('assets/css/chosen.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/kamaDatepicker.min.css')?>" rel="stylesheet" type="text/css" />

<style>
.row{
	margin-bottom:10px;
}
</style>
 <section class="content-header">
    <h1>
        <?php echo lang('case')?>
        <small><?php echo lang('edit')?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/cases')?>"><?php echo lang('case')?></a></li>
        <li class="active"><?php echo lang('edit')?></li>
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
                                             <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
                                         </div>

<?php  } ?>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('edit')?></h3>
                </div><?php echo form_open_multipart('admin/cases/edit/'.$id); ?>
                    <div class="box-body">
                                        
						 <div class="form-group">
                        	<div class="row">
                                 <div class="col-md-3">
                                 	<b><?php echo lang('case')?> <?php echo lang('title')?></b>
								</div>
								<div class="col-md-4">
                                        
									<input type="text" name="title" value="<?php echo set_value('title', $case->title);?>" class="form-control">
                                 </div>
                            </div>
                         </div>
						
						
						 <div class="form-group">
                        	<div class="row">
                                 <div class="col-md-3">
                                 	<b><?php echo lang('case')?> <?php echo lang('number')?></b>
								</div>
								<div class="col-md-4">
                                         <input type="text" name="case_no" value="<?php echo set_value('case_no', $case->case_no);?>" class="form-control" readonly>
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
											if(set_value('client_id', $case->client_id) == $new->id) $sel = "selected='selected'";
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
                                 	<b><?php echo lang('location')?></b>
								</div>
								<div class="col-md-4" id="location_result">
                                         <select name="location_id" id="location_id" class="chzn col-md-12" >
										<option value="">--<?php echo lang('select')?> <?php echo lang('location')?>--</option>
										<?php foreach($locations as $new) {
											$sel = "";
											if(set_value('location_id', $case->location_id) == $new->id) $sel = "selected='selected'";
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
                                 	<b><?php echo lang('court')?> <?php echo lang('category')?></b>
								</div>
								<div class="col-md-4" id="court_category_result">
                                         <select name="court_category_id"  id="court_category_id" class="chzn col-md-12" >
										<option value="">--<?php echo lang('select')?> <?php echo lang('court')?> <?php echo lang('category')?>--</option>
										<?php 
                                            // Pre-select based on $case data, also consider set_value for validation repopulation
                                            $selected_court_category_id = set_value('court_category_id', $case->court_category_id);
                                            foreach($court_categories as $new) {
											$sel = ($new->id == $selected_court_category_id) ? "selected='selected'" : "";
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
                                         <select name="court_id" id="court_id"  class="chzn col-md-12" >
										<option value="">--<?php echo lang('select')?> <?php echo lang('court')?>--</option>
										<?php 
                                            // Pre-select based on $case data, also consider set_value
                                            $selected_court_id = set_value('court_id', $case->court_id);
                                            foreach($courts as $new) { // Assuming $courts are loaded initially or via AJAX based on pre-selected location/category
											$sel = ($new->id == $selected_court_id) ? "selected='selected'" : "";
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
                                 	<b><?php echo lang('case')?> <?php echo lang('category')?></b>
								</div>
								<div class="col-md-4">
                                         <select name="case_category_id[]" class="chzn col-md-12" multiple="multiple" >
										<?php 
                                            $selected_case_categories = json_decode($case->case_category_id);
                                            if (is_array(set_value('case_category_id[]'))) { // Check if set_value has an array (from validation fail)
                                                $selected_case_categories = set_value('case_category_id[]');
                                            } elseif (empty(set_value('case_category_id[]')) && !is_null(set_value('case_category_id[]'))) {
                                                // Handles case where set_value might return empty string instead of array
                                                $selected_case_categories = [];
                                            }


                                            foreach($case_categories as $new) {
											$sel = (is_array($selected_case_categories) && in_array($new->id, $selected_case_categories)) ? 'selected="selected"' : '';
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
                                 	<b><?php echo lang('case')?> <?php echo lang('stages')?></b>
								</div>
								<div class="col-md-4">
                                         <select name="case_stage_id" class="chzn col-md-12">
										<option value="">--<?php echo lang('select')?> <?php echo lang('case')?> <?php echo lang('stages')?>--</option>
										<?php foreach($stages as $new) {
											$sel = "";
											if(set_value('case_stage_id', $case->case_stage_id) == $new->id) $sel = "selected='selected'";
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
										<?php 
										$selected_acts = json_decode($case->act_id);
                                            if (is_array(set_value('act_id[]'))) {
                                                $selected_acts = set_value('act_id[]');
                                            } elseif (empty(set_value('act_id[]')) && !is_null(set_value('act_id[]'))) {
                                                 $selected_acts = [];
                                            }
										
										foreach($acts as $new) {
											$sel = (is_array($selected_acts) && in_array($new->id, $selected_acts)) ? 'selected="selected"' : '';
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
                                        <textarea name="description" class="form-control"><?php echo set_value('description', $case->description);?></textarea>
                                 </div>
                            </div>
                         </div>
						
						
						<div class="form-group">
                        	<div class="row">
                                 <div class="col-md-3">
                                 	<b><?php echo lang('filling_date')?></b>
								</div>
								<div class="col-md-4">
                                                                                                 <input type="text" name="start_date" id="jalali-datepicker-start" value="<?php echo set_value('start_date', $case->start_date);?>" class="form-control" autocomplete="off"/> </div>
                            </div>
                         </div>
						
									<div class="form-group">
                        	<div class="row">
                                 <div class="col-md-3">
                                 	<b><?php echo lang('hearing_date')?></b>
								</div>
								<div class="col-md-4">
                                 <input type="text" name="hearing_date" id="jalali-datepicker-hearing" value="<?php echo set_value('hearing_date', $case->hearing_date);?>" class="form-control" autocomplete="off"/> </div>
                            </div>
                         </div>
						
						<div class="form-group">
                        	<div class="row">
                                 <div class="col-md-3">
                                 	<b><?php echo lang('opposite_lawyer')?></b>
								</div>
								<div class="col-md-4">
                                        <input type="text" name="o_lawyer" value="<?php echo set_value('o_lawyer', $case->o_lawyer);?>" class="form-control"/>
                                 </div>
                            </div>
                         </div>
						
						
						<div class="form-group">
                        	<div class="row">
                                 <div class="col-md-3">
                                 	<b><?php echo lang('total_fees')?></b>
								</div>
								<div class="col-md-4">
                                        <input type="text" name="fees" value="<?php echo set_value('fees', $case->fees);?>" class="form-control"/>
                                 </div>
                            </div>
                         </div>
						
						<?php 
					$CI = get_instance(); // This is fine if used carefully.
						if($fields){ // <--- این `if` برای بررسی وجود فیلدها باز می‌شود
							foreach($fields as $doc){ // <--- این `foreach` برای پیمایش فیلدها باز می‌شود
							// $output = ''; // Not used
							if($doc->field_type==1) //testbox
							{
						?>
						<div class="form-group">
                             <div class="row">
							 
                                 <div class="col-md-3">
                                         <label for="reply_<?php echo $doc->id; ?>" style="clear:both;"><?php echo $doc->name; ?></label> </div>
								<div class="col-md-4">	
							<?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."' ")->row();?>		
							<input type="text" class="form-control" name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>" value="<?php echo set_value("reply[{$doc->id}]", @$result->reply); ?>"/> </div>
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
								<?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."' ")->row();
                                        $selectedValue = set_value("reply[{$doc->id}]", @$result->reply);
                                 ?>	
							<select name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>" class="form-control"> <?php	
										foreach($values as $key=>$val) {
											$sel= ($val == $selectedValue) ? "selected='selected'" : "";
											echo '<option value="'.htmlspecialchars($val).'" '.$sel.'>'.htmlspecialchars($val).'</option>'; // Added htmlspecialchars
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
                                        $selectedValue = set_value("reply[{$doc->id}]", @$CI->db->query("select reply from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."' ")->row()->reply);
										foreach($values as $key=>$val) { 
                                            $x = ($val == $selectedValue) ? 'checked="checked"' : '';
                                        ?>
						
						<input type="radio" name="reply[<?php echo $doc->id ?>]" value="<?php echo htmlspecialchars($val);?>" <?php echo $x;?> />	<?php echo htmlspecialchars($val);?> &nbsp; &nbsp; &nbsp; &nbsp; <?php 			}
							?>			
								</div>
                             </div>
                         </div>
						
						<?php }
						if($doc->field_type==4) //checkbox
							{
                                 // Similar to add.php, this assumes a single value. If it's a group, the name should be an array.
								$values = explode(",", $doc->values);
					?>	<div class="form-group">
                             <div class="row">
                                 <div class="col-md-3">
                                         <label style="clear:both;"><?php echo $doc->name; ?></label> </div>
								<div class="col-md-4">
							
							<?php	
                                        $selectedValue = set_value("reply[{$doc->id}]", @$CI->db->query("select reply from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."' ")->row()->reply);
									foreach($values as $key=>$val) { 
                                            $x = ($val == $selectedValue) ? 'checked="checked"' : '';
                                        ?>
										
										<input type="checkbox" name="reply[<?php echo $doc->id ?>]"  <?php echo $x;?> value="<?php echo htmlspecialchars($val);?>" />	<?php echo htmlspecialchars($val);?> &nbsp; &nbsp; &nbsp; &nbsp; <?php 			}
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
									<?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."'")->row();?>	
										<textarea class="form-control" name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>" ><?php echo set_value("reply[{$doc->id}]", @$result->reply);?></textarea> </div>
                             </div>
                         </div>
							<?php }	if($doc->field_type==6) //url
						  {		?>	<div class="form-group">
                             <div class="row">
                                 <div class="col-md-3"> <label for="reply_<?php echo $doc->id; ?>" style="clear:both;"><?php echo $doc->name; ?></label>
                                 </div>
								<div class="col-md-4"> <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."'")->row();?>	
										<input type="url" value="<?php echo set_value("reply[{$doc->id}]", @$result->reply);?>" class="form-control" name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>"  /> </div>
                             </div>
                         </div>
					
						<?php }	if($doc->field_type==7) //email
						  {		?>	<div class="form-group">
                             <div class="row">
                                 <div class="col-md-3"> <label for="reply_<?php echo $doc->id; ?>" style="clear:both;"><?php echo $doc->name; ?></label>
                                 </div>
								<div class="col-md-4"> <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."'")->row();?>	
										<input type="email" value="<?php echo set_value("reply[{$doc->id}]", @$result->reply);?>" name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>"  class="form-control" /> </div>
                             </div>
                         </div>
							
							
					<?php }	if($doc->field_type==8) //Phone
						  {		?>	<div class="form-group">
                             <div class="row">
                                 <div class="col-md-3"> <label for="reply_<?php echo $doc->id; ?>" style="clear:both;"><?php echo $doc->name; ?></label>
                                 </div>
								<div class="col-md-4"> <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."'")->row();?>	
									<input type="text" value="<?php echo set_value("reply[{$doc->id}]", @$result->reply);?>" class="form-control" name="reply[<?php echo $doc->id ?>]" id="reply_<?php echo $doc->id; ?>" /> </div>
                             </div>
                         </div>
															
					<?php 
								} // این براکت `}` حلقه `foreach($fields as $doc)` را می‌بندد
							} // این براکت `}` شرط `if($fields)` را می‌بندد
						}
					?>		
			 
						
						
			 			
                     </div><div class="box-footer">
                         <button type="submit" class="btn btn-primary"><?php echo lang('update')?></button>
                     </div>
                   <?php echo form_close()?>
             </div></div>
       </div>
</section>	
<script src="<?php echo base_url('assets/js/chosen.jquery.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/kamaDatepicker.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
	
	$('.chzn').chosen({width: "100%"}); // Added width
	
});

// kamaDatepicker 
$(function() {
    kamaDatepicker('jalali-datepicker-start', {
        format: 'YYYY-MM-DD',
     
    });

    kamaDatepicker('jalali-datepicker-hearing', {
        format: 'YYYY-MM-DD',
        
    });
});





$(document).on('change', '#location_id', function(){
 	vch = $(this).val();
  var ajax_load = '<div class="text-center"><img src="<?php echo base_url('assets/img/ajax-loader.gif')?>"/></div>';
  $('#court_category_result').html(ajax_load);
  $('#court_result').html('<select name="court_id" id="court_id" class="chzn col-md-12" ><option value="">--<?php echo lang('court')?> <?php echo lang('select')?>--</option></select>');
  $('#court_id').chosen("destroy").chosen({width: "100%"});


  $.ajax({
    url: '<?php echo site_url('admin/cases/get_court_categories') ?>',
    type:'POST',
    data:{id:vch},
    success:function(result){
	  $('#court_category_result').html(result);
	  $("#court_category_id").chosen({width: "100%"});
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
	  $("#court_id").chosen({width: "100%"});
	 },
    error: function() {
        $('#court_result').html('<p class="text-danger">Error loading courts.</p>');
    }
  });
});

</script>