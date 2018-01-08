<?php 
class Medialibrary extends CI_controller{
	function Medialibrary()
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
		
		
		$this->media_table = "media_library";
		$this->banner_image_table = "banner_images";
		
		$this->load->model("admin/medialibrarymodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('image_lib');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index($offset = 0)
	{	
		
		$this->data["page_title"] = $this->lang->line('MEDIA_LIBRAY');
		$this->data["page_head"]= $this->lang->line('MEDIA_LIBRAY');
		
		$this->data["bannerdata_list"] = $this->medialibrarymodel->get_medialibrarylist();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/medialibrary/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{
		$this->data["page_head"]  =   $this->lang->line('ADD_MEDIA_LIBRAY');
		$this->data["page_title"] =  $this->lang->line('ADD_MEDIA_LIBRAY');
		$this->data["page_view"]  =  $this->lang->line('ADD_MEDIA_LIBRAY');
		
		//GET DISPLAY ORDER COUNT
		//$this->data['display_order'] = $this->medialibrarymodel->displayorder();
		
		$this->data["formdata"] = array(
			"id" => "",
			"title" => "",
			"display_order" => "",
			"status" => "active"
		);

		$this->form_validation->set_rules("title","title","required");
			
		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->medialibrarymodel->insert_record();
			$this->session->set_userdata('succe','1');
			redirect('admin/medialibrary');
			
			
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
		$this->load->view("admin/medialibrary/add",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function edit($id='')
	{
		$this->data["page_head"]  =   $this->lang->line('MEDIA_EDIT_TITLE');
		$this->data["page_title"] =  $this->lang->line('MEDIA_MENU');
		$this->data["page_view"]  =  $this->lang->line('MEDIA_EDIT_TITLE');
		
		$id =$this->input->get('id');
		
		
		if(!empty($id))
		{
			$this->data["formdata"] 	   = $this->medialibrarymodel->single_banner($id);
			$this->data["getmedianame"]   = $this->medialibrarymodel->getmedianame($id);
			$this->data["formdata_id"]   = $this->input->get('id');
		}
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);
		$this->load->view("admin/medialibrary/edit",$this->data);
		$this->load->view("admin/common/footer");
	}

	function update($id='')
	{

		$this->form_validation->set_rules("title","title","required");
		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->medialibrarymodel->update_record($this->input->post('media_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/medialibrary');
		}
		
	}
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->medialibrarymodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/medialibrary');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->medialibrarymodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/medialibrary');
		}
		else
		{
			redirect('admin/medialibrary');
		}
	}
	
	function ajaxdelete()
	{	
		$images = $_REQUEST['imgname'];
		$this->medialibrarymodel->delete_images($images);
		exit;
		
	}
	
	function ajaxupload()
	{
		$output_dir = FCPATH.'application/uploads/images/'; 
		if(isset($_FILES["myfile"]))
		{
			$ret = array();

			$error = $_FILES["myfile"]["error"];
		    {
			
				if(!is_array($_FILES["myfile"]['name'])) //single file
				{
				
						$upload_conf = array(
							'upload_path'   => $output_dir.'original/' ,
							'allowed_types' => 'jpg|png|jpeg|gif|txt|doc|xls|jpeg|odp|pdf',
							'max_size'      => '0',
							'overwrite'     => false,
							'remove_spaces' => true,
							'encrypt_name' => false,
							);
						$this->upload->initialize($upload_conf);
						
						$field_name = $_FILES["myfile"]["name"];
					    $ret[$field_name]= $output_dir.$field_name;
						if (!$this->upload->do_upload('myfile'))
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
							
							/*=============== insert date ======================*/
							$createdate = date('Y-m-d H:i:s');
							$data =  array(
								"title" => $upload_name,
								"original_title" => $upload_name,
								"alternate_text" => '',
								"caption" => '',
								"description" => '',
								"created_date" => $createdate,
								"modified_date" => $createdate
								);
								
							$this->db->insert($this->media_table,$data);
							$mediaid = $this->db->insert_id();
							/*=============== insert date ======================*/
							
							$image_sizes = array(
								'thumb200' => array(200, 200),
								'thumb100' => array(100, 100),
								'thumb50' => array(50, 50)
							);
							foreach ($image_sizes as $key => $resize) {
								$config = array(
									'source_image' => $upload_data['full_path'],
									'new_image' => $output_dir.$key.'/'.$upload_name,
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
				
				else
				{
				
					$upload_conf = array(
						'upload_path'   => $output_dir.'original/' ,
						'allowed_types' => 'jpg|png|jpeg|gif|txt|doc|xls|jpeg|odc|pdf',
						'max_size'      => '0',
						'overwrite'     => false,
						'remove_spaces' => true,
						'encrypt_name' => false,
						);
					$this->upload->initialize($upload_conf);
					
					  $fileCount = count($_FILES["myfile"]['name']);
					  for($i=0; $i < $fileCount; $i++)
					  {
					  
						$field_name = $_FILES["myfile"]["name"][$i];
					    $ret[$field_name]= $output_dir.$field_name;
						if (!$this->upload->do_upload('myfile'))
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
							
							/*=============== insert date ======================*/
							$createdate = date('Y-m-d H:i:s');
							$data =  array(
								"title" => $upload_name,
								"original_title" => $upload_name,
								"alternate_text" => '',
								"caption" => '',
								"description" => '',
								"created_date" => $createdate,
								"modified_date" => $createdate
								);
								
							$this->db->insert($this->media_table,$data);
							$mediaid = $this->db->insert_id();
							/*=============== insert date ======================*/
							
							$image_sizes = array(
								'thumb200' => array(200, 200),
								'thumb100' => array(100, 100),
								'thumb50' => array(50, 50)
							);
							foreach ($image_sizes as $key => $resize) {
								$config = array(
									'source_image' => $upload_data['full_path'],
									'new_image' => $output_dir.$key.'/'.$upload_name,
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
				
				}
				
			}
			echo json_encode($ret);
		 
		}
	}
}
?>