 <link href="common/extranal/css/email/superadmin_sendview.css" rel="stylesheet">




 <div class="content-wrapper bg-light">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row my-2 pl-1">
                 <div class="col-sm-6">
                     <h1 class="font-weight-bold"><i class="fas fa-envelope mr-2"></i> <?php echo lang('send_email'); ?></h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                         <li class="breadcrumb-item active"><?php echo lang('send_email'); ?></li>
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
                             <h3 class="card-title"><?php echo lang('Send email to the recipients'); ?></h3>

                             <div class="float-right mr-2">
                                 <a href="email/sent">
                                     <button id="" class="btn btn-success btn-sm">
                                         <?php echo lang('sent_messages'); ?>
                                     </button>
                                 </a>
                             </div>
                             <div class="float-right mr-2">
                                 <a href="email/manualEmailTemplate">
                                     <button id="" class="btn btn-secondary btn-sm">
                                         <?php echo lang('template'); ?>
                                     </button>
                                 </a>
                             </div>

                             <div class="float-right mr-2">
                                 <a data-toggle="modal" href="#myModal1">
                                     <button id="" class="btn btn-info btn-sm">
                                         <i class="fa fa-plus-circle"></i> <?php echo lang('add'); ?> <?php echo lang('template'); ?>
                                     </button>
                                 </a>
                             </div>

                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <form role="form" class="clearfix" action="email/superadminSend" method="post">
                                 <label class="control-label">
                                     <?php echo lang('send_email_to'); ?>
                                 </label>
                                 <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
                                     <div class="radio radio_button">
                                         <label>
                                             <input type="radio" name="radio" id="optionsRadios1" value="allhospital">
                                             <?php echo lang('all_hospital'); ?>
                                         </label>
                                     </div>

                                 <?php } ?>


                                 <div class="radio radio_button">
                                     <label>
                                         <input type="radio" name="radio" id="optionsRadios2" value="single_hospital">
                                         <?php echo lang('single_hospital'); ?>
                                     </label>
                                 </div>

                                 <div class="radio single_hospital radio_button">
                                     <label>
                                         <?php echo lang('select_hospital'); ?>
                                         <select class="form-control form-control-lg m-bot15" id="patientchoose" name="hospital" value=''>

                                         </select>
                                     </label>

                                 </div>

                                 <div class="radio radio_button">
                                     <label>
                                         <input type="radio" name="radio" id="optionsRadios2" value="other">
                                         <?php echo lang('others'); ?>
                                     </label>
                                 </div>

                                 <div class="radio other">
                                     <label>
                                         <?php echo lang('email'); ?> <?php echo lang('address'); ?>
                                         <input type="email" name="other_email" value="" class="form-control form-control-lg">
                                     </label>

                                 </div>

                                 <div class="">
                                     <label>
                                         <?php echo lang('select_template'); ?>
                                         <select class="form-control form-control-lg m-bot15" id='selUser5' name="templatess">
                                             <!-- <option value='0'><?php echo lang('select_template'); ?></option>-->
                                         </select>
                                     </label>

                                 </div>


                                 <div class="form-group">
                                     <label class="control-label"><?php echo lang('subject'); ?></label>
                                     <input type="text" class="form-control form-control-lg" name="subject" rows="10">
                                 </div>

                                 <div class="form-group">
    <label class="control-label"><?php echo lang('message'); ?></label>
    <div class="d-flex flex-wrap">
        <?php
        $count = 0;
        foreach ($shortcode as $shortcodes) {
        ?>
            <input type="button" class="btn btn-secondary m-1" name="myBtn" value="<?php echo $shortcodes->name; ?>" onClick="addtext(this);">
            <?php
            $count += 1;
            if ($count === 7) {
            ?>
                <br>
        <?php
            }
        }
        ?>
    </div>
    <br><br>
    <textarea class="ckeditor form-control" id="editor1" name="message" cols="70" rows="10"></textarea>
</div>
                                 <input type="hidden" name="id" value=''>

                                 <div class="form-group col-md-12">
                                     <button type="submit" name="submit" class="btn btn-info col-md-3 float-right"><i class="fa fa-location-arrow"></i> <?php echo lang('send_email'); ?></button>
                                 </div>

                             </form>
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







 <div class="modal fade" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title font-weight-bold"><?php echo lang('add_new'); ?> <?php echo lang('template'); ?></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
             </div>
             <div class="modal-body">
                 <?php echo validation_errors(); ?>
                 <form role="form" name="myform1" action="email/addNewManualTemplate" method="post" enctype="multipart/form-data">

                     <div class="form-group">
                         <label for="exampleInputEmail1"> <?php echo lang('templatename'); ?></label>
                         <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                            if (!empty($templatename->name)) {
                                                                                                                                echo $templatename->name;
                                                                                                                            }
                                                                                                                            if (!empty($setval)) {
                                                                                                                                echo set_value('name');
                                                                                                                            }
                                                                                                                            ?>' placeholder="" required>
                     </div>
                     <div class="form-group">
                         <label for="exampleInputEmail1"> <?php echo lang('message'); ?> <?php echo lang('template'); ?></label><br>
                         <?php
                            $count1 = 0;
                            foreach ($shortcode as $shortcodes) {
                            ?>
                             <input type="button" name="myBtn" value="<?php echo $shortcodes->name; ?>" onClick="addtext1(this);">
                             <?php
                                $count1 += 1;
                                if ($count1 === 7) {
                                ?>
                                 <br>
                         <?php
                                }
                            }
                            ?> <br><br>

                         <textarea class="ckeditor" id="editor2" name="message" value='<?php
                                                                                        if (!empty($templatename->message)) {
                                                                                            echo $templatename->message;
                                                                                        }
                                                                                        if (!empty($setval)) {
                                                                                            echo set_value('message');
                                                                                        }
                                                                                        ?>' cols="70" rows="10" placeholder="" required> <?php
                                                                                                                                            if (!empty($templatename->message)) {
                                                                                                                                                echo $templatename->message;
                                                                                                                                            }
                                                                                                                                            if (!empty($setval)) {
                                                                                                                                                echo set_value('message');
                                                                                                                                            }
                                                                                                                                            ?></textarea>
                     </div>
                     <input type="hidden" name="id" value='<?php
                                                            if (!empty($templatename->id)) {
                                                                echo $templatename->id;
                                                            }
                                                            ?>'>
                     <input type="hidden" name="type" value='email'>
                     <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                 </form>
             </div>
         </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
 </div>



 <script src="common/js/codearistos.min.js"></script>
 <script type="text/javascript">
     var select_hospital = "<?php echo lang('select_hospital'); ?>";
 </script>
 <script type="text/javascript">
     var select_template = "<?php echo lang('select_template'); ?>";
 </script>
 <script src="common/extranal/js/email/superadmin_sendview.js"></script>