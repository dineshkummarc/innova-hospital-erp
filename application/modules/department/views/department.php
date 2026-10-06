<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-hospital-alt text-primary mr-3"></i>
                        <?php echo lang('departments'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('department'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('department'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold"><?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('description'); ?></th>
                                        <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($departments as $department) { ?>
                                        <tr>
                                            <td><?php echo $department->name; ?></td>
                                            <td><?php echo $department->description; ?></td>
                                            <td class="no-print">
                                                <a type="button" class="btn btn-primary btn-sm editbutton" data-toggle="modal" title="<?php echo lang('edit'); ?>" data-id="<?php echo $department->id; ?>"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-success btn-sm" title="<?php echo lang('doctor_directory'); ?>" href="department/doctorDirectory?id=<?php echo $department->id; ?>"><i class="fa fa-users"></i></a>
                                                <a class="btn btn-danger btn-sm" title="<?php echo lang('delete'); ?>" href="department/delete?id=<?php echo $department->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Department Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h3 class="modal-title text-white font-weight-800"><?php echo lang('add_department'); ?></h3>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form action="department/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('department'); ?> <?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg shadow-sm" name="name" required>
                    </div>
                    <div class="form-group">
                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('description'); ?> <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-lg shadow-sm" name="description" id="editor" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="id" value="">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                        <i class="fas fa-check-circle mr-3"></i><?php echo lang('submit'); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Department Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h3 class="modal-title text-white font-weight-800"><?php echo lang('edit_department'); ?></h3>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form id="departmentEditForm" action="department/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('department'); ?> <?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg shadow-sm" name="name" required>
                    </div>
                    <div class="form-group">
                        <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('description'); ?> <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-lg shadow-sm" id="editor1" name="description" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="p_id" value="">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                        <i class="fas fa-check-circle mr-3"></i><?php echo lang('submit'); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/department.js"></script>