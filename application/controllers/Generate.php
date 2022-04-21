<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generate extends CI_Controller
{

	public function __construct() {
		parent::__construct();
		$this->load->library('parsedown');
		$this->load->library('parser');
	}

	public function index($type = 'html') {
		$this->process(MARKDOWN_PATH, $type);
	}

	private function process($dir = '', $type = 'html') {
		$Folder = new DirectoryIterator($dir);
		foreach ($Folder as $File) {
			if ($File->isDir() && !$File->isDot()) {
				$this->process($File->getPathname(), $type);
			}

			$filename = $File->getFilename();
			$extension = pathinfo($filename, PATHINFO_EXTENSION);
			if ($extension !== 'md') {
				continue;
			}

			$prefix = str_replace(MARKDOWN_PATH, '', $File->getRealPath());
			$str = file_get_contents($File->getRealPath());
			$html = $this->parsedown->text($str);

			if ($type == 'html') {
				$this->toHtml($prefix, $html);
			}
		}
	}


	private function toHtml($prefix, $html) {
		$prefix = str_replace(['.md'], ['.php'], $prefix);

		$data = array(
			'time' => time(),
			'html' => $html
		);
		$tpl = VIEWPATH . "template/{$prefix}";
		if (!file_exists($tpl)) {
			$tpl = dirname($tpl) . '/default.php';
			if (!file_exists($tpl)) {
				throw new Exception('template not found !!!', 404);
			}
		}
		$str = $this->parser->parse(str_replace([VIEWPATH, '.php'], ['', ''], $tpl), $data, TRUE);
		$this->render(GH_PAGES_PATH . str_replace('.php', '.html', $prefix), $str);
	}

	private function render($absFilePath = '', $str = '') {
		$distDir = dirname($absFilePath);
		if (!is_dir($distDir)) {
			mkdir($distDir);
		}
		file_put_contents($absFilePath, $str);
	}
}
