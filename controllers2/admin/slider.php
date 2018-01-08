<?php 
class Slider extends CI_controller{
	function Slider()
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
		
		
		$this->slider_table = "slider";
		$this->slider_content_table = "slider_content";
		
		$this->load->model("admin/slidermodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('image_lib');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index($offset = 0)
	{	
		
		$this->data["page_title"] = $this->lang->line('SLIDER_MENU');
		$this->data["page_head"]= $this->lang->line('SLIDER_MENU');
		
		$this->data["sliderdata_list"] = $this->slidermodel->get_sliderlist();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/slider/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	
	
	function add()
	{
		$this->data["page_head"]  =   $this->lang->line('SLIDER_ADD_TITLE');
		$this->data["page_title"] =  $this->lang->line('SLIDER_MENU');
		$this->data["page_view"]  =  $this->lang->line('SLIDER_ADD_TITLE');
		
		
		$this->data["formdata"] = array(
			"slider_id" => "",
			"title" => "",
			"status" => "active",
			"slider_title" => "",
			"short_description" => "",
			"description" => "",
			"social_fb" => "",
			"social_tw" => "",
			"social_g" => "",
			"social_rss" => "",
			"url" => ""
		);

		$this->form_validation->set_rules("title","title","required");
			
		if ($this->form_validation->run() == TRUE)
		{ 

			$id = $this->slidermodel->insert_record();
			$this->session->set_userdata('succe','1');
			redirect('admin/slider');
			
			
		}
		$title = $this->input->post("title");
		if(isset($title) && !empty($title))
		{
			$this->data["formdata"] = array(
			"slider_id" => "",
			"title" => $this->input->post("title"),
			"status" => $this->input->post("status"),
			"slider_title" => $this->input->post("status"),
			"short_description" => $this->input->post("short_description"),
			"description" => $this->input->post("description"),
			"social_fb" => $this->input->post("social_fb"),
			"social_tw" => $this->input->post("social_tw"),
			"social_g" => $this->input->post("social_g"),
			"social_rss" => $this->input->post("social_rss"),
			"url" => $this->input->post("url")
			);
		}	
		
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/slider/add",$this->data);
		$this->load->view("admin/common/footer");
	}

	function edit($id='')
	{
		$this->data["page_head"]  =   $this->lang->line('SLIDER_EDIT_TITLE');
		$this->data["page_title"] =  $this->lang->line('SLIDER_MENU');
		$this->data["page_view"]  =  $this->lang->line('SLIDER_EDIT_TITLE');
		
		$id =$this->input->get('id');
		
		if(!empty($id))
		{
			$this->data["formdata"] 	   = $this->slidermodel->single_slider_content($id);
			$this->data["slider_data"] 	   = $this->slidermodel->single_slider($id);
			$this->data["getbannername"]   = $this->slidermodel->getslidername($id);
			$this->data["bannerimagedata"] = $this->slidermodel->getslidercontent($id);
			
		}
		
		//GET DISPLAY ORDER COUNT
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);
		$this->load->view("admin/slider/edit",$this->data);
		$this->load->view("admin/common/footer");
	}

	function update($id='')
	{

		$this->form_validation->set_rules("title","title","required");
			
		if ($this->form_validation->run() == TRUE)
		{ 
			
			$id = $this->slidermodel->update_record($this->input->post('slider_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/slider');
		}
		
		
	}

	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->slidermodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/slider');
		}
		else
		{
			redirect('admin/slider');
		}
	}
	
	function update_status_activeall()
	{
	
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->slidermodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/slider');
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
				$msg= $this->slidermodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/slider');
		}
		else
		{
			redirect('admin/slider');
		}
	}
	
	function removeslider($id='')
	{
		
		$id =$this->input->get('id');

		$slider_ids =$this->input->get('slider');
		if(!empty($id))
		{
			$msg =$this->slidermodel->delete_slider_record($id);
			$this->session->set_flashdata('succ_delete','1');
			//redirect('admin/slider/edit?id='.$slider_ids);
                        redirect('admin/slider');
		}
		
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->slidermodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/slider');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->slidermodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/slider');
		}
		else
		{
			redirect('admin/slider');
		}
	}
	
	function ajaxdelete()
	{	
		$images =$this->input->get('imgname');
		$this->slidermodel->delete_images($images);
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