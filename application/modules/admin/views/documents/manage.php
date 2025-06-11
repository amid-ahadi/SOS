<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('are_you_sure');?>');
}
</script>

<section class="content-header">
    <h1>
        <?php echo $document->title; ?>
        <small><?php echo lang('manage');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li class="active"><?php echo lang('documents');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('add'); ?> <?php echo lang('document'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group input_fields_wrap">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Documents</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="title[]" value="" class="form-control" placeholder="Title" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="doc[]" value="" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-offset-2" style="padding-left:12px;">
                                                <button class="add_field_button btn btn-success">Add More</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if(check_user_role(122)==1){?>
                            <div class="row">
                                <div class="col-xs-12" style="padding:20px;">
                                    <input type="submit" name="ok" value="Save" class="btn btn-primary" />
                                </div>
                            </div>
                            <?php } ?>
                        </form>
                    </div>

                    <div class="box-body table-responsive" style="margin-top:40px;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= lang('serial_number') ?></th>
                                    <th><?= lang('name') ?></th>
                                    <th><?= lang('action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($documents as $doc): ?>
                                <tr>
                                    <td><?= $doc->id ?></td>
                                    <td><?= $doc->title ?></td>
                                    <td>
                                        <a href="<?= site_url('admin/documents/download/'.$doc->id.'/'.$doc->file_name) ?>" class="btn btn-default">
                                            <i class="fa fa-download"></i> <?= lang('download') ?>
                                        </a>
                                        <a href="<?= site_url('admin/documents/delete_document/'.$doc->id.'/'.$doc->file_name) ?>"
                                           onclick="return confirm('<?= lang('confirm_delete') ?>')"
                                           class="btn btn-danger">
                                           <i class="fa fa-trash"></i> <?= lang('delete') ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example1').DataTable();
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 100;
    var wrapper         = $(".input_fields_wrap");
    var add_button      = $(".add_field_button"); 
    var x = 1;

    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div class="row" style="padding-top:10px;"><div class="col-md-2"></div><div class="col-md-4"><input type="text" name="title[]" class="form-control" placeholder="Title" /></div><div class="col-md-4"><input type="file" name="doc[]" class="form-control" /></div><a href="#" class="remove_field btn btn-danger">Remove</a></div>');
        }
    });

    $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
});
</script>