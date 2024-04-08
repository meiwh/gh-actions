<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tmp extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('pressdown');
	}


	public function img()
	{
		// <imgalt=""class="kindle-cn-inline-character"src="Image00102.jpg"/>

		$path = MARKDOWN_SRC_PATH . "shiji\\";
		$dir = scandir($path);

		$imgs = [];

		foreach ($dir as $file) {
			if(in_array($file, ['.', '..', 'index.md'])) {
				continue;
			}
			$content = file_get_contents($path . $file);
			preg_match_all("/Image(\d*)\.jpg/", $content, $matches);



			$imgs = array_merge($imgs, $matches[0]);

		}

		$imgs = array_unique($imgs);

		var_dump(count($imgs));
	}

	public function replaceImg()
	{
		$map = [
			"003" => "a"
		];


		$path = MARKDOWN_SRC_PATH . "\\";
		$dir = scandir($path);


		foreach ($dir as $file) {
			if(in_array($file, ['.', '..', 'index.md'])) {
				continue;
			}
			$content = file_get_contents($path . $file);


			$pure_content = str_replace(array_keys($map), array_values($map), $content);



		}
	}

}
