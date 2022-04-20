<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Markdown extends CI_Controller {

	public function index()
	{
		$router = $this->router;
		$class = $router->class;
		$method = $router->method;
		// 判断文件是否存在，
//		show_404('');
		$this->load->view(MARKDOWN_PATH . "/{$class}/{$method}");
	}



}
