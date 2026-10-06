<!--sidebar end-->
<!--main content start-->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
<style>
    @media print {
        @page {
            size: A4;
            margin: 50px;
        }

        body {
            padding: 0;
            margin-top: 100px;
        }

        .no-print {
            display: none;
        }

        .modal {
            position: relative;
            top: 0;
            left: 0;
            display: block;
            overflow: visible;
        }

        .modal-dialog {
            max-width: 100%;
            width: auto;
            margin: 0;
            padding: 0;
        }

        .modal-content {
            border: none;
            box-shadow: none;
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .modal-body {
            padding: 10px;
            page-break-inside: avoid;
            /* Prevent breaks within modal content */
        }

        .modal-header,
        .modal-footer {
            display: none;
        }

        body.modal-open {
            overflow: visible;
        }

        /* Ensure only one page is displayed in print view */
        @page {
            margin-bottom: 0;
            margin-left: 0;
            margin-right: 0;
            size: A4;
            orphans: 1;
            /* Ensure only one page is displayed in print view */
        }

        /* Additional styles to ensure only one page is displayed */
        body {
            page-break-inside: avoid;
            /* Prevent breaks within body content */
        }

        .content-wrapper {
            page-break-inside: avoid;
            /* Prevent breaks within content wrapper */
        }
    }
</style>

<!-- <style>
    @media print {
        .modal {
            display: block; /* Ensure modal is displayed */
            position: relative; /* Position relative for printing */
        }
        .modal-dialog {
            width: 100%; /* Full width for printing */
            margin: 0; /* Remove margin */
        }
        .modal-content {
            border: none; /* Remove border */
            box-shadow: none; /* Remove shadow */
        }
        .no-print {
            display: none; /* Hide elements that should not print */
        }
    }
</style> -->
<div class="modal fade" id="caseModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('case'); ?> <?php echo lang('details'); ?></h4>
                <button type="button" class="close no-print" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                    <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered">
                            <tr>
                                <td><label for="exampleInputEmail1"><?php echo lang('case'); ?> <?php echo lang('creation'); ?> <?php echo lang('date'); ?></label></td>
                                <td class="case_date"></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('patient'); ?></td>
                                <td class="case_patient"></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('patient_id'); ?></td>
                                <td class="case_patient_id"></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('doctor'); ?></td>
                                <td class="case_doctor"></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('title'); ?></td>
                                <td class="case_title"></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('symptom'); ?></td>
                                <td class="case_symptom"></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('lab_test'); ?></td>
                                <td class="case_test"></td>
                            </tr>

                            <tr>
                                <td><?php echo lang('diagnosis'); ?></td>
                                <td class="case_diagnosis"></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('treatment'); ?></td>
                                <td class="case_treatment"></td>
                                </tr>
                            <tr>
                                <td><?php echo lang('advice'); ?></td>
                                <td class="case_advice"></td>
                            </tr>

                            <tr>
                                <td><?php echo lang('history'); ?></td>
                                <td class="case_details"></td>
                            </tr>
                        </table>
<br>
                    <div class="col-md-9">
                        <h5 class="float-right">
                            <?php echo $settings->title . '<br>' . $settings->address; ?>
                        </h5>
                    </div>

                    <div class="col-md-3 no-print">
                        <a class="btn btn-info invoice_button float-right" onclick="printModal()"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                    </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- <link href="common/extranal/css/patient/case_list.css" rel="stylesheet"> -->


<div class="content-wrapper bg-gradient-light no-print" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-file-medical text-primary mr-3"></i>
                        <?php echo lang('cases'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="patient"><?php echo lang('patient'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('cases'); ?></li>
                        </ol>
                    </nav>
                </div>
                <!-- <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('case'); ?>
                    </a>
                </div> -->
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title text-white font-weight-bold"><?php echo lang('add_new'); ?> <?php echo lang('case'); ?></h3>
                        </div>
                        <div class="card-body bg-light p-4">
                            <form role="form" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('date'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg shadow-sm default-date-picker" name="date" required="">
                                </div>

                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('patient'); ?> <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg shadow-sm" id="patientchoose" name="patient_id" required="">
                                    </select>
                                </div>
                                <?php if ($this->ion_auth->in_group(array('Doctor'))) { 
                                    $current_user = $this->ion_auth->get_user_id();
                                    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id; ?>
                                    <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>" >
                                <?php }else{ ?>
                                    <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('doctor'); ?> <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg shadow-sm" id="doctorchoose" name="doctor_id" required="">
                                    </select>
                                </div>

                                    <?php } ?>

                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('title'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg shadow-sm" name="title" required="">
                                </div>

                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('symptom'); ?></label>
                                    <div class="input-group">
                                        <select class="form-control form-control-lg shadow-sm" multiple id="symptomchoose" name="symptom_id[]">
                                        </select>
                                        <div class="input-group-append">
                                            <a data-toggle="modal" href="#mySymptomModal" class="btn btn-success"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('lab_test'); ?></label>
                                    <select class="form-control form-control-lg shadow-sm" multiple id="testchoose" name="test_id[]">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('diagnosis'); ?></label>
                                    <div class="input-group">
                                        <select class="form-control form-control-lg shadow-sm" multiple id="diagnosischoose" name="diagnosis_id[]">
                                        </select>
                                        <div class="input-group-append">
                                            <a data-toggle="modal" href="#myDiagnosisModal" class="btn btn-warning"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('treatment'); ?></label>
                                    <div class="input-group">
                                        <select class="form-control form-control-lg shadow-sm" multiple id="treatmentchoose" name="treatment_id[]">
                                        </select>
                                        <div class="input-group-append">
                                            <a data-toggle="modal" href="#myTreatmentModal" class="btn btn-success"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('advice'); ?></label>
                                    <div class="input-group">
                                        <select class="form-control form-control-lg shadow-sm" multiple id="advicechoose" name="advice_id[]">
                                        </select>
                                        <div class="input-group-append">
                                            <a data-toggle="modal" href="#myAdviceModal" class="btn btn-success"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('history'); ?> <span class="text-danger">*</span></label>
                                    <textarea class="form-control ckeditor" name="description" id="editor1" rows="10"></textarea>
                                </div>

                                <input type="hidden" name="redirect" value='patient/caseList'>

                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block shadow-lg py-3">
                                    <i class="fas fa-save mr-3"></i><?php echo lang('submit'); ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title text-white font-weight-bold"><?php echo lang('cases'); ?></h3>
                        </div>
                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold"><?php echo lang('date'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('case'); ?> <?php echo lang('title'); ?></th>
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













<!--main content end-->
<!--footer start-->






<!-- Add Case Modal-->
<div class="modal fade no-print" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_medical_history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addMedicalHistory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('date'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" value='' placeholder="" readonly="" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('patient'); ?> &ast;</label>
                            <select class="form-control m-bot15 js-example-basic-single" name="patient_id" value='' required="">
                                <?php foreach ($patients as $patient) { ?>
                                    <option value="<?php echo $patient->id; ?>"> <?php echo $patient->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('title'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-inline input-medium" name="title" value='' placeholder="" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class=""><?php echo lang('description'); ?> &ast;</label>
                            <textarea class="ckeditor form-control" name="description" value="" rows="10" required></textarea>
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
<!-- Add Case Modal-->

<!-- Edit Case Modal-->
<div class="modal fade no-print" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('edit_medical_history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="medical_historyEditForm" class="clearfix" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &ast;</label>
                        <select class="form-control m-bot15 patient" id="patientchoose1" name="patient_id" value='' required="">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" name="title" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('symptom'); ?> &ast;</label>
                        <select class="form-control m-bot15 patient" multiple id="symptomchoose1" name="symptom_id[]" value=''>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('lab_test'); ?> &ast;</label>
                        <select class="form-control m-bot15 patient" multiple id="testchoose1" name="test_id[]" value=''>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('diagnosis'); ?> &ast;</label>
                        <select class="form-control m-bot15 patient" multiple id="diagnosischoose1" name="diagnosis_id[]" value=''>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('treatment'); ?> &ast;</label>
                        <select class="form-control m-bot15 patient" multiple id="treatmentchoose1" name="treatment_id[]" value=''>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('advice'); ?> &ast;</label>
                        <select class="form-control m-bot15 patient" multiple id="advicechoose1" name="advice_id[]" value=''>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo lang('history'); ?> &ast;</label>
                        <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="redirect" value='patient/caseList'>
                    <div class="no-print">
                        <button type="submit" name="submit" class="btn btn-info submit_button float-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<!-- Chat with GPT-->
<div class="modal fade no-print" id="gptModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('gpt_button'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addMedicalHistory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">


                        <div class="form-group col-md-12" id="answer">


                        </div>
                        <div class="form-group col-md-12">
                            <!-- <label class=""><?php echo lang('chat'); ?> &ast;</label> -->
                            <textarea class="ckeditor form-control" name="description" value="" rows="10" required></textarea>
                        </div>
                        <input type="hidden" name="id" value=''>
                        <input type="hidden" name="redirect" value='patient/caseList'>
                        <section class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-info submit_button float-right"> <?php echo lang('send'); ?> <?php echo lang('chat'); ?></button>
                        </section>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Chat with GPT-->



<div class="modal fade no-print" id="mySymptomModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_symptom'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" id="name" name="name" value='' placeholder="" required>
                    </div>
                    <section class="col-md-12">
                        <div id="addSymptom" class="btn btn-info submit_button float-right">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span id="button-text"><?php echo lang('submit'); ?></span>
                        </div>
                    </section>

                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade no-print" id="myTestModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_test'); ?></h4>
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
                        <div id="addTest" class="btn btn-info submit_button float-right">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span id="button-text"><?php echo lang('submit'); ?></span>
                        </div>
                    </section>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade no-print" id="myDiagnosisModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_diagnosis'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="form-group d-flex">
                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('disease'); ?> <?php echo lang('name'); ?> </label>
                    <input type="text" class="form-control col-sm-9" name="name" id="name2" value='' placeholder="" required>
                </div>
                <div class="form-group d-flex">
                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('icd 10'); ?> <?php echo lang('code'); ?></label>
                    <input type="text" class="form-control col-sm-9" name="code" id="code" value='' placeholder="" required>
                </div>
                <div class="form-group d-flex">
                    <label for="exampleInputEmail1" class="col-sm-3"><?php echo lang('description'); ?> </label>
                    <textarea class="form-control col-sm-9 ckeditor" id="editor2" name="description" value="" rows="10" cols="20"></textarea>


                </div>
                <div class="form-group d-flex disease_div">
                    <input type="checkbox" name="disease_with_outbreak_potential" value="1" id="disease_with_outbreak_potential" class="disease_with_outbreak_potential">
                    <label for="exampleInputEmail1" class=""> <?php echo lang('Disease With Outbreak Potential'); ?> </label>
                </div>
                <div id="maximum">
                    <div class="form-group d-flex">
                        <label for="exampleInputEmail1" class="col-sm-3"> <?php echo lang('Maximum Expected Number Of Patient In A Week'); ?></label>
                        <input type="number" class="form-control col-sm-9" name="maximum_expected_number_of_patient_in_a_week" id="maximum_expected_number_of_patient_in_a_week" value='' placeholder="">
                    </div>
                </div>
                <section class="col-md-12">
                    <div id="addDiagnosis" class="btn btn-info submit_button float-right">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                        <span id="button-text"><?php echo lang('submit'); ?></span>
                    </div>
                </section>


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade no-print" id="myTreatmentModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_treatment'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" id="name3" name="name" value='' placeholder="" required>
                    </div>
                    <section class="col-md-12">
                        <div id="addTreatment" class="btn btn-info submit_button float-right">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                            <span id="button-text"><?php echo lang('submit'); ?></span>
                        </div>
                    </section>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade no-print" id="myAdviceModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_advice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="col-sm-4"><?php echo lang('name'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-inline input-medium" id="name1" name="name" value='' placeholder="" required>
                    </div>
                    <section class="col-md-12">
                        <div id="addAdvice" class="btn btn-info submit_button float-right">
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
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
 var select_doctor = "<?php echo lang('select_doctor'); ?>";
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
<script src="common/extranal/js/patient/case_list.js"></script>




<script>
    $(document).ready(function() {
        $(".table").on("click", ".gptButton", function() {
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
                        formattedHistory += '</br><div><strong>' + role + ':</strong> ' + content + '</div>';
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
<script>
    function printModal() {
        $('#caseModal').modal('show');
        setTimeout(function() {
            window.print();
        }, 500);
    }
</script>