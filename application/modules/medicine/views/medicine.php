<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-pills text-primary mr-3"></i>
                        <?php echo lang('medicine') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('medicine'); ?></li>
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
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('all'); ?> <?php echo lang('medicine'); ?> <?php echo lang('names_and_related_information'); ?></h3>
                        </div>

                        <div class="card-body bg-light">
                            <table class="table table-hover" id="editable-sample1">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('id'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('category'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('store_box'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('p_price'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('s_price'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('quantity'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('generic_name'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('company'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('effects'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('expiry_date'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('options'); ?></th>
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





<!-- Add Medicine Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><?php echo lang('add_medicine'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="name" value='' required="">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('category'); ?> <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-lg select2" name="category" required="">
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category->category; ?>" <?php
                                                                                                    if (!empty($medicine->category)) {
                                                                                                        if ($category->category == $medicine->category) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>><?php echo $category->category; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('p_price'); ?> <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control form-control-lg" name="price" value='' required="">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('s_price'); ?> <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control form-control-lg" name="s_price" value='' required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('generic_name'); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="generic" value='' required="">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('company'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="company" value=''>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('effects'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="effects" value=''>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('store_box'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="box" value=''>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('expiry_date'); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg default-date-picker readonly" name="e_date" value='' required="">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block"><?php echo lang('submit'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Medicine Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><?php echo lang('edit_medicine'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <?php echo validation_errors(); ?>
                        <form role="form" id="editMedicineForm" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="name" value='' required="">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('category'); ?> <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-lg select2" name="category" required="">
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category->category; ?>" <?php
                                                                                                    if (!empty($medicine->category)) {
                                                                                                        if ($category->category == $medicine->category) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>><?php echo $category->category; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('p_price'); ?> <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control form-control-lg" name="price" value='' required="">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('s_price'); ?> <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control form-control-lg" name="s_price" value='' required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('generic_name'); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="generic" value='' required="">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('company'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="company" value=''>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('effects'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="effects" value=''>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('store_box'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="box" value=''>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-uppercase text-sm"><?php echo lang('expiry_date'); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg default-date-picker readonly" name="e_date" value='' required="">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value=''>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block"><?php echo lang('submit'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- Medicine Delete Safety Check Modal -->
<div class="modal fade" id="deleteSafetyModal" role="dialog" aria-labelledby="deleteSafetyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">
                    <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
                    <?php echo lang('delete'); ?> <?php echo lang('medicine'); ?> - <?php echo lang('safety_check'); ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="safetyCheckContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i><?php echo lang('cancel'); ?>
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn" style="display: none;">
                    <i class="fas fa-trash mr-2"></i><?php echo lang('confirm_delete'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/medicine/medicine.js"></script>