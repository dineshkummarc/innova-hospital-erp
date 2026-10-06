<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-user-tie text-primary mr-3"></i>
                        <?php echo lang('receptionist'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('receptionist'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('receptionist'); ?>
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
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('image'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('email'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('address'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('phone'); ?></th>
                                        <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($receptionists as $receptionist) { ?>
                                        <tr>
                                            <td class="align-middle">
                                                <img class="img-fluid rounded-circle" style="width: 50px; height: 50px;" src="<?php echo $receptionist->img_url; ?>">
                                            </td>
                                            <td class="align-middle"><?php echo $receptionist->name; ?></td>
                                            <td class="align-middle"><?php echo $receptionist->email; ?></td>
                                            <td class="align-middle"><?php echo $receptionist->address; ?></td>
                                            <td class="align-middle"><?php echo $receptionist->phone; ?></td>
                                            <td class="align-middle no-print">
                                                <a type="button" class="btn btn-info btn-sm editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $receptionist->id; ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm delete_button" href="receptionist/delete?id=<?php echo $receptionist->id; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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

<!-- Add Receptionist Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h2 class="modal-title text-white font-weight-800"><?php echo lang('add_receptionist'); ?></h2>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body bg-light p-4">
                <form role="form" action="receptionist/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                    <!-- Personal Information -->
                    <div class="row mb-5">
                        <div class="col-12 mb-4">
                            <h3 class="border-bottom border-primary pb-3 text-uppercase font-weight-900">
                                <i class="fas fa-user-circle mr-3 text-primary"></i><?php echo lang('personal_details'); ?>
                            </h3>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg shadow-sm" name="name" required="">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('email'); ?> <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-lg shadow-sm" name="email" required="">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('password'); ?> <span class="text-danger">*</span></label>
                                <input type="password" class="form-control form-control-lg shadow-sm" name="password" required="">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('address'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg shadow-sm" name="address" required="">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('phone'); ?> <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-lg shadow-sm" name="phone" required="">
                            </div>
                        </div>
                    </div>

                    <!-- Profile Information -->
                    <div class="row mb-5">
                        <div class="col-12 mb-4">
                            <h3 class="border-bottom border-danger pb-3 text-uppercase font-weight-900">
                                <i class="fas fa-user-md mr-3 text-danger"></i><?php echo lang('profile_info'); ?>
                            </h3>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('profile'); ?> <span class="text-danger">*</span></label>
                                <textarea class="form-control shadow-sm ckeditor" id="editor1" name="profile" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Images Upload -->
                    <div class="row mb-5">
                        <div class="col-12 mb-4">
                            <h3 class="border-bottom border-info pb-3 text-uppercase font-weight-900">
                                <i class="fas fa-camera mr-3 text-info"></i><?php echo lang('images'); ?>
                            </h3>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('signature'); ?> <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="signature">
                                    <label class="custom-file-label shadow-sm"><?php echo lang('choose_file'); ?></label>
                                </div>
                                <div class="mt-2">
                                    <img src="" id="signature" height="100px" alt="" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('image'); ?></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="img_url">
                                    <label class="custom-file-label shadow-sm"><?php echo lang('choose_file'); ?></label>
                                </div>
                                <div class="mt-2">
                                    <img src="" id="img" height="100px" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" id="id_value" value=''>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                                <i class="fas fa-user-edit mr-3"></i><?php echo lang('submit'); ?>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Receptionist Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h2 class="modal-title text-white font-weight-800"><?php echo lang('edit_receptionist'); ?></h2>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body bg-light p-4">
                <form role="form" id="editReceptionistForm" class="clearfix" action="receptionist/addNew" method="post" enctype="multipart/form-data">

                    <!-- Personal Information -->
                    <div class="row mb-5">
                        <div class="col-12 mb-4">
                            <h3 class="border-bottom border-primary pb-3 text-uppercase font-weight-900">
                                <i class="fas fa-user-circle mr-3 text-primary"></i><?php echo lang('personal_details'); ?>
                            </h3>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg shadow-sm" name="name" required="">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('email'); ?> <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-lg shadow-sm" name="email" required="">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('password'); ?></label>
                                <input type="password" class="form-control form-control-lg shadow-sm" name="password" placeholder="********">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('address'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg shadow-sm" name="address" required="">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('phone'); ?> <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-lg shadow-sm" name="phone" required="">
                            </div>
                        </div>
                    </div>

                    <!-- Profile Information -->
                    <div class="row mb-5">
                        <div class="col-12 mb-4">
                            <h3 class="border-bottom border-danger pb-3 text-uppercase font-weight-900">
                                <i class="fas fa-user-md mr-3 text-danger"></i><?php echo lang('profile_info'); ?>
                            </h3>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('profile'); ?></label>
                                <textarea class="form-control shadow-sm ckeditor" id="editor3" name="profile" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Images Upload -->
                    <div class="row mb-5">
                        <div class="col-12 mb-4">
                            <h3 class="border-bottom border-info pb-3 text-uppercase font-weight-900">
                                <i class="fas fa-camera mr-3 text-info"></i><?php echo lang('images'); ?>
                            </h3>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('signature'); ?> <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="signature">
                                    <label class="custom-file-label shadow-sm"><?php echo lang('choose_file'); ?></label>
                                </div>
                                <div class="mt-2">
                                    <img src="" id="signature" height="100px" alt="" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('image'); ?></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="img_url">
                                    <label class="custom-file-label shadow-sm"><?php echo lang('choose_file'); ?></label>
                                </div>
                                <div class="mt-2">
                                    <img src="" id="img" height="100px" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" id="id_value" value=''>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                                <i class="fas fa-user-edit mr-3"></i><?php echo lang('submit'); ?>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/receptionist.js"></script>