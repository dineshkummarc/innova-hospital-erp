<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-stethoscope text-primary mr-3"></i>
                        <?php echo lang('symptom_list'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('symptom_list'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_symptom'); ?>
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
                            <h3 class="card-title font-weight-bold"><?php echo lang('Comprehensive List of Symptom'); ?></h3>
                        </div>

                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold">#</th>
                                        <th class="font-weight-bold"><?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('description'); ?></th>
                                        <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Symptom Modal -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-dark" id="myModalLabel"><?php echo lang('add_symptom'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form role="form" action="symptom/addNew" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('name'); ?> *</label>
                            <input type="text" class="form-control form-control-lg" name="name" required>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('description'); ?></label>
                            <textarea class="form-control ckeditor" id="editor1" name="description" rows="10"></textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary px-4 float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Symptom Modal -->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-dark" id="myModalLabel"><?php echo lang('edit_symptom'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form role="form" id="editSymptomForm" action="symptom/addNew" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="id">

                        <div class="col-md-12 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('name'); ?> *</label>
                            <input type="text" class="form-control form-control-lg" name="name" required>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="form-label font-weight-bold mb-2"><?php echo lang('description'); ?></label>
                            <textarea class="form-control form-control-lg" id="editor3" name="description" rows="10"></textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary px-4 float-right"><?php echo lang('submit'); ?></button>
                        </div>
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
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/symptom.js"></script>