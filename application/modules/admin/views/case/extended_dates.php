<link href="<?php echo base_url('assets/css/chosen.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/kamaDatepicker.min.css')?>" rel="stylesheet" type="text/css" />

<style>
.row{
	margin-bottom:10px;
}
</style>
 <section class="content-header">
    <h1>
        <?php echo lang('extended_dates_of_case_no')?> : <?php echo $case->case_no?>
        <small><?php echo $case->title?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/cases')?>"><?php echo lang('cases')?></a></li>
        <li class="active"><?php echo lang('extended_dates')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                
                <?php if(validation_errors()){ ?>		
			<div class="alert alert-danger alert-dismissable">
                                             <i class="fa fa-ban"></i>
                                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                             <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
                                         </div>
		<?php } ?>	
				<form method="post" action="<?php echo site_url('admin/cases/dates/'.$id)?>" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                        	<div class="row">
                                 <div class="col-md-3">
                                 	<b><?php echo lang('curdate')?></b>
								</div>
								<div class="col-md-4">
                                        
									<input type="text" name="date" id="jalali-datepicker-current" value="" class="form-control" autocomplete="off">
                                 </div>
                            </div>
                        </div>
						
						  <div class="form-group">
                        	<div class="row">
                                 <div class="col-md-3">
                                 	<b><?php echo lang('lastdate')?></b>
								</div>
								<div class="col-md-4">
                                        
									<input type="text" name="date2" id="jalali-datepicker-last" value="" class="form-control" autocomplete="off">
                                 </div>
                            </div>
                        </div>
					  
					  
						<div class="form-group">
                        	<div class="row">
                                 <div class="col-md-3">
                                 	<b><?php echo lang('notes')?></b>
								</div>
								<div class="col-md-4">
                                        <textarea name="notes" class="form-control"/></textarea>
                                 </div>
                            </div>
                        </div>
						
						
						<div class="form-group">
                        	<div class="row">
                                 <div class="col-md-3">
                                 	<b><?php echo lang('attachment')?> <?php echo lang('document')?></b>
								</div>
								<div class="col-md-4">
                                        <input type="file" name="img" value="" class="form-control"/>
                                 </div>
                            </div>
                        </div>
						
				  </div><div class="box-footer">
                        <button  type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>
					
					<div class="box-body table-responsive" style="margin-top:40px;">
                    <table id="example1" class="table table-bordered table-striped table-mailbox">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo lang('serial_number')?></th>
								<th><?php echo lang('curdate')?></th>
								<th><?php echo lang('lastdate')?></th>
								<th><?php echo lang('notes')?></th>
								<th><?php echo lang('attachment')?></th>
								<th width="20%"><?php echo lang('action')?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($cases)):?>
                        <tbody>
                            <?php $i=1;foreach ($cases as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
									<td><?= $new->next_date ?></td>
                                    <td><?= $new->last_date ?></td>
								    <td><?php echo  substr($new->note,0,50)?></td>
									<td><?php if(!empty($new->document)){?>
										  <a class="btn btn-default" href="<?php echo base_url('assets/uploads/files/'.$new->document); ?>" target="_blank"><i class="fa fa-download"></i> Attachment</a>					
										  <?php }else {?>
										 <?php echo lang('no')?> <?php echo lang('attachment')?>
										 <?php } ?>  
									</td>
									
                                    <td width="20%">
								<?php if(check_user_role(170)==1){?>		
									 <a class="btn btn-primary"  href="<?php echo site_url('admin/cases/dates_detail/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
									 <?php } ?>
								<?php if(check_user_role(171)==1){?>			 
                                             <a class="btn btn-danger" style="margin-left:20px;" href="<?php echo site_url('admin/cases/delete_history/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
                                     <?php } ?>      
                                    </td>
                                </tr>
                                <?php $i++;}?>
                        </tbody>
                        <?php endif;?>
                    </table>
				</div></form>
            </div></div>
       </div>
</section>	

<script src="<?php echo base_url('assets/js/kamaDatepicker.min.js')?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>


<script src="<?php echo base_url('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('#example1').dataTable({
	});

    //  KamaDatepicker 
    kamaDatepicker('jalali-datepicker-current', {
        format: 'YYYY-MM-DD', 
    });

    kamaDatepicker('jalali-datepicker-last', {
        format: 'YYYY-MM-DD',
        
    });
});

</script>