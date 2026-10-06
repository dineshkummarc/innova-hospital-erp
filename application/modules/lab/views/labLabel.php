<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-building mr-2"></i><?php echo lang('departments') ?></h1>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div>
                                <div>
                                    <table>
                                        <tr>
                                            <td>PID: <?php echo $patient->id; ?></td>
                                            <td>Invoice ID: <?php echo $lab->invoice_id; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Patient: <?php echo $patient->name; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <?php $age = explode('-', $patient->age);
                                            if (count($age) == 3) { ?>
                                                <td>Age: <?php echo $age[0] . " Y " . $age[1] . " M " . $age[2] . " D"; ?></td>
                                            <?php } else { ?>
                                                <td>Age: </td>
                                            <?php
                                            } ?>

                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Gender: <?php echo $patient->sex; ?></td>
                                            <td>Date: <?php echo date('d/m/Y', $lab->date) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ref By:</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Test: <?php
                                                                    $i = 0;
                                                                    foreach ($labels as $label) {
                                                                        if ($i == 0) {
                                                                            echo $this->db->get_where('payment_category', array('id' => $label->category_id))->row()->category;
                                                                            //echo $this->finance_model->getPaymentCategoryById($label->category_id);
                                                                        } else {
                                                                            echo ', ' . $this->db->get_where('payment_category', array('id' => $label->category_id))->row()->category;
                                                                        }
                                                                        $i++;
                                                                    }
                                                                    ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Film: <input type="text">
                                            </td>
                                            <td>
                                                Paper Print: <input type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: center">
                                                <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $patient->id; ?>&print=true" />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div>
                                    <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $lab->invoice_id; ?>&print=true&orientation=vertical" />
                                </div>
                            </div>
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












<div>
    <div>
        <table>
            <tr>
                <td>PID: <?php echo $patient->id; ?></td>
                <td>Invoice ID: <?php echo $lab->invoice_id; ?></td>
            </tr>
            <tr>
                <td>Patient: <?php echo $patient->name; ?></td>
                <td></td>
            </tr>
            <tr>
                <?php $age = explode('-', $patient->age);
                if (count($age) == 3) { ?>
                    <td>Age: <?php echo $age[0] . " Y " . $age[1] . " M " . $age[2] . " D"; ?></td>
                <?php } else { ?>
                    <td>Age: </td>
                <?php
                } ?>

                <td></td>
            </tr>
            <tr>
                <td>Gender: <?php echo $patient->sex; ?></td>
                <td>Date: <?php echo date('d/m/Y', $lab->date) ?></td>
            </tr>
            <tr>
                <td>Ref By:</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">Test: <?php
                                        $i = 0;
                                        foreach ($labels as $label) {
                                            if ($i == 0) {
                                                echo $this->db->get_where('payment_category', array('id' => $label->category_id))->row()->category;
                                                //echo $this->finance_model->getPaymentCategoryById($label->category_id);
                                            } else {
                                                echo ', ' . $this->db->get_where('payment_category', array('id' => $label->category_id))->row()->category;
                                            }
                                            $i++;
                                        }
                                        ?></td>
            </tr>
            <tr>
                <td>
                    Film: <input type="text">
                </td>
                <td>
                    Paper Print: <input type="text">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">
                    <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $patient->id; ?>&print=true" />
                </td>
            </tr>
        </table>
    </div>
    <div>
        <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $lab->invoice_id; ?>&print=true&orientation=vertical" />
    </div>
</div>