<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Markdown extends CI_Controller
{

	protected $markdownPath;

	public function __construct() {
		parent::__construct();
		$this->load->library('parsedown');
		$this->load->library('parser');

		$this->markdownPath = MARKDOWN_PATH;
	}

	public function index() {
		$router = $this->router;
		$segments = $router->uri->segments;

		$md = implode(DIRECTORY_SEPARATOR, $segments);
		if (file_exists(MARKDOWN_PATH . "{$md}.md")) {
			$this->render($md);
			return;
		}
		$md .= '/index';
		if (file_exists(MARKDOWN_PATH . "{$md}.md")) {
			$this->render($md);
			return;
		}
		show_404('not found');
	}


	private function render($md, $extData = []) {
		$parsed = $this->parsedown->text(file_get_contents(MARKDOWN_PATH . "{$md}.md"));
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
