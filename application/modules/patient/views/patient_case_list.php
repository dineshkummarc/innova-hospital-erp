<!--sidebar end-->
<!--main content start-->

<link href="common/extranal/css/patient/medical_history.css" rel="stylesheet">
<style>
    .editbutton {

        cursor: pointer;
        /* Adds pointer cursor */

    }
</style>
<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">

                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-folder-open mr-2"></i><?php echo lang('patient'); ?> <?php echo lang('cases'); ?> <?php echo lang('info'); ?>
                    </h1>
                    <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                        <div class="mt-3">
                            <select class="custom-select pos_select" id="pos_select_patient" name="patient_id" style="font-weight:300 !important;">
                                <option value="<?php echo $patient->id; ?>" selected>
                                    <?php echo  $patient->name . ' (' . lang('id') . ': ' . $patient->id . ' - ' . lang('phone') . ': ' . $patient->phone . ' - ' . lang('age') . ': ' . explode('-', $patient->age)[0] . ' ' . lang('years'); ?>
                                </option>
                            </select>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="patient"><?php echo lang('patient'); ?></a></li>
                        <li class="breadcrumb-item active"> <?php echo lang('patient'); ?> <?php echo lang('info'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <!-- Patient Basic Info - Left Side -->
                                <div class="col-md-6">
                                    <div class="patient-info p-3 bg-light rounded">
                                        <h2 class="patient-name text-primary mb-2">
                                            <?php echo $patient->name; ?>
                                        </h2>
                                        <p class="patient-email text-muted">
                                            <i class="fas fa-envelope mr-2"></i>
                                            <?php echo $patient->email; ?>
                                        </p>
                                    </div>
                                </div>

                                <!-- Patient Details - Right Side -->
                                <div class="col-md-6 text-right">
                                    <div class="patient-details p-3 bg-light rounded">
                                        <ul class="list-unstyled">
                                            <li class="detail-item mb-3">
                                                <span class="detail-label text-muted mr-2"><?php echo lang('patient_id'); ?></span>
                                                <span class="badge badge-info px-3 py-2">#<?php echo $patient->id; ?></span>
                                            </li>
                                            <li class="detail-item mb-3">
                                                <span class="detail-label text-muted mr-2"><?php echo lang('gender'); ?></span>
                                                <span class="badge badge-primary px-3 py-2"><?php echo $patient->sex; ?></span>
                                            </li>
                                            <li class="detail-item mb-3">
                                                <span class="detail-label text-muted mr-2"><?php echo lang('birth_date'); ?></span>
                                                <span class="badge badge-success px-3 py-2"><?php echo $patient->birthdate; ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>









                    <!-- /.card -->
                </div>

                <div class="col-md-6">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <section class="">



                                <section class="card-body">



                                    <table class="table table-bordered table-hover text-md" id="editable-sample1">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo lang('title'); ?></th>
                                                <th><?php echo lang('case'); ?></th>
                                                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($medical_histories as $medical_history) {
                                                $options4 = ' <a style="background: #88A788; border: #88A788" type="button" class="btn btn-success btn-sm gptButton" title="' . lang('gpt_button') . '" data-toggle="modal" data-description="' . $medical_history->description . '" data-id="' . $medical_history->id . '"><i class="far fa-comment"></i></a>';

                                            ?>
                                                <tr class="editbutton" title="Click to see details" data-id="<?php echo $medical_history->id; ?>">
                                                    <div class="">
                                                        <td><?php echo date('d-m-Y', $medical_history->date); ?></td>
                                                        <td><?php echo $medical_history->title; ?></td>
                                                        <td><?php echo $medical_history->description; ?></td>
                                                    </div>
                                                    <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                        <td class="no-print">
                                                            <!-- <a class="btn btn-sm btn-primary" title="<?php echo lang('view'); ?>" href="patient/patientCaseList?id=<?php echo $medical_history->patient_id; ?>&case_id=<?php echo $medical_history->id; ?>"><i class="fa fa-eye"></i> </a> -->
                                                            <!-- <button type="button" class="btn btn-sm btn-primary editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $medical_history->id; ?>"><i class="fa fa-edit"></i> </button> -->
                                                            <a class="btn btn-sm btn-danger" title="<?php echo lang('delete'); ?>" href="patient/deleteCaseHistory?id=<?php echo $medical_history->id; ?>&redirect=patient " onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                                            <?php echo $options4 ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>












                                </section>

                            </section>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <style>
                    .btnn {
                        margin-left: 10px;
                        background: white;
                        color: black;
                        border: 1px solid #cfcfcf;
                        padding: 9px;
                    }

                    .btnn:hover {
                        margin-left: 10px;
                        background: white;
                        color: black;
                        border: 1px solid #cfcfcf;
                        padding: 9px;
                    }

                    .btnn:focus,
                    .btnn:active {
                        margin-left: 10px;
                        background: white;
                        color: black;
                        border: 1px solid #cfcfcf;
                        padding: 9px;
                    }
                </style>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><span class="case_idd text-xl"><?php
                                                                                    if (!empty($case->id)) {
                                                                                        echo "Case No # " . $case->id;
                                                                                    } else {
                                                                                        echo "Add a new case";
                                                                                    }
                                                                                    ?></span> </h3>
                            <div class="float-right">

                                <button id="addNew" class="btn btn-success btn-sm add_new">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                </button>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row"> <!-- Added row class here -->
                                <form role="form" action="patient/addMedicalHistory" id="medical_historyEditForm" class="clearfix w-100" method="post" enctype="multipart/form-data">
                                    <div class="">
                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('date'); ?> &ast;</label>
                                            <input type="text" class="form-control form-control-lg default-date-picker" id="case_date" name="date" placeholder="" autocomplete="off" required="" value='<?php
                                                                                                                                                                                                        if (!empty($case->id)) {
                                                                                                                                                                                                            echo date('d-m-Y', $case->date);
                                                                                                                                                                                                        }
                                                                                                                                                                                                        ?>'>
                                        </div>

                                        <input type="hidden" name="patient_id" value="<?php echo $patient->id; ?>">
                                        <!-- <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('patient'); ?> &ast;</label>
                                            <select class="form-control form-control-lg m-bot15" id="patientchoose" name="patient_id" required="">
                                            </select>
                                        </div> -->

                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('title'); ?> &ast;</label>
                                            <input type="text" class="form-control form-control-lg" id="case_title" name="title" placeholder="" required="" value="<?php
                                                                                                                                                                    if (!empty($case->id)) {
                                                                                                                                                                        echo $case->title;
                                                                                                                                                                    }
                                                                                                                                                                    ?>">
                                        </div>

                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('symptom'); ?> </label>
                                            <select class="form-control form-control-lg m-bot15 col-sm-7" multiple id="symptomchoose1" name="symptom_id[]">
                                                <?php if (!empty($case->id)) { ?>
                                                    <option><?php echo lang('select'); ?></option>
                                                    <?php foreach ($symptoms as $symptom) {
                                                        $symptom_ids = explode(',', $case->symptom_id); ?>
                                                        <option value="<?php echo $symptom->id; ?>"
                                                            <?php if (in_array($symptom->id, $symptom_ids)) {
                                                                echo 'selected';
                                                            } ?>>
                                                            <?php echo $symptom->name; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <a data-toggle="modal" href="#mySymptomModal" class="btn btn-success col-sm-1 btnn"> <i class="fa fa-plus"></i> </a>
                                        </div>

                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('lab_test'); ?> </label>
                                            <select class="form-control form-control-lg m-bot15 col-sm-7" multiple id="testchoose1" name="test_id[]">
                                                <?php if (!empty($case->id)) { ?>
                                                    <option><?php echo lang('select'); ?></option>
                                                    <?php foreach ($tests as $test) {
                                                        $test_ids = explode(',', $case->test_id); ?>
                                                        <option value="<?php echo $test->id; ?>"
                                                            <?php if (in_array($test->id, $test_ids)) {
                                                                echo 'selected';
                                                            } ?>>
                                                            <?php echo $test->category; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <!-- <a data-toggle="modal" href="#myTestModal" class="btn btn-success col-sm-1" style="margin-left: 10px;"> + </a> -->
                                        </div>

                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('diagnosis'); ?> </label>
                                            <select class="form-control form-control-lg m-bot15 col-sm-7" multiple id="diagnosischoose1" name="diagnosis_id[]">
                                                <?php if (!empty($case->id)) { ?>
                                                    <option><?php echo lang('select'); ?></option>
                                                    <?php foreach ($diagnosiss as $diagnosis) {
                                                        $diagnosis_ids = explode(',', $case->diagnosis_id); ?>
                                                        <option value="<?php echo $diagnosis->id; ?>"
                                                            <?php if (in_array($diagnosis->id, $diagnosis_ids)) {
                                                                echo 'selected';
                                                            } ?>>
                                                            <?php echo $diagnosis->name; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <a data-toggle="modal" href="#myDiagnosisModal" class="btn btn-success col-sm-1 btnn" style="margin-left: 10px;"> <i class="fa fa-plus"></i> </a>
                                        </div>
                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('treatment'); ?> </label>
                                            <select class="form-control form-control-lg m-bot15 col-sm-7" multiple id="treatmentchoose1" name="treatment_id[]">
                                                <?php if (!empty($case->id)) { ?>
                                                    <option><?php echo lang('select'); ?></option>
                                                    <?php foreach ($treatments as $treatment) {
                                                        $treatment_ids = explode(',', $case->treatment_id); ?>
                                                        <option value="<?php echo $treatment->id; ?>"
                                                            <?php if (in_array($treatment->id, $treatment_ids)) {
                                                                echo 'selected';
                                                            } ?>>
                                                            <?php echo $treatment->name; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <a data-toggle="modal" href="#myTreatmentModal" class="btn btn-success col-sm-1 btnn" style="margin-left: 10px;"> <i class="fa fa-plus"></i> </a>
                                        </div>

                                        <div class="form-group d-flex">
                                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('advice'); ?> </label>
                                            <select class="form-control form-control-lg m-bot15 col-sm-7" multiple id="advicechoose1" name="advice_id[]">
                                                <?php if (!empty($case->id)) { ?>
                                                    <option><?php echo lang('select'); ?></option>
                                                    <?php foreach ($advices as $advice) {
                                                        $advice_ids = explode(',', $case->advice_id); ?>
                                                        <option value="<?php echo $advice->id; ?>"
                                                            <?php if (in_array($advice->id, $advice_ids)) {
                                                                echo 'selected';
                                                            } ?>>
                                                            <?php echo $advice->name; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <a data-toggle="modal" href="#myAdviceModal" class="btn btn-success col-sm-1 btnn" style="margin-left: 10px;"> <i class="fa fa-plus"></i> </a>
                                        </div>

                                        <div class="form-group no-print">
                                            <label class="col-sm-4"><?php echo lang('history'); ?> &ast;</label>
                                            <textarea class="form-control ckeditor description" name="description" id="editor" rows="10">
                                            <?php
                                            if (!empty($case->id)) {
                                                echo $case->description;
                                            }
                                            ?>
                                            </textarea>
                                        </div>
                                        <input type="hidden" id="case_id" name="id" value="<?php
                                                                                            if (!empty($case->id)) {
                                                                                                echo $case->id;
                                                                                            }
                                                                                            ?>">
                                        <input type="hidden" name="redirect" value='patientcase'>
                                        <section class="col-md-12 no-print">
                                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>


<!-- Chat with GPT-->
<div class="modal fade" id="gptModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('gpt_button'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addMedicalHistory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">


                        <div class="form-group col-md-12" id="answer">


                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-sm-3"><?php echo lang('message'); ?> &ast;</label>
                            <textarea class="ckeditor form-control col-sm-9" name="description" value="" rows="10" required></textarea>
                        </div>
                        <input type="hidden" name="id" value=''>
                        <input type="hidden" name="redirect" value='patient/caseList'>
                        <section class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-info submit_button float-right"> <?php echo lang('submit'); ?></button>
                        </section>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Chat with GPT-->
<div class="modal fade" id="mySymptomModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_new_symptom'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" id="name" name="name" value='' placeholder="" required>
                    </div>
                    <section class="col-md-12">
                        <div id="addSymptom1" class="btn btn-info submit_button float-right">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span id="button-text"><?php echo lang('submit'); ?></span>
                        </div>
                    </section>

                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myTestModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_new_test'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" id="category" name="category" value='' placeholder="" required>
                    </div>
                    <input type="hidden" name="type" id="type" value="diagnostic">
                    <section class="col-md-12">
                        <div id="addTest1" class="btn btn-info submit_button float-right">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span id="button-text"><?php echo lang('submit'); ?></span>
                        </div>
                    </section>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myDiagnosisModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_diagnosis'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">


                <div class="form-group d-flex">
                    <label for="exampleInputEmail1"><?php echo lang('disease'); ?> <?php echo lang('name'); ?> </label>
                    <input type="text" class="form-control col-sm-9" name="name" id="name2" value='' placeholder="" required>
                </div>
                <div class="form-group d-flex">
                    <label for="exampleInputEmail1"><?php echo lang('icd 10'); ?> <?php echo lang('code'); ?></label>
                    <input type="text" class="form-control col-sm-9" name="code" id="code" value='' placeholder="" required>
                </div>
                <div class="form-group d-flex">
                    <label for="exampleInputEmail1"><?php echo lang('description'); ?> </label>
                    <textarea class="form-control col-sm-9 ckeditor" id="editor1" name="description" value="" rows="10" cols="20"></textarea>


                </div>
                <div class="form-group d-flex disease_div">
                    <input type="checkbox" name="disease_with_outbreak_potential" value="1" id="disease_with_outbreak_potential" class="disease_with_outbreak_potential">
                    <label for="exampleInputEmail1" class=""> <?php echo lang('Disease With Outbreak Potential'); ?> </label>
                </div>
                <div id="maximum">
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1"> <?php echo lang('Maximum Expected Number Of Patient In A Week'); ?></label>
                        <input type="number" class="form-control col-sm-9" name="maximum_expected_number_of_patient_in_a_week" id="maximum_expected_number_of_patient_in_a_week" value='' placeholder="">
                    </div>
                </div>


                <section class="col-md-12">
                    <div id="addDiagnosis1" class="btn btn-info submit_button float-right">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                        <span id="button-text"><?php echo lang('submit'); ?></span>
                    </div>
                </section>


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myTreatmentModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_new_treatment'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" id="name3" name="name" value='' placeholder="" required>
                    </div>
                    <section class="col-md-12">
                        <div id="addTreatment1" class="btn btn-info submit_button float-right">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span id="button-text"><?php echo lang('submit'); ?></span>
                        </div>
                    </section>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="myAdviceModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_new_advice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" id="name1" name="name" value='' placeholder="" required>
                    </div>
                    <section class="col-md-12">
                        <div id="addAdvice1" class="btn btn-info submit_button float-right">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span id="button-text"><?php echo lang('submit'); ?></span>
                        </div>
                    </section>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
    var select_diagnosis = "<?php echo lang('select_diagnosis'); ?>";
    var select_treatment = "<?php echo lang('select_treatment'); ?>";

    var select_advice = "<?php echo lang('select_advice'); ?>";
    var select_symptom = "<?php echo lang('select_symptom'); ?>";
    var select_test = "<?php echo lang('select_test'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<!-- <script src="common/extranal/js/patient/medical_history.js"></script> -->
<script src="common/extranal/js/patient/case_list.js"></script>

<script>
    $(document).ready(function() {
        $(".table").on("click", ".gptButton", function() {
            $("#loader").show();
            var id = $(this).attr('data-id');
            var des = $(this).attr('data-description');
            var description = des.replace(/<[^>]*>/g, ''); // Remove HTML tags


            $.ajax({
                type: "POST",
                url: "patient/getConversationHistoryAjax", // The new endpoint
                data: {
                    id: id
                },
                success: function(response) {
                    var history = JSON.parse(response).history; // Assuming the endpoint returns { history: [message1, message2, ...] }
                    var formattedHistory = '';
                    var toRemove = "You are a doctor. Advice according to the case described here. This is the case: ";
                    for (var i = 0; i < history.length; i++) {
                        // Assuming you have a role in each message to distinguish between user and GPT
                        var role = history[i].role === 'user' ? 'You' : 'GPT';
                        var content = history[i].content.replace(toRemove, '').trim();
                        formattedHistory += '<div><strong>' + role + ':</strong> ' + content + '</div>';
                    }
                    $('#answer').html(formattedHistory); // Display conversation history
                },
                error: function() {
                    $('#answer').html('<div class="alert alert-danger">Error fetching conversation history. Please try again later.</div>');
                }
            });



            $('#gptModal textarea[name="description"]').val(description);
            $('#gptModal input[name="id"]').val(id);
            $('#gptModal').modal('show');
            $('#answer').html(''); // Clear previous conversation
        });

        $('#gptModal form').on('submit', function(event) {
            event.preventDefault();
            var message = $(this).find('textarea[name="description"]').val();
            var id = $(this).find('input[name="id"]').val();
            $('#answer').append('<div><strong>You:</strong> ' + message + '</div>'); // Display user message

            $.ajax({
                type: "POST",
                url: "patient/chatWithGpt",
                data: {
                    id: id,
                    description: message
                },
                success: function(response) {
                    var parsedResponse = JSON.parse(response);
                    $('#answer').append('<div><strong>GPT:</strong> ' + parsedResponse.message + '</div>');
                },
                error: function() {
                    $('#answer').append('<div class="alert alert-danger">Error occurred. Please try again later.</div>');
                }
            });

            $(this).find('textarea[name="description"]').val(''); // Clear input after sending
        });
    });
</script>
<script>
    $(document).ready(function() {
        "use strict";
        var table = $('#editable-sample1').DataTable({
            responsive: true,


            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [1, 2, 3],
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [1, 2, 3],
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [1, 2, 3],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [1, 2, 3],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            "order": [
                [3, "desc"]
            ],
            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                "url": "common/assets/DataTables/languages/" + language + ".json"
            },

        });

        table.buttons().container()
            .appendTo('.custom_buttons');
    });
</script>