<?php
$start = 6;
$path = "D:/Downloads/epub-master/epub-master/15/text00006.html";

for ($i = 6; $i <= 135; $i++) {
	$filename = $i - 5;

	if(in_array($filename, [6, 68, 130])) {
		continue;
	}
	$idx = sprintf("%05d", $i);
	$path = "D:/Downloads/epub-master/epub-master/15/text{$idx}.html";
	$content = file_get_contents($path);


	preg_match("/<title>(.*)<\/title>/", $content, $a);
	$title = str_replace('史　记　卷　一', '', $a[1]);




	$content = preg_replace(["/(\s)*/", "/<p>/", "/<br\/>/"], ["", "\n<p>", ""], $content);

	$content = preg_replace("/<a(.*?)><\/a>/", "", $content);


	preg_match("/<p>([\s\S]*)<\/p>/",$content, $a);
	$content = $a[0];

	$content = preg_replace(["/<spanclass=\"kindle-cn-underline\">(.*?)<\/span>/", "/<p>(.*?)<\/p>/"], ["_$1_","$1\n"], $content);

	$content = preg_replace("/<spanclass=\"kindle-cn-quxian\">(.*?)<\/span>/", "《$1》", $content);

	$header = '---' . PHP_EOL . 'title:"' . $title. '"' . PHP_EOL . 'book:"史记"' . PHP_EOL . '---' . PHP_EOL ;

	$content = $header . $content;

	file_put_contents("D:\workspace\gh-actions\markdown\src\shiji\\{$filename}.md", $content);
	echo $path . PHP_EOL;
}
