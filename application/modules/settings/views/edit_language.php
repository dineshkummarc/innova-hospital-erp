<!--sidebar end-->
<!--main content start-->

<link href="common/extranal/css/settings/edit_language.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1> <?php
                            if ($languagename == 'arabic') {
                                $language = lang('arabic');
                            }
                            if ($languagename == 'english') {
                                $language = lang('english');
                            }
                            if ($languagename == 'italian') {
                                $language = lang('italian');
                            }
                            if ($languagename == 'french') {
                                $language = lang('french');
                            }

                            if ($languagename == 'spanish') {
                                $language = lang('spanish');
                            }
                            if ($languagename == 'portuguese') {
                                $language = lang('portuguese');
                            }
                            if ($languagename == 'turkish') {
                                $language = lang('turkish');
                            }

                            ?>
                        <?php echo lang('language'); ?> <?php echo lang('translation'); ?> : <?php echo $language; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php echo lang('language'); ?> <?php echo lang('translation'); ?></li>
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
                        <!-- <div class="card-header">
                            <h3 class="card-title">All the department names and related informations</h3>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <section class="col-md-10 row">
                                <div class="card-body">
                                    <div class="adv-table editable-table ">
                                        <div class="clearfix">
                                            <?php echo validation_errors(); ?>
                                            <form role="form" action="settings/addLanguageTranslation" class="clearfix" method="post" enctype="multipart/form-data" id="myForm">
                                                <input type="hidden" name="language" value="<?php echo $languagename; ?>">
                                                <input type="hidden" name="valueupdate" value="">
                                                <input type="hidden" name="indexupdate" value="">
                                                <table class="table table-bordered table-hover" id="editable-sample">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><?php echo lang('name'); ?></th>
                                                            <th><?php echo lang('translation'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        foreach ($languages as $key => $value) {
                                                            $i = $i + 1;
                                                        ?>
                                                            <tr class="table-bordered">
                                                                <td><?php echo $i; ?></td>
                                                                <td class="table-bordered">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control form-control-lg" name="index[]" id="index" value='<?php
                                                                                                                                                                    echo $key;
                                                                                                                                                                    ?>' placeholder="" readonly>
                                                                    </div>
                                                                </td>
                                                                <td class="table-bordered">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control form-control-lg" name="value[]" id="value" value="<?php
                                                                                                                                                                    echo $value;
                                                                                                                                                                    ?>" placeholder="">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td> <button id="submit" type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button></td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>




                                                    </tfoot>

                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>
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
<script src="common/extranal/js/settings/edit_language.js"></script>