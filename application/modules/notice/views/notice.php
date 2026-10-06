<link href="common/extranal/css/notice/notice.css" rel="stylesheet">

<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-clipboard-list text-primary mr-3"></i>
                        <?php echo lang('notice'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('notice'); ?></li>
                        </ol>
                    </nav>
                </div>
                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                    <div class="col-sm-6 text-right">
                        <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                            <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title font-weight-bold"><?php echo lang('All the notices'); ?></h3>
                        </div>

                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold"><?php echo lang('title'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('description'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('notice'); ?> <?php echo lang('for'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('date'); ?></th>
                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                            <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($notices as $notice) { ?>
                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                            <tr>
                                                <td><?php echo $notice->title; ?></td>
                                                <td><?php echo $notice->description; ?></td>
                                                <td class="center"><?php echo $notice->type; ?></td>
                                                <td><?php
                                                    if (!empty($notice->date)) {
                                                        echo date('d-m-Y', $notice->date);
                                                    }
                                                    ?>
                                                </td>
                                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                    <td class="no-print">
                                                        <a class="btn btn-info btn-sm editbutton" data-toggle="modal" data-id="<?php echo $notice->id; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a class="btn btn-danger btn-sm" href="notice/delete?id=<?php echo $notice->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                            <?php } elseif ($this->ion_auth->in_group(array('Patient'))) {
                                            if ($notice->type == 'patient') { ?>
                                                <tr>
                                                    <td><?php echo $notice->title; ?></td>
                                                    <td><?php echo $notice->description; ?></td>
                                                    <td class="center"><?php echo $notice->type; ?></td>
                                                    <td><?php
                                                        if (!empty($notice->date)) {
                                                            echo date('d-m-Y', $notice->date);
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else {
                                            if ($notice->type == 'staff') { ?>
                                                <tr>
                                                    <td><?php echo $notice->title; ?></td>
                                                    <td><?php echo $notice->description; ?></td>
                                                    <td class="center"><?php echo $notice->type; ?></td>
                                                    <td><?php
                                                        if (!empty($notice->date)) {
                                                            echo date('d-m-Y', $notice->date);
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
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








<!--sidebar end-->
<!--main content start-->






<!--main content end-->
<!--footer start-->




<!-- Add Notice Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_notice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="notice/addNew" class="clearfix row" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="title" value='<?php
                                                                                                        if (!empty($notice->name)) {
                                                                                                            echo $notice->name;
                                                                                                        }
                                                                                                        ?>' placeholder="" required="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('notice_for'); ?></label>
                            <select class="form-control form-control-lg m-bot15" name="type" value=''>
                                <option value="patient" <?php
                                                        if (!empty($notice->type)) {
                                                            if ($notice->type == 'patient') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('patient'); ?></option>
                                <option value="staff" <?php
                                                        if (!empty($notice->type)) {
                                                            if ($notice->type == 'staff') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('staff'); ?></option>

                            </select>
                        </div>

                        <div class="form-group col-md-12 des">
                            <label class=""><?php echo lang('description'); ?> &ast;</label>
                            <div class="">
                                <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10" required=""> </textarea>
                            </div>
                        </div>


                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg default-date-picker readonly" name="date" value='' placeholder="" required="">
                        </div>




                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_notice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editNoticeForm" class="clearfix row" action="notice/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="title" value='<?php
                                                                                                        if (!empty($notice->name)) {
                                                                                                            echo $notice->name;
                                                                                                        }
                                                                                                        ?>' placeholder="" required="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('notice_for'); ?></label>
                            <select class="form-control form-control-lg m-bot15" name="type" value=''>
                                <option value="patient" <?php
                                                        if (!empty($notice->type)) {
                                                            if ($notice->type == 'patient') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('patient'); ?></option>
                                <option value="staff" <?php
                                                        if (!empty($notice->type)) {
                                                            if ($notice->type == 'staff') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('staff'); ?></option>

                            </select>
                        </div>
                        <div class="form-group col-md-12 des">
                            <label class=""><?php echo lang('description'); ?> &ast;</label>
                            <div class="">
                                <textarea class="ckeditor form-control editor" id="editor1" name="description" value="" rows="10" required=""> </textarea>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg default-date-picker" onkeypress="return false;" name="date" value='' placeholder="" required="">
                        </div>
                        <input type="hidden" name="id" value='<?php
                                                                if (!empty($notice->id)) {
                                                                    echo $notice->id;
                                                                }
                                                                ?>'>
                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/notice.js"></script>