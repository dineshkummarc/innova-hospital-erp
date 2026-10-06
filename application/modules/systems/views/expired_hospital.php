<link href="common/extranal/css/systems/active_hospital.css" rel="stylesheet">



<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1><strong><i class="fas fa-hospital-alt"></i> <?php echo lang('license_expire_hospitals'); ?></strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('license_expire_hospitals') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the licence expired hospitals names and related informations'); ?></h3>
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
                                        <th> <?php echo lang('expired_on'); ?></th>
                                        <th> <?php echo lang('package'); ?></th>
                                        <th> <?php echo lang('status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    if (!empty($hospitalExpiredList)) {
                                        foreach ($hospitalExpiredList as $expired) {
                                            if ($expired->next_due_date_stamp < time()) {

                                                $hospital_details = $this->db->get_where('hospital', array('id' => $expired->hospital_user_id))->row();
                                                if (!empty($hospital_details)) {
                                    ?>
                                                    <tr class="">
                                                        <td> <?php echo $hospital_details->name; ?></td>
                                                        <td><?php echo $hospital_details->email; ?></td>
                                                        <td class="center"><?php echo $hospital_details->address; ?></td>
                                                        <td><?php echo $hospital_details->phone; ?></td>
                                                        <td><?php echo $expired->next_due_date; ?></td>
                                                        <td>
                                                            <?php
                                                            if (!empty($hospital_details->package)) {
                                                                echo $this->db->get_where('package', array('id' => $hospital_details->package))->row()->name;
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