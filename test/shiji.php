<?php
$start = 6;
$path = "D:/Downloads/epub-master/epub-master/15/text00006.html";

for ($i = 6; $i <= 135; $i++) {
	$idx = sprintf("%05d", $i);
	$path = "D:/Downloads/epub-master/epub-master/15/text{$idx}.html";
	$content = file_get_contents($path);


	preg_match("/<p>([\s\S]*)<\/p>/",$content, $a);
	echo $a[0];
	exit();
	echo $path . PHP_EOL;
}
