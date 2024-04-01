<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<?php $this->load->view('commons/header'); ?>
<body>

<div id="container">
	<h1>This is shiji index template {generated_time}</h1>

	<div id="body">
		{html}
	</div>

	<p class="footer">Page rendered in <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<?php $this->load->view('commons/footer'); ?>
</body>
</html>
