<?php 
class Banner extends CI_controller{
	function Banner()
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
		
		$this->banner_table = "banner";
		$this->banner_image_table = "banner_images";
		
		$this->load->model("admin/bannermodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('image_lib');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index($offset = 0)
	{	
		
		$this->data["page_title"] = $this->lang->line('BANNER_MENU');
		$this->data["page_head"]= $this->lang->line('BANNER_MENU');
		
		$this->data["bannerdata_list"] = $this->bannermodel->get_bannerlist();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/banner/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{
		$this->data["page_head"]  =   $this->lang->line('BANNER_ADD_TITLE');
		$this->data["page_title"] =  $this->lang->line('BANNER_MENU');
		$this->data["page_view"]  =  $this->lang->line('BANNER_ADD_TITLE');
		
		//GET DISPLAY ORDER COUNT
		$this->data['display_order'] = $this->bannermodel->displayorder();
		
		$this->data["formdata"] = array(
			"id" => "",
			"title" => "",
			"display_order" => "",
			"status" => "active"
		);

		$this->form_validation->set_rules("title","title","required");
			
		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->bannermodel->insert_record();
			$this->session->set_userdata('succe','1');
			redirect('admin/banner');
			
			
		}
		$title = $this->input->post("title");
		if(isset($title) && !empty($title))
		{
			$this->data["formdata"] = array(
			"id" => "",
			"title" => $this->input->post("title"),
			"display_order" => $this->input->post("display_order"),
			"status" => $this->input->post("status")
			);
		}	
		
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/banner/add",$this->data);
		$this->load->view("admin/common/footer");
	}

	function edit($id='')
	{
		$this->data["page_head"]  =   $this->lang->line('BANNER_EDIT_TITLE');
		$this->data["page_title"] =  $this->lang->line('BANNER_MENU');
		$this->data["page_view"]  =  $this->lang->line('BANNER_EDIT_TITLE');
		
		$id =$this->input->get('id');
		
		if(!empty($id))
		{
			$this->data["formdata"] 	   = $this->bannermodel->single_banner($id);
			$this->data["getbannername"]   = $this->bannermodel->getbannername($id);
			$this->data["bannerimagedata"] = $this->bannermodel->getimages($id);
			
		}
		
		//GET DISPLAY ORDER COUNT
		$this->data['display_order'] = $this->bannermodel->displayorder();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);
		$this->load->view("admin/banner/edit",$this->data);
		$this->load->view("admin/common/footer");
	}

	function update($id='')
	{

		$this->form_validation->set_rules("title","title","required");
			
		if ($this->form_validation->run() == TRUE)
		{ 
			
			$id = $this->bannermodel->update_record($this->input->post('banner_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/banner');
		}
		
		
	}

	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->bannermodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/banner');
		}
		else
		{
			redirect('admin/banner');
		}
	}
	
	function update_status_activeall()
	{
	
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->bannermodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/banner');
		}
		else
		{
			redirect('admin/banners');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->bannermodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/banner');
		}
		else
		{
			redirect('admin/banner');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->bannermodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/banner');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->bannermodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/banner');
		}
		else
		{
			redirect('admin/banner');
		}
	}
	
	function ajaxdelete()
	{	
		$images =$this->input->get('imgname');
		$this->bannermodel->delete_images($images);
		exit;
		
	}
	
	function ajaxupload()
	{
		$uploaddir = FCPATH.'application/uploads/bannerimages/'; 
		
		$upload_conf = array(
            'upload_path'   => $uploaddir.'original/' ,
            'allowed_types' => 'gif|jpg|png|jpeg',
            'max_size'      => '0',
            'overwrite'     => false,
			'remove_spaces' => true,
			'encrypt_name' => true,
			'file_name' =>time(),
            );
			
		
        $this->upload->initialize($upload_conf);
		
		foreach($_FILES['uploadfile'] as $key=>$val)
        {
            $i = 1;
            foreach($val as $v)
            {
                $field_name = "file_".$i;
                $_FILES[$field_name][$key] = $v;
                $i++;   
            }
        }
        unset($_FILES['uploadfile']);
		
		$error = array();
        $success = array();
		
		foreach($_FILES as $field_name => $file)
        {
			
            if ( ! $this->upload->do_upload($field_name))
            {
                $error['upload'][] = $this->upload->display_errors();
            }
            else
            {
					$config = array(
						'file_name' => time().$field_name
						);
						
                $upload_data = $this->upload->data($config);
				
				$success['original'][] = $upload_data;

				$upload_name = $upload_data['file_name'];
				$image_sizes = array(
					'thumb200' => array(200, 200),
					'thumb100' => array(100, 100),
					'thumb50' => array(50, 50)
				);
				foreach ($image_sizes as $key => $resize) {
					$config = array(
						'source_image' => $upload_data['full_path'],
						'new_image' => $uploaddir.$key.'/'.$upload_name,
						'maintain_ration' => true,
						'overwrite'     => false,
						'width' => $resize[0],
						'remove_spaces' => true,
						'encrypt_name' => true,
						'height' => $resize[1]
					);
					
					$this->image_lib->initialize($config);
					if ( ! $this->image_lib->resize())
					{
						$error['resize'][$key][] = $this->image_lib->display_errors();
					}
					$this->image_lib->clear();
				}
				
            }
        }
        if(count($error) > 0)
        {
            $data['status'] = 'error';
			$data['error_data'] = $error;
        }
        else
        {
			$data['status'] = 'success';
            $data['success_data'] = $success;
        }
		echo json_encode($data);
	}
	
	
	
}

?>