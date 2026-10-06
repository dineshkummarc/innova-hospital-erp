<?php if ($this->ion_auth->in_group(array('Nurse'))) { ?>
  <script>
    $(document).ready(function() {
      // Initialize Bootstrap Switch with custom labels and colors
      $("input[data-bootstrap-switch]").bootstrapSwitch({
        onText: 'Available',
        offText: 'NOT Available',
        onColor: 'success',
        offColor: 'danger'
      });

      // Listen for the switch change event
      $('#availability-checkbox-nurse').on('switchChange.bootstrapSwitch', function(event, state) {
        var isChecked = state ? 1 : 0;
        var nurseId = $(this).data('nurse-id');

        $.ajax({
          url: 'nurse/updateAvailability',
          type: 'POST',
          data: {
            available: isChecked,
            nurse_id: nurseId
          },
        });
      });
    });
  </script>
<?php } ?>

<!-- if Doctor -->

<?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
  <script>
    $(document).ready(function() {

      $("input[data-bootstrap-switch]").bootstrapSwitch({
        onText: 'Available',
        offText: 'NOT Available',
        onColor: 'success',
        offColor: 'danger'
      });



      $('#availability-checkbox-doctor').on('switchChange.bootstrapSwitch', function(event, state) {
        var isChecked = $(this).is(':checked') ? 1 : 0;
        var doctorId = $(this).data('doctor-id');
        $.ajax({
          url: 'doctor/updateAvailability',
          type: 'POST',
          data: {
            available: isChecked,
            doctor_id: doctorId
          },
        });
      });
    });
  </script>
<?php } ?>

<!-- if Pharmacist -->

<?php if ($this->ion_auth->in_group(array('Pharmacist'))) { ?>
  <script>
    $(document).ready(function() {
      // Initialize Bootstrap Switch with custom labels and colors
      $("input[data-bootstrap-switch]").bootstrapSwitch({
        onText: 'Available',
        offText: 'NOT Available',
        onColor: 'success',
        offColor: 'danger'
      });

      // Listen for the switch change event
      $('#availability-checkbox-pharmacist').on('switchChange.bootstrapSwitch', function(event, state) {
        var isChecked = state ? 1 : 0;
        var pharmacistId = $(this).data('pharmacist-id');

        $.ajax({
          url: 'pharmacist/updateAvailability',
          type: 'POST',
          data: {
            available: isChecked,
            pharmacist_id: pharmacistId
          },
        });
      });
    });
  </script>
<?php } ?>

<!-- if Accountant -->

<?php if ($this->ion_auth->in_group(array('Accountant'))) { ?>
  <script>
    $(document).ready(function() {
      // Initialize Bootstrap Switch with custom labels and colors
      $("input[data-bootstrap-switch]").bootstrapSwitch({
        onText: 'Available',
        offText: 'NOT Available',
        onColor: 'success',
        offColor: 'danger'
      });

      // Listen for the switch change event
      $('#availability-checkbox-accountant').on('switchChange.bootstrapSwitch', function(event, state) {
        var isChecked = state ? 1 : 0;
        var accountantId = $(this).data('accountant-id');

        $.ajax({
          url: 'accountant/updateAvailability',
          type: 'POST',
          data: {
            available: isChecked,
            accountant_id: accountantId
          },
        });
      });
    });
  </script>
<?php } ?>

<!-- if Receptionist -->

<?php if ($this->ion_auth->in_group(array('Receptionist'))) { ?>
  <script>
    $(document).ready(function() {
      // Initialize Bootstrap Switch with custom labels and colors
      $("input[data-bootstrap-switch]").bootstrapSwitch({
        onText: 'Available',
        offText: 'NOT Available',
        onColor: 'success',
        offColor: 'danger'
      });

      // Listen for the switch change event
      $('#availability-checkbox-receptionist').on('switchChange.bootstrapSwitch', function(event, state) {
        var isChecked = state ? 1 : 0;
        var receptionistId = $(this).data('receptionist-id');

        $.ajax({
          url: 'receptionist/updateAvailability',
          type: 'POST',
          data: {
            available: isChecked,
            receptionist_id: receptionistId
          },
        });
      });
    });
  </script>
<?php } ?>

<!-- if Lab Technician -->

<?php if ($this->ion_auth->in_group(array('Laboratorist'))) { ?>
  <script>
    $(document).ready(function() {
      // Initialize Bootstrap Switch with custom labels and colors
      $("input[data-bootstrap-switch]").bootstrapSwitch({
        onText: 'Available',
        offText: 'NOT Available',
        onColor: 'success',
        offColor: 'danger'
      });

      // Listen for the switch change event
      $('#availability-checkbox-laboratorist').on('switchChange.bootstrapSwitch', function(event, state) {
        var isChecked = state ? 1 : 0;
        var labTechnicianId = $(this).data('laboratorist-id');

        $.ajax({
          url: 'laboratorist/updateAvailability',
          type: 'POST',
          data: {
            available: isChecked,
            laboratorist_id: labTechnicianId
          },
        });
      });
    });
  </script>

<?php } ?>

<!-- if Accountant -->

<?php if ($this->ion_auth->in_group(array('Accountant'))) { ?>
  <script>
    $(document).ready(function() {
      // Initialize Bootstrap Switch with custom labels and colors
      $("input[data-bootstrap-switch]").bootstrapSwitch({
        onText: 'Available',
        offText: 'NOT Available',
        onColor: 'success',
        offColor: 'danger'
      });

      // Listen for the switch change event
      $('#availability-checkbox-accountant').on('switchChange.bootstrapSwitch', function(event, state) {
        var isChecked = state ? 1 : 0;
        var accountantId = $(this).data('accountant-id');

        $.ajax({
          url: 'accountant/updateAvailability',
          type: 'POST',
          data: {
            available: isChecked,
            accountant_id: accountantId
          },
        });
      });
    });
  </script>
<?php } ?>