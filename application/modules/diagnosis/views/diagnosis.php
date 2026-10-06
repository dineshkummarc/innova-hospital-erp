<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-stethoscope text-primary mr-3"></i>
                        <?php echo lang('diagnosis_list'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('diagnosis_list'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_diagnosis'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('Comprehensive List of Diagnosis'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase">#</th>
                                        <th class="font-weight-bold"><?php echo lang('disease'); ?> <?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('icd 10'); ?> <?php echo lang('code'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('description'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('Disease With Outbreak Potential'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('Maximum Expected Number Of Patient In A Week'); ?></th>
                                        <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

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

<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_diagnosis'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="diagnosis/addNew" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('disease'); ?> <?php echo lang('name'); ?> </label>
                        <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($setval)) {
                                                                                                                                echo set_value('name');
                                                                                                                            }
                                                                                                                            if (!empty($diagnosis->name)) {
                                                                                                                                echo $diagnosis->name;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('icd 10'); ?> <?php echo lang('code'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="code" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($setval)) {
                                                                                                                                echo set_value('code');
                                                                                                                            }
                                                                                                                            if (!empty($diagnosis->code)) {
                                                                                                                                echo $diagnosis->code;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('description'); ?> </label>
                        <textarea class="form-control col-sm-9 ckeditor" id="editor1" name="description" value="<?php
                                                                                                                if (!empty($setval)) {
                                                                                                                    echo set_value('description');
                                                                                                                }
                                                                                                                if (!empty($diagnosis->description)) {
                                                                                                                    echo $diagnosis->description;
                                                                                                                }
                                                                                                                ?>" rows="10" cols="20"></textarea>


                    </div>
                    <div class="form-group d-flex disease_div">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input disease_with_outbreak_potential" id="diseaseOutbreakPotential" name="disease_with_outbreak_potential" value="1">
                            <label class="custom-control-label mr-2 mb-2" for="diseaseOutbreakPotential"><?php echo lang('Disease With Outbreak Potential'); ?></label>
                        </div>
                    </div>
                    <div id="maximum">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('Maximum Expected Number Of Patient In A Week'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="maximum_expected_number_of_patient_in_a_week" id="exampleInputEmail1" value='<?php
                                                                                                                                                                            if (!empty($setval)) {
                                                                                                                                                                                echo set_value('maximum_expected_number_of_patient_in_a_week');
                                                                                                                                                                            }
                                                                                                                                                                            if (!empty($diagnosis->maximum_expected_number_of_patient_in_a_week)) {
                                                                                                                                                                                echo $diagnosis->maximum_expected_number_of_patient_in_a_week;
                                                                                                                                                                            }
                                                                                                                                                                            ?>' placeholder="">
                        </div>
                    </div>


                    <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_diagnosis'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editDiagnosisForm" class="clearfix" action="diagnosis/addNew" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="id" value=''>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('disease'); ?> <?php echo lang('name'); ?> </label>
                        <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($setval)) {
                                                                                                                                echo set_value('name');
                                                                                                                            }
                                                                                                                            if (!empty($diagnosis->name)) {
                                                                                                                                echo $diagnosis->name;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('icd 10'); ?> <?php echo lang('code'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="code" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($setval)) {
                                                                                                                                echo set_value('code');
                                                                                                                            }
                                                                                                                            if (!empty($diagnosis->code)) {
                                                                                                                                echo $diagnosis->code;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('description'); ?> </label>
                        <textarea class="form-control form-control-lg" id="editor3" name="description" value="" rows="30" cols="20"></textarea>


                    </div>
                    <div class="form-group d-flex disease_div1">
                        <input type="checkbox" name="disease_with_outbreak_potential" value="1" class="disease_with_outbreak_potential1">
                        <label for="exampleInputEmail1" class=""> <?php echo lang('Disease With Outbreak Potential'); ?> </label>
                    </div>
                    <div id="maximum1">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('Maximum Expected Number Of Patient In A Week'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="maximum_expected_number_of_patient_in_a_week" id="exampleInputEmail1" value='<?php
                                                                                                                                                                            if (!empty($setval)) {
                                                                                                                                                                                echo set_value('maximum_expected_number_of_patient_in_a_week');
                                                                                                                                                                            }
                                                                                                                                                                            if (!empty($diagnosis->maximum_expected_number_of_patient_in_a_week)) {
                                                                                                                                                                                echo $diagnosis->maximum_expected_number_of_patient_in_a_week;
                                                                                                                                                                            }
                                                                                                                                                                            ?>' placeholder="">
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/diagnosis.js"></script>

<script>
    $(document).ready(function() {
        $("#maximum").hide();

        // Toggle the display of the 'maximum' field when the checkbox is clicked
        $('.disease_with_outbreak_potential').on('change', function() {
            if ($(this).is(':checked')) {
                $('#maximum').show(); // Show the field when checkbox is checked
            } else {
                $('#maximum').hide(); // Hide the field when checkbox is unchecked
            }
        });

        $('.disease_with_outbreak_potential1').on('change', function() {
            if ($(this).is(':checked')) {
                $('#maximum1').show(); // Show the field when checkbox is checked
            } else {
                $('#maximum1').hide(); // Hide the field when checkbox is unchecked
            }
        });
    });
</script>