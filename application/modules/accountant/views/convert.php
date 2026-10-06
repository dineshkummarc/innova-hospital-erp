<!DOCTYPE html>
<html>
<head>
	<title>Convert PDF to JPEG</title>
</head>
<body>
	<?php echo form_open_multipart('accountant/convert'); ?>
		<input type="file" name="pdf_file" accept=".pdf" required>
		<button type="submit">Convert</button>
	<?php echo form_close(); ?>
</body>
</html>
