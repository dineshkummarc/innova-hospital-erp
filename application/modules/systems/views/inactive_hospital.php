<link href="common/extranal/css/systems/active_hospital.css" rel="stylesheet">


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-hospital-alt mr-2"></i><?php echo lang('inactive_hospitals') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('inactive_hospitals') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the inactive hospitals names and related informations'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('title'); ?></th>
                                        <th> <?php echo lang('email'); ?></th>
                                        <th> <?php echo lang('address'); ?></th>
                                        <th> <?php echo lang('phone'); ?></th>
                                        <th> <?php echo lang('next_renewal_date'); ?></th>
                                        <th> <?php echo lang('package'); ?></th>
                                        <th> <?php echo lang('status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    if (!empty($hospitals)) {
                                        for ($id = 0; $id < count($hospitals); $id++) {
                                    ?>
                                            <tr class="">
                                                <td> <?php echo $hospitals[$id]->name; ?></td>
                                                <td><?php echo $hospitals[$id]->email; ?></td>
                                                <td class="center"><?php echo $hospitals[$id]->address; ?></td>
                                                <td><?php echo $hospitals[$id]->phone; ?></td>
                                                <td><?php
                                                    $hospital_payment_details = $this->db->get_where('hospital_payment', array('hospital_user_id' => $hospitals[$id]->id))->row();
                                                    echo $hospital_payment_details->next_due_date;
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    if (!empty($hospitals[$id]->package)) {
                                                        echo $this->db->get_where('package', array('id' => $hospitals[$id]->package))->row()->name;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo lang('inactive'); ?>
                                                </td>

                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>

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

<script src="common/js/codearistos.min.js"></script>


<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/systems/systems.js"></script>