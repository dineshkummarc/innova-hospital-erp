<!--sidebar end-->
<!--main content start-->

<link href="common/extranal/css/patient/my_case_list.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-folder-open mr-2"></i><?php echo lang('my'); ?> <?php echo lang('cases'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('department') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the case history details'); ?></h3>
                            <!-- <div class="float-right">
                                <a data-toggle="modal" href="#myModal">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                    </button>
                                </a>
                            </div> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th class="id_table"><?php echo lang('id'); ?></th>
                                        <th class="id_table1"><?php echo lang('case'); ?> <?php echo lang('title'); ?></th>
                                        <th class="id_table2"><?php echo lang('case'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($medical_histories as $medical_history) { ?>
                                        <?php $patient_info = $this->db->get_where('patient', array('id' => $medical_history->patient_id))->row(); ?>

                                        <tr class="">

                                            <td>
                                                <?php
                                                echo $medical_history->id;
                                                ?>
                                            </td>

                                            <td>
                                                <?php
                                                echo $medical_history->title;
                                                ?>
                                            </td>

                                            <td><?php
                                                if (!empty($medical_history->description)) {
                                                    echo $medical_history->description;
                                                }
                                                ?></td>

                                        </tr>
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


<!--main content end-->
<!--footer start-->





<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/patient/my_case_list.js"></script>