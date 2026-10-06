<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-concierge-bell text-primary mr-3"></i>
                        <?php echo lang('pservice'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('pservice'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?>
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
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('All the Patient service names and pricing for the In-Patient Department (IPD)'); ?></h3>
                        </div>
                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample1" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('no'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('service'); ?> <?php echo lang('code'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('alpha_code'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('service'); ?> <?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('price'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('active'); ?></th>
                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                            <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                        <?php } ?>
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





<!-- Add Pservice Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_pservice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="pservice/addNew" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($pservice->name)) {
                                                                                                                                echo $pservice->name;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('code'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="code" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($pservice->code)) {
                                                                                                                                echo $pservice->code;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1"> <?php echo lang('alpha_code'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="alpha_code" id="exampleInputEmail1" value='<?php
                                                                                                                                    if (!empty($pservice->alpha_code)) {
                                                                                                                                        echo $pservice->alpha_code;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1"> <?php echo lang('price'); ?></label>
                        <input type="text" class="form-control form-control-lg" min="0" name="price" id="exampleInputEmail1" value='<?php
                                                                                                                                    if (!empty($pservice->price)) {
                                                                                                                                        echo $pservice->price;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required="">
                    </div>


                    <div class="form-group col-md-6 d-flex">

                        <input type="checkbox" class="" name="active" id="exampleInputEmail1" value='1' <?php
                                                                                                        if (!empty($pservice->id)) {
                                                                                                            if ($pservice->active == "1") {
                                                                                                                echo "checked";
                                                                                                            }
                                                                                                        }
                                                                                                        ?>>
                        <label for="exampleInputEmail1"> <?php echo lang('active'); ?></label>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Pservice Modal-->







<!-- Edit Pservice Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_pservice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editPserviceForm" class="clearfix row" action="pservice/addNew" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($pservice->name)) {
                                                                                                                                echo $pservice->name;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('code'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="code" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($pservice->code)) {
                                                                                                                                echo $pservice->code;
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1"> <?php echo lang('alpha_code'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="alpha_code" id="exampleInputEmail1" value='<?php
                                                                                                                                    if (!empty($pservice->alpha_code)) {
                                                                                                                                        echo $pservice->alpha_code;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="">
                    </div>
                    <div class="form-group col-md-6 d-flex">
                        <label for="exampleInputEmail1"> <?php echo lang('price'); ?></label>
                        <input type="text" class="form-control form-control-lg" min="0" name="price" id="exampleInputEmail1" value='<?php
                                                                                                                                    if (!empty($pservice->price)) {
                                                                                                                                        echo $pservice->price;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required="">
                    </div>


                    <div class="form-group col-md-6 d-flex">

                        <input type="checkbox" class="" name="active" id="exampleInputEmail1" value='1' <?php
                                                                                                        if (!empty($pservice->id)) {
                                                                                                            if ($pservice->active == "1") {
                                                                                                                echo "checked";
                                                                                                            }
                                                                                                        }
                                                                                                        ?>>
                        <label for="exampleInputEmail1"> <?php echo lang('active'); ?></label>
                    </div>



                    <input type="hidden" name="id" value='<?php
                                                            if (!empty($pservice->id)) {
                                                                echo $pservice->id;
                                                            }
                                                            ?>'>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                    </div>
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

<script src="common/extranal/js/bed/patient_service.js"></script>