<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<?php $this->load->view('commons/header'); ?>
<body>

<div id="container">
	<h1>This is shiji index template</h1>

	<div id="body">
		<?php foreach ($data as $item) {?>
			<a href="<?=$item['href']?>"><?=$item['title'] ?? ''?></a><br/>
		<?php }?>
	</div>

</div>
<?php $this->load->view('commons/footer'); ?>
</body>
</html>
