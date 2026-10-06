<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo lang('live_meeting'); ?></title>
    <link href="common/extranal/css/meeting/live.css" rel="stylesheet">
    <meta name="format-detection" content="telephone=no">
</head>

<body>

    <?php
    $meeting_details = $this->meeting_model->getMeetingById($live_id);
    $topic = $meeting_details->topic;
    $doctor = $meeting_details->doctorname;
    $patient = $meeting_details->patientname;

    $settings = $this->settings_model->getSettings();
    $hospital = $settings->system_vendor;

    if ($this->ion_auth->in_group(array('Patient'))) {
        $redirect = 'appointment/myTodays';
    } else {
        $redirect = 'appointment';
    }
    ?>

    <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top"> 
        <div class="container">
            <div class="navbar-header">
                <h4><i class="fa fa-chromecast"></i> <?php echo $hospital ?> : <?php echo lang('live'); ?> <?php echo lang('appointment'); ?> </h4>
            </div>
            <div class="navbar-form navbar-right">
                <?php if ($this->ion_auth->in_group('Patient')) { ?>
                    <h5><i class="far fa-user-circle"></i> <?php echo lang('doctor'); ?> : <?php echo $doctor; ?></h5>
                <?php } ?>
                <?php if ($this->ion_auth->in_group('Doctor')) { ?>
                    <h5><i class="far fa-user-circle"></i> <?php echo lang('patient'); ?> <?php echo lang('name'); ?> : <?php echo $patient; ?> , <?php echo lang('id'); ?>: <?php echo $meeting_details->patient; ?></h5>
                <?php } ?>
            </div>
        </div>
    </nav>

    <!-- import ZoomMtg dependencies -->
    <script src="https://source.zoom.us/2.6.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.6.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.6.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.6.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/2.6.0/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/2.6.0/lib/vendor/lodash.min.js"></script>

    <!-- import ZoomMtg -->
    <script src="https://source.zoom.us/2.6.0/zoom-meeting-2.6.0.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-1.9.5.js"></script>
    <script type="text/javascript">
 ZoomMtg.preLoadWasm();
 ZoomMtg.prepareJssdk();

        var api_key = "<?php echo $api_key; ?>";
        var secret_key = "<?php echo $secret_key; ?>";
        // var meeting_id = "<?php echo $meeting_id; ?>";
        var username = "<?php echo $this->ion_auth->user()->row()->username; ?>";
        // var meeting_password = "<?php echo $meeting_password; ?>";
        var link = "<?php echo base_url(); ?><?php echo $redirect; ?>";
        var meeting_id = 1;
        var meeting_password = 12345;

        ZoomMtg.init({
            leaveUrl: link,
            isSupportAV: true,
            success: function() {
                ZoomMtg.join({
                    meetingNumber: meeting_id,
                    userName: username,
                    signature: ZoomMtg.generateSignature({
                        meetingNumber: meeting_id,
                        apiKey: api_key,
                        apiSecret: secret_key,
                        role: 0,
                        success: function(res) {
                            console.log(res.result);
                        }
                    }),
                    apiKey: api_key,
                    userEmail: '',
                    passWord: meeting_password,
                    success: function(res) {
                        console.log('join meeting success');
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            },
            error: function(res) {
                console.log(res);
            }
        });
    </script>
</body>

</html>