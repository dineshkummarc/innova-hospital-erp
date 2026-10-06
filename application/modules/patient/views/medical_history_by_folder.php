<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-8">
                    <h1 class="font-weight-bold"><i class="fas fa-folder-open mr-2"></i><?php echo lang('patient'); ?> : <?php echo $this->patient_model->getPatientById($folder->patient)->name; ?> | <?php echo lang('folder'); ?> : <?php echo $folder->folder_name; ?></h1>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('documents') ?></li>
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
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('patient'); ?> : <?php echo $this->patient_model->getPatientById($folder->patient)->name; ?> | <?php echo lang('folder'); ?> : <?php echo $folder->folder_name; ?></h3>
                            <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                <div class="float-right">
                                    <a data-toggle="modal" href="#myModalff">
                                        <button id="" class="btn btn-success btn-sm">
                                            <i class="fa fa-plus-circle"></i> <?php echo lang('add_file'); ?>
                                        </button>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 patient_material_info row">
                                <?php foreach ($patient_materials as $patient_material) { ?>
                                    <div class="col-md-2 m-2 p-2 shadow">
                                        <div class="justify-content-center">
                                            <div class="post-info">
                                                <a class="example-image-link" href="<?= $patient_material->url; ?>" data-lightbox="example-1">
                                                    <img class="example-image" src="<?= $patient_material->url; ?>" alt="Patient Material Image" height="90" width="100">
                                                </a>
                                            </div>

                                            <div class="post-info patient-material-title text-center mt-2">
                                                <?= !empty($patient_material->title) ? htmlspecialchars($patient_material->title) : ''; ?>
                                            </div>
                                        </div>

                                        <div class="patient-material-url text-center mt-3">
                                            <div class="post-info">
                                                <a class="btn btn-primary btn-sm" href="<?= $patient_material->url; ?>" download>
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <?php if (!$this->ion_auth->in_group(['Patient'])) : ?>
                                                    <a class="btn btn-warning btn-sm delete-button" title="<?= lang('delete'); ?>" href="patient/deletePatientMaterialInFolder?id=<?= $patient_material->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
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
<div class="modal fade" id="myModalff" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast; </label>
                        <input type="text" class="form-control form-control-lg" name="title" placeholder="" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('file'); ?> &ast; </label>
                        <input type="file" name="img_url" required>
                    </div>
                    <input type="hidden" name="hidden_folder_name" value="<?php echo $folder->folder_name; ?>" />
                    <input type="hidden" name="patient" value='<?php echo $folder->patient; ?>'>
                    <input type="hidden" name="folder" value='<?php echo $folder->id; ?>'>
                    <input type="hidden" name="type" value='doc'>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>