<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<?php $this->load->view('commons/header'); ?>
<style type="text/css">
	body{
        background-color: #F6F6F6;
}
p{
        font-size: 1.3rem;
    font-family: monospace;
    color: #000;
}
em.r{
        border-bottom: 1px solid #000;
    font-style: normal;
    font-weight: 400;
    font-size: 120%;

    padding-left: 1px;
    padding-right: 1px;
}
em.d{
    border-bottom: 1px solid #000;
    font-style: normal;
    font-weight: 400;
    padding-left: 1px;
    padding-right: 1px;
    font-style: italic;
}



    sup:before {
    content: "（";
}

sup:before {
    content: "（";
}
sup {
   top: -1.3em;
    color: #666;
    font-size: .5em;
}

.p-notes {
    font-size: 0.9em;
    color: #555;
}
ruby rt{
	    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
}
blockquote{padding: 0 2em 0 2em;}
blockquote *{font-size: 98%;}
</style>
<body>

<main role="main" class="flex-shrink-0">
	<div class="container-lg">
		<h1>{time}</h1>
		<div class="content">
			{html}
		</div>
	</div>
</main>
<?php $this->load->view('commons/footer'); ?>
</body>
</html>
