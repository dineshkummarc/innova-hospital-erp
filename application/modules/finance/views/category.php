<!--sidebar end-->
<!--main content start-->



<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-money-bill-wave mr-2"></i><?php echo lang('payment_category'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('payment_category'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('All the payment categories names and related informations'); ?></h3>
                            <div class="float-right">
                                <a href="finance/addCategoryView">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_payment_category'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('category'); ?></th>
                                        <th><?php echo lang('description'); ?></th>
                                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                                            <th class="no-print"><?php echo lang('options'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php foreach ($categories as $category) { ?>
                                        <tr class="">
                                            <td><?php echo $category->category; ?></td>
                                            <td> <?php echo $category->description; ?></td>
                                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                                <td class="no-print d-flex gap-1">
                                                    <a class="btn btn-info btn-sm editbutton" title="<?php echo lang('edit'); ?>" href="finance/editCategory?id=<?php echo $category->id; ?>"><i class="fa fa-edit"></i> </a>
                                                    <a class="btn btn-danger btn-sm delete_button" title="<?php echo lang('delete'); ?>" href="finance/deleteCategory?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>








<!--main content end-->
<!--footer start-->


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/finance/category.js"></script>