<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Diagnoses_model $Diagnoses
 */
class Welcome extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->PAGE_PRETITLE = "Dashboard";
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->PAGE_TITLE = "Index";
		$this->view('welcome_message');
	}
}
