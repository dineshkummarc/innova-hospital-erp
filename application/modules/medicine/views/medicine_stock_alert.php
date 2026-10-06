<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-exclamation-triangle text-warning mr-3"></i>
                        <?php echo lang('medicine'); ?> <?php echo lang('stock'); ?> <?php echo lang('alerts'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine"><?php echo lang('medicine'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('stock'); ?> <?php echo lang('alerts'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus mr-2"></i><?php echo lang('add'); ?> <?php echo lang('new'); ?> <?php echo lang('medicine'); ?>
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
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('medicines'); ?> <?php echo lang('with'); ?> <?php echo lang('low'); ?> <?php echo lang('stock'); ?> <?php echo lang('levels'); ?></h3>
                        </div>

                        <div class="card-body bg-light">
                            <table class="table table-hover" id="editable-sample">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('id'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('category'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('store'); ?> <?php echo lang('box'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('purchase'); ?> <?php echo lang('price'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('selling'); ?> <?php echo lang('price'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('quantity'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('generic'); ?> <?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('company'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('effects'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('expiry'); ?> <?php echo lang('date'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($p_n)) {
                                        $i = $p_n * 50;
                                    } else {
                                        $i = 0;
                                    }
                                    foreach ($medicines as $medicine) {
                                        $i = $i + 1;
                                    ?>
                                        <tr>
                                            <td class="medici_name"><?php echo $i; ?></td>
                                            <td class="medici_name"><?php echo $medicine->name; ?></td>
                                            <td><?php echo $medicine->category; ?></td>
                                            <td><?php echo $medicine->box; ?></td>
                                            <td><?php echo $settings->currency; ?> <?php echo $medicine->price; ?></td>
                                            <td><?php echo $settings->currency; ?> <?php echo $medicine->s_price; ?></td>
                                            <td>
                                                <?php
                                                if ($medicine->quantity <= 0) {
                                                    echo '<p class="os">' . lang('stock_out') . '</p>';
                                                } else {
                                                    echo $medicine->quantity;
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $medicine->generic; ?></td>
                                            <td><?php echo $medicine->company; ?></td>
                                            <td><?php echo $medicine->effects; ?></td>
                                            <td><?php echo $medicine->e_date; ?></td>
                                            <td>
                                                <a type="button" class="btn btn-info btn-sm editbutton" data-toggle="modal" data-id="<?php echo $medicine->id; ?>"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" href="medicine/delete?id=<?php echo $medicine->id; ?>" onclick="return confirm('<?php echo lang('are_you_sure_you_want_to_delete_this_item'); ?>');"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add'); ?> <?php echo lang('medicine'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="medicine/addNewMedicine" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="name" value='' placeholder="" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('category'); ?> &ast;</label>
                            <select class="form-control col-sm-8 m-bot15" name="category" value='' required="">
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category->category; ?>" <?php
                                                                                        if (!empty($medicine->category)) {
                                                                                            if ($category->category == $medicine->category) {
                                                                                                echo 'selected';
                                                                                            }
                                                                                        }
                                                                                        ?>> <?php echo $category->category; ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('purchase'); ?> <?php echo lang('price'); ?> &ast; </label>
                            <input type="text" class="form-control form-control-lg" name="price" value='' placeholder="" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('selling'); ?> <?php echo lang('price'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="s_price" value='' placeholder="" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('generic'); ?> <?php echo lang('name'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="generic" value='' placeholder="" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="company" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="effects" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('store'); ?> <?php echo lang('box'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="box" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('expiry'); ?> <?php echo lang('date'); ?> &ast;</label>
                            <input type="text" class="form-control col-sm-8 default-date-picker readonly" name="e_date" value='' placeholder="" required="">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>








<!-- Edit Medicine Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit'); ?> <?php echo lang('medicine'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="editMedicineForm" class="clearfix" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="name" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('category'); ?></label>
                            <select class="form-control col-sm-8 m-bot15" name="category" value=''>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category->category; ?>" <?php
                                                                                        if (!empty($medicine->category)) {
                                                                                            if ($category->category == $medicine->category) {
                                                                                                echo 'selected';
                                                                                            }
                                                                                        }
                                                                                        ?>> <?php echo $category->category; ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('purchase'); ?> <?php echo lang('price'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="price" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('selling'); ?> <?php echo lang('price'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="s_price" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('generic'); ?> <?php echo lang('name'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="generic" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="company" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="effects" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('store'); ?> <?php echo lang('box'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="box" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('expiry'); ?> <?php echo lang('date'); ?></label>
                            <input type="text" class="form-control col-sm-8 default-date-picker" name="e_date" value='' placeholder="">
                        </div>
                        <input type="hidden" name="id" value=''>
                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/medicine/medicine_stock_alert.js"></script>