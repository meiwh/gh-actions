<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generate extends CI_Controller
{

	public function __construct() {
		parent::__construct();
		$this->load->library('pressdown');
	}

	public function html() {
		$this->pressdown->html();
	}

}
