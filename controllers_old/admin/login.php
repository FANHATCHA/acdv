<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

	function __construct()
	{
	   parent::__construct();
	   
	   /* CLEAR CATCH CODE */
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Connection: close");
		/* CLEAR CATCH CODE */
		
	}

	public function index()
	{ 
		$this->data["page_title"] = $this->lang->line('LOGIN_TITLE');
		$session_data = $this->session->userdata('admin_session');
		if(isset($session_data) && !empty($session_data))
		{
			redirect('admin/dashboard');
		}
		$this->data['errmsg']='';

		if($this->input->post('username') && $this->input->post('password'))
		{
			// Check USER AND PASSWORD VALID OR NOT
			$query = $this->db->query("SELECT id,username,firstname from users where username='".$this->input->post('username')."' and password='".md5($this->input->post('password'))."'");
			if ($query->num_rows() > 0)
			{
				   $row = $query->row_array();
				   //SET SESSION
				   $this->session->set_userdata('admin_session',$row['id']);
				   $this->session->set_userdata('admin_username',$row['username']);
				   $this->session->set_userdata('firstname',$row['firstname']);
				   redirect('admin/dashboard');
			}
			else
			{
				$data['errmsg']='Invalid username or password';
			}
		}
		$this->load->view('admin/login.php',$this->data);
	}
	
	// Verify Username And Password
	public function verify()
	{ 
		$this->data["page_title"] = $this->lang->line('LOGIN_TITLE');
		$this->data['errmsg']='';
		if($this->input->post('username') && $this->input->post('password'))
		{
			$query = $this->db->query("SELECT id,username,firstname from users where username='".$this->input->post('username')."' and password='".md5($this->input->post('password'))."'");
			if ($query->num_rows() > 0)
			{
			   $row = $query->row_array();
			   //SET SESSION
			   $this->session->set_userdata('admin_session',$row['id']);
			   $this->session->set_userdata('admin_username',$row['username']);
			   $this->session->set_userdata('firstname',$row['firstname']);
			   redirect('admin/dashboard');

			}
			else
			{
			  $this->data['errmsg']='Invalid username or password';
			}
		}
		$this->load->view('admin/login.php',$this->data);
	}
	function logout()
	{
	   $this->session->unset_userdata('admin_session');
	   $this->session->sess_destroy();
	   redirect('admin/login', 'refresh');
	}
}
?>