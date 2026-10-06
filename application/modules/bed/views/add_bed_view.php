<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-bed mr-3 text-primary"></i>
                        <?php
                        if (!empty($bed->id)) {
                            echo lang('edit_bed');
                        } else {
                            echo lang('add_bed');
                        }
                        ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home') ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php echo lang('department') ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-body bg-light p-5">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="bed/addBed" method="post" enctype="multipart/form-data">

                                <div class="form-group mb-4">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('bed_category'); ?> <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg shadow-sm" name="category" required="">
                                        <?php foreach ($categories as $category) { ?>
                                            <option value="<?php echo $category->category; ?>" <?php
                                                                                                if (!empty($setval)) {
                                                                                                    if ($category->category == set_value('category')) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                                if (!empty($bed->category)) {
                                                                                                    if ($category->category == $bed->category) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                                ?>><?php echo $category->category; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('bed_number'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg shadow-sm" name="number" value='<?php
                                                                                                                            if (!empty($setval)) {
                                                                                                                                echo set_value('number');
                                                                                                                            }
                                                                                                                            if (!empty($bed->number)) {
                                                                                                                                echo $bed->number;
                                                                                                                            }
                                                                                                                            ?>' required="">
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('description'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg shadow-sm" name="description" value='<?php
                                                                                                                                if (!empty($setval)) {
                                                                                                                                    echo set_value('description');
                                                                                                                                }
                                                                                                                                if (!empty($bed->description)) {
                                                                                                                                    echo $bed->description;
                                                                                                                                }
                                                                                                                                ?>' required="">
                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($bed->id)) {
                                                                            echo $bed->id;
                                                                        }
                                                                        ?>'>

                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                                    <i class="fas fa-check-circle mr-3"></i><?php echo lang('submit'); ?>
                                </button>

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