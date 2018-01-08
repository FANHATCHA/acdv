<?php

class Errors extends Controller {

	function Errors()
	{
		parent::Controller();
	}
	function error_404()
	{
		$this->load->view('errors/view');
	}
}
?>