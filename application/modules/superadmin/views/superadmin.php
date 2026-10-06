<link href="common/extranal/css/superadmin/superadmin.css" rel="stylesheet">

<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-user-shield text-primary mr-3"></i>
                        <?php echo lang('superadmin'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('superadmin'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="superadmin/addNewView" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_superadmin'); ?>
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
                        <div class="card-header bg-light">
                            <h3 class="card-title font-weight-bold"><?php echo lang('All the super admin names and related informations'); ?></h3>
                        </div>

                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('image'); ?></th>
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('email'); ?></th>
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('address'); ?></th>
                                        <th class="font-weight-bold text-uppercase "><?php echo lang('phone'); ?></th>
                                        <th class="font-weight-bold text-uppercase  no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($superadmins as $superadmin) { ?>
                                        <tr>
                                            <td><img src="<?php echo $superadmin->img_url; ?>" class="img-thumbnail" style="height:50px;"></td>
                                            <td><?php echo $superadmin->name; ?></td>
                                            <td><?php echo $superadmin->email; ?></td>
                                            <td><?php echo $superadmin->address; ?></td>
                                            <td><?php echo $superadmin->phone; ?></td>
                                            <td class="no-print">
                                                <?php if ($superadmin->id != 12) { ?>
                                                    <a href="superadmin/editSuperadmin?id=<?php echo $superadmin->id; ?>" class="btn btn-info btn-sm" data-id="<?php echo $superadmin->id; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="superadmin/delete?id=<?php echo $superadmin->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                <?php } ?>
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

<!-- Add Superadmin Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-dark" id="myModalLabel"><?php echo lang('add_superadmin'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form role="form" action="superadmin/addNew" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('name'); ?> *</label>
                            <input type="text" class="form-control form-control-lg" name="name" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('email'); ?> *</label>
                            <input type="email" class="form-control form-control-lg" name="email" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('password'); ?> *</label>
                            <input type="password" class="form-control form-control-lg" name="password" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('address'); ?> *</label>
                            <input type="text" class="form-control form-control-lg" name="address" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('phone'); ?> *</label>
                            <input type="text" class="form-control form-control-lg" name="phone" required>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('image'); ?></label>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb bg-white p-2">
                                    <img src="" height="100px" alt="" />
                                </div>
                                <div class="mt-2">
                                    <span class="btn btn-white btn-file">
                                        <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                        <input type="file" class="default" name="img_url" />
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-primary px-4"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Superadmin Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-dark" id="myModalLabel"><?php echo lang('edit_superadmin'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form role="form" id="editSuperadminForm" action="superadmin/addNew" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('name'); ?> *</label>
                            <input type="text" class="form-control form-control-lg" name="name" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('email'); ?> *</label>
                            <input type="email" class="form-control form-control-lg" name="email" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('password'); ?></label>
                            <input type="password" class="form-control form-control-lg" name="password" placeholder="********">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('address'); ?> *</label>
                            <input type="text" class="form-control form-control-lg" name="address" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('phone'); ?> *</label>
                            <input type="text" class="form-control form-control-lg" name="phone" required>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('image'); ?></label>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb bg-white p-2">
                                    <img src="" height="100px" alt="" />
                                </div>
                                <div class="mt-2">
                                    <span class="btn btn-white btn-file">
                                        <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                        <input type="file" class="default" name="img_url" />
                                    </span>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="id">
                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-primary px-4"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/superadmin.js"></script>