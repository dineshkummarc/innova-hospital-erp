<!--sidebar end-->
<!--main content start-->


<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
    $doctordetails = $this->db->get_where('doctor', array('id' => $doctor_id))->row();
}
?>


<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7">
            <header class="panel-heading">
                <?php
                if (!empty($testpkz->id))
                    echo lang('edit_testpkz');
                else
                    echo lang('add_testpkz');
                ?>

            </header>
            <div class="panel col-md-12">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="testpkz/addNewTestpkz" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="">


                                <div class="form-group">
                                    <label class="control-label"><?php echo lang('package'); ?> <?php echo lang('name'); ?></label>
                                    <input class="form-control form-control-lg" name="name" value="<?php
                                                                                                    if (!empty($setval)) {
                                                                                                        echo set_value('name');
                                                                                                    }
                                                                                                    if (!empty($testpkz->name)) {
                                                                                                        echo $testpkz->name;
                                                                                                    }
                                                                                                    ?>" required="" />
                                </div>







                                <div class="form-group">

                                    <label for="exampleInputEmail1"> <?php echo lang('package'); ?> <?php echo lang('item'); ?></label>




                                    <select class="form-control js-example-basic-single" multiple="multiple" id="" name="payment_category[]" value='' required>

                                        <option value=""><?php echo lang('select_item'); ?></option>
                                        <?php foreach ($payment_categories as $categories) { ?>
                                            <option value="<?php echo $categories->id; ?>" <?php
                                                                                            if (!empty($testpkz->id)) {
                                                                                                $payment_category = explode(',', $testpkz->payment_category);
                                                                                                foreach ($payment_category as $key => $value) {
                                                                                                    if ($categories->id == $value) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                            ?>>


                                                <?php echo $categories->category; ?>
                                            </option>
                                        <?php } ?>
                                    </select>


                                </div>



                                <input type="hidden" name="id" id="testpkz_id" value='<?php
                                                                                        if (!empty($testpkz->id)) {
                                                                                            echo $testpkz->id;
                                                                                        }
                                                                                        ?>'>



                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                                </div>
                            </div>

                            <div class="col-md-5">

                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->



<style>
    form {
        border: 0px;
    }

    .med_selected {
        background: #fff;
        padding: 10px 0px;
        margin: 5px;
    }


    .select2-container--bgform .select2-selection--multiple .select2-selection__choice {
        clear: both !important;
    }

    label {
        display: inline-block;
        margin-bottom: 5px;
        font-weight: 500;
        font-weight: bold;
    }

    .medicine_block {
        background: #f1f2f7;
        padding: 50px !important;
    }

    form input {
        text-align: left;
    }

    .medi_div {
        float: left !important;
    }
</style>


<script src="common/js/codearistos.min.js"></script>

<script>
    var myEditor;
    $(document).ready(function() {

        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });


    });
</script>