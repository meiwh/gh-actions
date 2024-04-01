<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Markdown extends CI_Controller
{

	public function __construct() {
		parent::__construct();
		$this->load->library('parsedownExtra', null, 'parsedown');
		$this->load->library('parser');
	}

	public function index() {
		$router = $this->router;
		$segments = $router->uri->segments;

		$md = implode(DIRECTORY_SEPARATOR, $segments);
		if (file_exists(MARKDOWN_SRC_PATH . "{$md}.md")) {
			$this->render($md);
			return;
		}
		$md .= '/index';
		if (file_exists(MARKDOWN_SRC_PATH . "{$md}.md")) {
			$this->render($md);
			return;
		}
		show_404('not found');
	}


	private function render($md, $extData = []) {
		$fpath = MARKDOWN_SRC_PATH . "{$md}.md";

		$md_content = '';
		// --
		$file = fopen($fpath, 'r');
		$delimitators = 0;
		while (!feof($file)) {
			$line = fgets($file);
			if ($delimitators != 2) {
				if ($line === "---\n") {
					$delimitators += 1;
				} else {
					$d = explode(":", $line, 2);
					$extData[trim($d[0])] = trim(trim($d[1]), '"');
				}
			} else {
				$md_content .= $line;
			}
		}
		fclose($file);


		$parsed = $this->parsedown->text($md_content);
		$data = array_merge(['time' => time(), 'html' => $parsed], $extData);
		$tpl = VIEWPATH . "template/{$md}.php";
		if (!file_exists($tpl)) {
			$tpl = dirname($tpl) . '/default.php';
			if (!file_exists($tpl)) {
				$tpl = VIEWPATH . "template/default.php";
			}
		}
		$this->parser->parse(str_replace([VIEWPATH, '.php'], ['', ''], $tpl), $data);
	}

}
