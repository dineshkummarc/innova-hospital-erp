<!-- nurse availability checkbox starts -->
<?php if ($this->ion_auth->in_group(array('Nurse'))) {
  $this->load->model('nurse/nurse_model');
  $ion_id = $this->ion_auth->get_user_id();
  $nurse = $this->nurse_model->getNurseByIonUserId($ion_id);
?>
  <input type="checkbox" name="my-checkbox" style="display:none;" id="availability-checkbox-nurse" data-bootstrap-switch data-off-color="danger" data-on-color="success"
    <?php echo ($nurse->available == 1) ? 'checked' : ''; ?> data-nurse-id="<?php echo $nurse->id; ?>"> <!-- Use a real doctor ID -->
<?php } ?>
<!-- nurse availability checkbox ends -->

<!-- pharmacist availability checkbox starts -->
<?php if ($this->ion_auth->in_group(array('Pharmacist'))) {
  $this->load->model('pharmacist/pharmacist_model');
  $ion_id = $this->ion_auth->get_user_id();
  $pharmacist = $this->pharmacist_model->getPharmacistByIonUserId($ion_id);
?>
  <input type="checkbox" name="my-checkbox" style="display:none;" id="availability-checkbox-pharmacist" data-bootstrap-switch data-off-color="danger" data-on-color="success"
    <?php echo ($pharmacist->available == 1) ? 'checked' : ''; ?> data-pharmacist-id="<?php echo $pharmacist->id; ?>"> <!-- Use a real doctor ID -->
<?php } ?>
<!-- pharmacist availability checkbox ends -->

<!-- receptionist availability checkbox starts -->
<?php if ($this->ion_auth->in_group(array('Receptionist'))) {
  $this->load->model('receptionist/receptionist_model');
  $ion_id = $this->ion_auth->get_user_id();
  $receptionist = $this->receptionist_model->getReceptionistByIonUserId($ion_id);
?>
  <input type="checkbox" name="my-checkbox" style="display:none;" id="availability-checkbox-receptionist" data-bootstrap-switch data-off-color="danger" data-on-color="success"
    <?php echo ($receptionist->available == 1) ? 'checked' : ''; ?> data-receptionist-id="<?php echo $receptionist->id; ?>"> <!-- Use a real doctor ID -->
<?php } ?>
<!-- receptionist availability checkbox ends -->

<!-- laboratorist availability checkbox starts -->
<?php if ($this->ion_auth->in_group(array('Laboratorist'))) {
  $this->load->model('laboratorist/laboratorist_model');
  $ion_id = $this->ion_auth->get_user_id();
  $laboratorist = $this->laboratorist_model->getLaboratoristByIonUserId($ion_id);
?>
  <input type="checkbox" name="my-checkbox" style="display:none;" id="availability-checkbox-laboratorist" data-bootstrap-switch data-off-color="danger" data-on-color="success"
    <?php echo ($laboratorist->available == 1) ? 'checked' : ''; ?> data-laboratorist-id="<?php echo $laboratorist->id; ?>"> <!-- Use a real doctor ID -->
<?php } ?>
<!-- laboratorist availability checkbox ends -->

<!-- accountant availability checkbox starts -->
<?php if ($this->ion_auth->in_group(array('Accountant'))) {
  $this->load->model('accountant/accountant_model');
  $ion_id = $this->ion_auth->get_user_id();
  $accountant = $this->accountant_model->getAccountantByIonUserId($ion_id);
?>
  <input type="checkbox" name="my-checkbox" style="display:none;" id="availability-checkbox-accountant" data-bootstrap-switch data-off-color="danger" data-on-color="success"
    <?php echo ($accountant->available == 1) ? 'checked' : ''; ?> data-accountant-id="<?php echo $accountant->id; ?>"> <!-- Use a real doctor ID -->

<?php } ?>
<!-- accountant availability checkbox ends -->