<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1><i class="fas fa-folder"></i> <strong><?php echo lang('file_manager') ?></strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('file_manager') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the files'); ?></h3>
                            <div class="float-right">
                                <a href="file/addNewView">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('title'); ?></th>
                                        <th> <?php echo lang('file'); ?></th>
                                        <th> <?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <?php
                                        foreach ($files as $file) {



                                            $extension_url = explode(".", $file->img_url);

                                            $length = count($extension_url);
                                            $extension = $extension_url[$length - 1];

                                            if (strtolower($extension) == 'pdf') {
                                                $files = '<a download class="example-image-link" href="' . $file->img_url . '" data-title="' . $file->title . '" target="_blank">' . '<img class="example-image" src="uploads/image/pdf.png" width="100px" height="100px"alt="image-1">' . '</a>';
                                            } elseif (strtolower($extension) == 'docx') {
                                                $files = '<a download class="example-image-link" href="' . $file->img_url . '" data-title="' . $file->title . '">' . '<img class="example-image" src="uploads/image/docx.png" width="100px" height="100px"alt="image-1">' . '</a>';
                                            } elseif (strtolower($extension) == 'doc') {
                                                $files = '<a download class="example-image-link" href="' . $file->img_url . '" data-title="' . $file->title . '">' . '<img class="example-image" src="uploads/image/doc.png" width="100px" height="100px"alt="image-1">' . '</a>';
                                            } elseif (strtolower($extension) == 'odt') {
                                                $files = '<a download class="example-image-link" href="' . $file->img_url . '" data-title="' . $file->title . '">' . '<img class="example-image" src="uploads/image/odt.png" width="100px" height="100px"alt="image-1">' . '</a>';
                                            } else {
                                                $files = '<a download class="example-image-link" href="' . $file->img_url . '" data-lightbox="example-1" data-title="' . $file->title . '">' . '<img class="example-image" src="' . $file->url . '" width="100px" height="100px"alt="image-1">' . '</a>';
                                            }






                                        ?>
                                            <tr class="">
                                                <td> <?php echo $file->title; ?></td>
                                                <td><?php echo $files; ?></td>
                                                <td>
                                                    <a class="btn btn-info btn-sm" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                        <a class="btn btn-danger btn-sm" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                                    <?php } ?>


                                                </td>
                                            </tr>
                                        <?php

                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                                        <?php
                                        foreach ($files as $file) {
                                            $modules = explode(',', $file->module);
                                            if (in_array('doctor', $modules)) {
                                        ?>
                                                <tr class="">
                                                    <td> <?php echo $file->title; ?></td>
                                                    <td><img class="img_src_class" src="<?php echo $file->img_url; ?>"></td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                            <a class="btn btn-danger btn-sm" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if ($this->ion_auth->in_group(array('Nurse'))) { ?>
                                        <?php
                                        foreach ($files as $file) {
                                            $modules = explode(',', $file->module);
                                            if (in_array('nurse', $modules)) {
                                        ?>
                                                <tr class="">
                                                    <td> <?php echo $file->title; ?></td>
                                                    <td><img class="img_src_class" src="<?php echo $file->img_url; ?>"></td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                            <a class="btn btn-danger btn-sm" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if ($this->ion_auth->in_group(array('Accountant'))) { ?>
                                        <?php
                                        foreach ($files as $file) {
                                            $modules = explode(',', $file->module);
                                            if (in_array('accountant', $modules)) {
                                        ?>
                                                <tr class="">
                                                    <td> <?php echo $file->title; ?></td>
                                                    <td><img class="img_src_class" src="<?php echo $file->img_url; ?>"></td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                            <a class="btn btn-danger btn-sm" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if ($this->ion_auth->in_group(array('Pharmacist'))) { ?>
                                        <?php
                                        foreach ($files as $file) {
                                            $modules = explode(',', $file->module);
                                            if (in_array('pharmacist', $modules)) {
                                        ?>
                                                <tr class="">
                                                    <td> <?php echo $file->title; ?></td>
                                                    <td><img class="img_src_class" src="<?php echo $file->img_url; ?>"></td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                            <a class="btn btn-danger btn-sm" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if ($this->ion_auth->in_group(array('Laboratorist'))) { ?>
                                        <?php
                                        foreach ($files as $file) {
                                            $modules = explode(',', $file->module);
                                            if (in_array('laboratorist', $modules)) {
                                        ?>
                                                <tr class="">
                                                    <td> <?php echo $file->title; ?></td>
                                                    <td><img class="img_src_class" src="<?php echo $file->img_url; ?>"></td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                            <a class="btn btn-danger btn-sm" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if ($this->ion_auth->in_group(array('Receptionist'))) { ?>
                                        <?php
                                        foreach ($files as $file) {
                                            $modules = explode(',', $file->module);
                                            if (in_array('receptionist', $modules)) {
                                        ?>
                                                <tr class="">
                                                    <td> <?php echo $file->title; ?></td>
                                                    <td><img class="img_src_class" src="<?php echo $file->img_url; ?>"></td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm" href="<?php echo $file->img_url; ?>" download> <?php echo lang('download'); ?> </a>
                                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                            <a class="btn btn-danger btn-sm" href="file/delete?id=<?php echo $file->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
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











<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/file.js"></script>