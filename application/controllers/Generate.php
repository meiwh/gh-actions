<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->library('parsedown');
		$this->load->library('parser');
	}

	public function index()
	{
		$this->aaa(APPPATH . MARKDOWN_PATH);
	}

	private function aaa($dir = ''){
		$Folder = new DirectoryIterator($dir);
		foreach ($Folder as $File) {
			if ($File->isDir() && !$File->isDot()) {
				$this->aaa($File->getPathname());
			}

			$filename = $File->getFilename();
			$extension = pathinfo($filename, PATHINFO_EXTENSION);
			if ($extension !== 'md')
			{
				continue;
			}

			$prefix = str_replace(APPPATH, '', $File->getRealPath());


			$str = file_get_contents($File->getRealPath());

			$html =  $this->parsedown->text($str);


			if (time() % 2 == 0) {
				$this->parseHtml($prefix, $html);
			} else {
				$this->parsePHP($prefix, $html);
			}
		}
	}

	private function parsePHP($prefix, $str) {
		$distFile = VIEWPATH . str_replace('.md', '.php', $prefix);
		$this->render($distFile, $str);
	}

	private function parseHtml($prefix, $html) {
		$prefix = str_replace(MARKDOWN_PATH, '', $prefix);
		$data = array(
			'time'   => time(),
			'html' => $html
		);
		$str = $this->parser->parse("template/default", $data);
		$this->render(GH_PAGES_PATH  . str_replace('.md', '.html', $prefix), $str);
	}

	private function render($absFilePath = '', $str = '') {

		$distDir = dirname($absFilePath);
		if(!is_dir($distDir)) {
			mkdir($distDir);
		}
		file_put_contents($absFilePath, $str);
	}
}
