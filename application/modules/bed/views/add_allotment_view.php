<!--sidebar end-->
<!--main content start-->

<link href="common/extranal/css/bed/edit_alloted_bed.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-hospital-user mr-3 text-primary"></i>
                        <?php
                        if (!empty($allotment->id))
                            echo lang('edit_admission');
                        else
                            echo lang('new_admission');
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="bed" class="text-primary"><?php echo lang('beds'); ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php
                                                                                if (!empty($allotment->id))
                                                                                    echo lang('edit_admission');
                                                                                else
                                                                                    echo lang('new_admission');
                                                                                ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary py-4">
                            <h2 class="card-title mb-0 text-white display-6 font-weight-800"><?php echo lang('patient_admission_form'); ?></h2>
                        </div>
                        <div class="card-body bg-light p-4">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="bed/addAllotment" method="post" enctype="multipart/form-data">

                                <!-- Admission Details -->
                                <div class="row mb-5">
                                    <div class="col-12 mb-4">
                                        <h3 class="border-bottom border-primary pb-3 text-uppercase font-weight-900">
                                            <i class="fas fa-calendar-check mr-3 text-primary"></i><?php echo lang('admission_details'); ?>
                                        </h3>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group-lg">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('admission_time'); ?> <span class="text-danger">*</span></label>
                                            <div data-date="" class="input-group date form_datetime-meridian">
                                                <div class="input-group-btn">
                                                    <div type="button" class="btn-lg btn-primary date-set"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                <input type="text" class="form-control form-control-lg shadow-sm" readonly="" name="a_time" id="alloted_time" value='<?php
                                                                                                                                                                        if (!empty($allotment->a_time)) {
                                                                                                                                                                            echo $allotment->a_time;
                                                                                                                                                                        }
                                                                                                                                                                        ?>' required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('category'); ?></label>
                                            <div class="mt-2">
                                                <?php
                                                if (!empty($allotment->category_status)) {
                                                    $category_explode = explode(',', $allotment->category_status);
                                                }
                                                ?>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" id="urgent" name="category_status[]" value="urgent" <?php if (!empty($allotment->category_status)) {
                                                                                                                                                                if (in_array('urgent', $category_explode)) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                }
                                                                                                                                                            } ?>>
                                                    <label class="custom-control-label text-danger font-weight-bold" for="urgent"><?php echo lang('urgent'); ?></label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" id="planned" name="category_status[]" value="planned" <?php if (!empty($allotment->category_status)) {
                                                                                                                                                                    if (in_array('planned', $category_explode)) {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    }
                                                                                                                                                                } ?>>
                                                    <label class="custom-control-label text-success font-weight-bold" for="planned"><?php echo lang('planned'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bed Information -->
                                <div class="row mb-5">
                                    <div class="col-12 mb-4">
                                        <h3 class="border-bottom border-success pb-3 text-uppercase font-weight-900">
                                            <i class="fas fa-bed mr-3 text-success"></i><?php echo lang('bed_information'); ?>
                                        </h3>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('bed_category'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-lg shadow-sm" id="room_no" name="category" value='' required>
                                                <option><?php echo lang('select'); ?></option>
                                                <?php foreach ($room_no as $room) { ?>
                                                    <option value="<?php echo $room->category; ?>" <?php
                                                                                                    if (!empty($allotment->category)) {
                                                                                                        if ($allotment->category == $room->category) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>> <?php echo $room->category; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('bed_id'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-lg shadow-sm" id="bed_id" name="bed_id" value='' required>
                                                <option value="" disabled><?php echo lang('select'); ?></option>
                                                <?php if (!empty($allotment->bed_id)) {
                                                    echo $bed;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Patient & Doctor Information -->
                                <div class="row mb-5">
                                    <div class="col-12 mb-4">
                                        <h3 class="border-bottom border-danger pb-3 text-uppercase font-weight-900">
                                            <i class="fas fa-user-md mr-3 text-danger"></i><?php echo lang('patient_doctor_details'); ?>
                                        </h3>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('patient'); ?></label>
                                            <select class="form-control form-control-lg shadow-sm" id="patientchoose" name="patient" value=''>
                                                <?php if (!empty($allotment->patient)) { ?>
                                                    <option value="<?php echo $allotment->patient; ?>" selected>
                                                        <?php echo $this->db->get_where('patient', array('id' => $allotment->patient))->row()->name . '( Id: ' . $allotment->patient . ')'; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('blood_group'); ?></label>
                                            <select class="form-control form-control-lg shadow-sm" id="blood_group" name="blood_group" value=''>
                                                <option value=""></option>
                                                <?php foreach ($blood_group as $blood_group) { ?>
                                                    <option value="<?php echo $blood_group->id; ?>" <?php
                                                                                                    if (!empty($allotment->blood_group)) {
                                                                                                        if ($blood_group->id == $allotment->blood_group) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>><?php echo $blood_group->bloodgroup; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('doctor'); ?></label>
                                            <select class="form-control form-control-lg shadow-sm" id="doctors" name="doctor" value=''>
                                                <?php if (!empty($allotment->doctor)) { ?>
                                                    <option value="<?php echo $allotment->doctor; ?>" selected> <?php echo $this->db->get_where('doctor', array('id' => $allotment->doctor))->row()->name . '( Id: ' . $allotment->doctor . ')'; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('accepting_doctor'); ?></label>
                                            <select class="form-control form-control-lg shadow-sm" id="accepting_doctors" name="accepting_doctor" value=''>
                                                <?php if (!empty($allotment->accepting_doctor)) { ?>
                                                    <option value="<?php echo $allotment->accepting_doctor; ?>" selected> <?php echo $this->db->get_where('doctor', array('id' => $allotment->accepting_doctor))->row()->name . '( Id: ' . $allotment->accepting_doctor . ')'; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Medical Information -->
                                <div class="row mb-5">
                                    <div class="col-12 mb-4">
                                        <h3 class="border-bottom border-info pb-3 text-uppercase font-weight-900">
                                            <i class="fas fa-notes-medical mr-3 text-info"></i><?php echo lang('medical_information'); ?>
                                        </h3>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('diagnosis'); ?></label>
                                            <textarea name="diagnosis" class="form-control shadow-sm" rows="3"><?php
                                                                                                                if (!empty($allotment->diagnosis)) {
                                                                                                                    echo $allotment->diagnosis;
                                                                                                                }
                                                                                                                ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('diagnoza_a_shtrimit'); ?></label>
                                            <textarea name="diagnoza_a_shtrimit" class="form-control shadow-sm" rows="3"><?php
                                                                                                                            if (!empty($allotment->diagnoza_a_shtrimit)) {
                                                                                                                                echo $allotment->diagnoza_a_shtrimit;
                                                                                                                            }
                                                                                                                            ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('other_illnesses'); ?></label>
                                            <textarea name="other_illnesses" class="form-control shadow-sm" rows="3"><?php
                                                                                                                        if (!empty($allotment->other_illnesses)) {
                                                                                                                            echo $allotment->other_illnesses;
                                                                                                                        }
                                                                                                                        ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('anamneza'); ?></label>
                                            <textarea name="anamneza" class="form-control shadow-sm" rows="3"><?php
                                                                                                                if (!empty($allotment->anamneza)) {
                                                                                                                    echo $allotment->anamneza;
                                                                                                                }
                                                                                                                ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('reaksione'); ?></label>
                                            <textarea name="reaksione" class="form-control shadow-sm" rows="3"><?php
                                                                                                                if (!empty($allotment->reaksione)) {
                                                                                                                    echo $allotment->reaksione;
                                                                                                                }
                                                                                                                ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="text-uppercase font-weight-bold text-muted mb-2"><?php echo lang('transferred_from'); ?></label>
                                            <textarea name="transferred_from" class="form-control shadow-sm" rows="3"><?php
                                                                                                                        if (!empty($allotment->transferred_from)) {
                                                                                                                            echo $allotment->transferred_from;
                                                                                                                        }
                                                                                                                        ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($allotment->id)) {
                                                                            echo $allotment->id;
                                                                        }
                                                                        ?>'>

                                <?php if (empty($allotment->d_time)) { ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                                                <i class="fas fa-save mr-3"></i><?php echo lang('submit'); ?>
                                            </button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--main content end-->
<!--footer start-->
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/bed/add_allotment.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.form_datetime-meridian').datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            autoclose: true,
            todayBtn: true,
            showMeridian: true
        });
    });
</script>