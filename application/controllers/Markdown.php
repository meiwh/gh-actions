<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Markdown extends CI_Controller
{

	public function __construct() {
		parent::__construct();
		$this->load->library('pressdown');
	}

	public function index() {
		$router = $this->router;
		$segments = $router->uri->segments;

		$md = implode(DIRECTORY_SEPARATOR, $segments);
		if (file_exists($path = MARKDOWN_SRC_PATH . "{$md}.md")) {
			$this->pressdown->preview($path, []);
			return;
		}
		$md .= '/index';
		if (file_exists($path = MARKDOWN_SRC_PATH . "{$md}.md")) {
			$this->pressdown->preview($path, []);
			return;
		}
		show_404('not found');
	}

}
