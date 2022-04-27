<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<?php $this->load->view('commons/header'); ?>
<body>

<main role="main" class="flex-shrink-0">
	<div class="container">
		<h1>This is shiji default template {time}</h1>
		<div class="content">{html}</div>
	</div>
</main>
<?php $this->load->view('commons/footer'); ?>
</body>
</html>
