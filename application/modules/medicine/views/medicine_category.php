<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-pills text-primary mr-3"></i>
                        <?php echo lang('medicine') ?> <?php echo lang('category') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('medicine'); ?> <?php echo lang('category'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-success btn-sm px-4 py-3">
                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('all'); ?> <?php echo lang('medicine'); ?> <?php echo lang('categories'); ?> <?php echo lang('names_and_related_information'); ?></h3>
                        </div>

                        <div class="card-body bg-light">
                            <table class="table table-hover" id="editable-sample">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('category'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('description'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category) { ?>
                                        <tr>
                                            <td><?php echo $category->category; ?></td>
                                            <td><?php echo $category->description; ?></td>
                                            <td>
                                                <a type="button" class="btn btn-info btn-sm editbutton" data-toggle="modal" data-id="<?php echo $category->id; ?>"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" href="medicine/deleteMedicineCategory?id=<?php echo $category->id; ?>" onclick="return confirm('<?php echo lang('are_you_sure_you_want_to_delete_this_item'); ?>');"><i class="fa fa-trash"></i></a>
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






<!-- Add Medicine Category Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><?php echo lang('create'); ?> <?php echo lang('medicine'); ?> <?php echo lang('category'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="medicine/addNewCategory" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-4">
                                <label class="text-uppercase text-sm"><?php echo lang('category'); ?> <?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" name="category" value='' required="">
                            </div>

                            <div class="form-group mb-4">
                                <label class="text-uppercase text-sm"><?php echo lang('description'); ?> <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-lg" name="description" rows="3"></textarea>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block"><?php echo lang('submit'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Medicine Category Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><?php echo lang('edit'); ?> <?php echo lang('medicine'); ?> <?php echo lang('category'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <?php echo validation_errors(); ?>
                        <form role="form" id="editCategoryForm" action="medicine/addNewCategory" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-4">
                                <label class="text-uppercase text-sm"><?php echo lang('category'); ?> <?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" name="category" value='' required="">
                            </div>

                            <div class="form-group mb-4">
                                <label class="text-uppercase text-sm"><?php echo lang('description'); ?> <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-lg" name="description" rows="3"></textarea>
                            </div>

                            <input type="hidden" name="id" value=''>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block"><?php echo lang('submit'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/medicine/medicine_category.js"></script>