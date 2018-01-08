<?php
class Menulinkmodel extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->menulink_table = "menulink";
		$this->menuss_table = "menu";
		$this->cms_table = "cmspage";
		$this->procat_table = "products_categories";
		$this->tags_table = "tags";
	}
	
	function getallcmspage()
	{
		$query = $this->db->query("select id,cms_title from ".$this->cms_table." WHERE status IN('active')");
		return $query->result_array();
	}
	
	
	function getprocat() 
	{
		$query = $this->db->query("select * from ".$this->procat_table." WHERE status IN('active') ORDER BY display_order ASC");
		$categories = $query->result_array();
		$map = array(
			0 => array('subcategories' => array())
		);

		foreach ($categories as &$category) {
			$category['subcategories'] = array();
			$map[$category['category_id']] = &$category;
		}
		foreach ($categories as &$category) {
			$map[$category['parent_id']]['subcategories'][] = &$category;
		}
		return $map[0]['subcategories'];
	}
	
	function getmenulist()
	{
		$query = $this->db->query("select menu_title,id FROM ".$this->menuss_table." WHERE status IN('active')");
		return $query->result_array();
	}
	
	function getprimarytags()
	{
		$query = $this->db->query("select tag_name,id FROM ".$this->tags_table." WHERE status IN('active') AND tag_type='primary'");
		return $query->result_array();
	}
	
	function getsecondarytags()
	{
		$query = $this->db->query("select tag_name,id FROM ".$this->tags_table." WHERE status IN('active') AND tag_type = 'secondary'");
		return $query->result_array();
	}
	
	function getassignmenu($menu_id)
	{
		$query = $this->db->query("select * FROM ".$this->menulink_table." WHERE menu_id = '".$menu_id."'");
		return $query->result_array();
	}
	
	function getmenutree($menu_id)
	{
		$query = $this->db->query("select * FROM ".$this->menuss_table." WHERE id = '".$menu_id."'");
		return $query->result_array();
	}
	
	/* GET MENU DETAILS */
	function getmenudetails($id)
	{
		$query = $this->db->query("select * FROM ".$this->menulink_table." WHERE id = '".$id."'");
		$menudetails = $query->result_array();
		
		foreach($menudetails as $assmenulist)
		{
			if($assmenulist['menu_type'] == 'custom_link')
			{
				return $assmenulist['custom_link_title'];
			}
			if($assmenulist['menu_type'] == 'cms_page')
			{
				$cmspage = $this->getcmspagename($assmenulist['link_id']);
				return $cmspage[0]['cms_title'];
			}
			if($assmenulist['menu_type'] == 'primary_tag')
			{
				$cmspage = $this->getprimarytagname($assmenulist['link_id']);
				return $cmspage[0]['tag_name'];
			}
			if($assmenulist['menu_type'] == 'secondary_tag')
			{
				$cmspage = $this->getsecondarytagsname($assmenulist['link_id']);
				return $cmspage[0]['tag_name'];
			}
			if($assmenulist['menu_type'] == 'pro_cat')
			{
				$procatname = $this->getcategoryname($assmenulist['link_id']);
				return $procatname[0]['category_name'];
			}
		}
	}
	public function updatestatusdata($id,$click)
	{
		//$this->db->query('update '.$this->menulink_table.' set clickable = "'.$click.'" where id = "'.$id.'"');
		$this->db->query('update '.$this->menulink_table.' set clickable = case when clickable="yes" then "no" else "yes" end where id = "'.$id.'"');
	}
	public function menutreestructure($menuarray){
		$output = '';
		$menu_ids =array();
	
		if(isset($menuarray) && !empty($menuarray))	
		{
			foreach ($menuarray as $key => $mixedValue) {
			
				if (is_array($mixedValue)) {
				
					/*================== get id to clickble or not ======================*/
					$query = $this->db->query("select clickable,menu_type FROM ".$this->menulink_table." WHERE id = '".$mixedValue['id']."'");
					$res_clickble = $query->result_array();
					/*================== get id to clickble or not ======================*/
					
					if(isset($res_clickble[0]['clickable']) && !empty($res_clickble[0]['clickable']) && $res_clickble[0]['clickable'] == 'yes')
					{
						$validationclass = 'success';
						$clickblevar = $this->lang->line('CLICKBLE');
					}
					else
					{
						$validationclass = 'danger';
						$clickblevar = $this->lang->line('CLICKBLE_NOT');
					}
					$menuselectid = $this->input->get('menu');
					if(isset($res_clickble[0]['menu_type']) && !empty($res_clickble[0]['menu_type']) && $res_clickble[0]['menu_type'] == 'custom_link')
					{
						$editmenulink = '<a class="editbutton" href="'.$this->config->site_url().'admin/menulink/editcustomlink?menuid='.$mixedValue['id'].'&menu='.$menuselectid.'" style="text-decoration: none;"><span style="font-size: 13px" class="label label-sm label-success">Edit</span></a>';
					}
					else{
						$editmenulink = '';
					}
					
					
					$output .= '<li class="dd-item" data-id="'.$mixedValue['id'].'"><div class="dd-handle">' .$this->getmenudetails($mixedValue['id']).'</div>'.$editmenulink.'<a class="removeitemclickble" href="'.$this->config->site_url().'admin/menulink/updatestatus?menuid='.$mixedValue['id'].'&menu='.$menuselectid.'" style="text-decoration: none;"><span style="font-size: 13px" class="label label-sm label-'.$validationclass.'">'.$clickblevar.'</span></a><span class="removeitem" onclick="removeitem('.$mixedValue['id'].')"><i class="fa fa-trash-o"></i></span>';
					
					$menu_ids[] .= $mixedValue['id'];
					if(is_array(@$mixedValue['children']))
					{
						$output .= '<ol class="dd-list">';
						$output .= $this->menutreestructure($mixedValue['children']);
						$output .= '</ol>';
					}
					$output .= '</li>';
					//$menu_ids[] .= $mixedValue['id'];
				}	
			}
			
		}
		$menu_id = implode(',',$menu_ids);
		$output .= '<input type="hidden" name="ids_menu" name="ids_menu" value="'.$menu_id.'">';
		return $output;
	}
	
	
	public function getids($menuarray){
		$output = '';
		$menu_ids =array();
		if(isset($menuarray) && !empty($menuarray))	
		{
			foreach ($menuarray as $key => $mixedValue) {
				if (is_array($mixedValue)) {
					$menu_ids[] .= $mixedValue['id'];
					if(is_array(@$mixedValue['children']))
					{
						$output .= $this->getids($mixedValue['children']);
					}
				}	
			}
			
		}
		$menu_id = implode(',',$menu_ids);
		$output .= $menu_id.',';
		return $output;
	}
	
	
	/* GET MENU DETAILS */
	
	
		
	function getcategoryname($catid)
	{
		$query = $this->db->query("select category_id,category_name FROM ".$this->procat_table." WHERE category_id = '".$catid."'");
		return $query->result_array();
	}
	
	function getcmspagename($cmsid)
	{
		$query = $this->db->query("select id,cms_title FROM ".$this->cms_table." WHERE id = '".$cmsid."'");
		return $query->result_array();
	}
	
	function getprimarytagname($ptagid)
	{ 
		$query = $this->db->query("select id,tag_name FROM ".$this->tags_table." WHERE id = '".$ptagid."'");
		return $query->result_array();
	}
	
	function getsecondarytagsname($ptagid)
	{ 
		$query = $this->db->query("select id,tag_name FROM ".$this->tags_table." WHERE id = '".$ptagid."'");
		return $query->result_array();
	}
	
	
	function insert_customlink()
	{ 
		$createdate = date('Y-m-d H:i:s');
		$data= array(
			"menu_id" => $this->input->post("menu_type_id"),
			"menu_type" => 'custom_link',
			"custom_link" => $this->input->post("custom_link"),
			"custom_link_title" => $this->input->post("custom_link_title"),
			"created_date"=> $createdate,
			"modified_date"=> $createdate
			);
		$this->db->insert($this->menulink_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	function insert_cmspage()
	{ 
		
		$createdate = date('Y-m-d H:i:s');
		if(isset($_REQUEST['pages']) && !empty($_REQUEST['pages'])){
			foreach($_REQUEST['pages'] as $page){
				$page_data = explode("_",$page);
				$link_id = @$page_data[0];
				$custom_link_title = @$page_data[1];
				
				$data= array(
					"menu_id" => $this->input->post("menu_type_id"),
					"menu_type" => 'cms_page',
					"custom_link_title" => $custom_link_title,
					"link_id" => $link_id,
					"created_date"=> $createdate,
					"modified_date"=> $createdate
					);
				$this->db->insert($this->menulink_table,$data);
				$id = $this->db->insert_id();
			}
		}	
		return $id;
	}
	
	
	function insert_primarytags()
	{ 
		
		$createdate = date('Y-m-d H:i:s');
		if(isset($_REQUEST['primarytags']) && !empty($_REQUEST['primarytags'])){
			foreach($_REQUEST['primarytags'] as $primarytags){
				$page_data = explode("_",$primarytags);
				$link_id = @$page_data[0];
				$custom_link_title = @$page_data[1];
				
				$data= array(
					"menu_id" => $this->input->post("menu_type_id"),
					"menu_type" => 'primary_tag',
					"custom_link_title" => $custom_link_title,
					"link_id" => $link_id,
					"created_date"=> $createdate,
					"modified_date"=> $createdate
					);
				$this->db->insert($this->menulink_table,$data);
				$id = $this->db->insert_id();
			}
		}	
		return $id;
	}
	
	function insert_secondarytag()
	{ 
		
		$createdate = date('Y-m-d H:i:s');
		if(isset($_REQUEST['secondarytag']) && !empty($_REQUEST['secondarytag'])){
			foreach($_REQUEST['secondarytag'] as $secondarytag){
				$page_data = explode("_",$secondarytag);
				$link_id = @$page_data[0];
				$custom_link_title = @$page_data[1];
				
				$data= array(
					"menu_id" => $this->input->post("menu_type_id"),
					"menu_type" => 'secondary_tag',
					"custom_link_title" => $custom_link_title,
					"link_id" => $link_id,
					"created_date"=> $createdate,
					"modified_date"=> $createdate
					);
				$this->db->insert($this->menulink_table,$data);
				$id = $this->db->insert_id();
			}
		}	
		return $id;
	}
	
	function getmenuname($menulinkid)
	{
		$query = $this->db->query("select custom_link_title from ".$this->menulink_table." WHERE id = '".$menulinkid."'");
		$resmenuname =  $query->result_array();
		return $resmenuname[0]['custom_link_title'];
	}
	function getmenunamedata($menulinkid)
	{
		$query = $this->db->query("select id,custom_link_title,custom_link from ".$this->menulink_table." WHERE id = '".$menulinkid."'");
		$resmenunamedata =  $query->result_array();
		return $resmenunamedata;
	}
	function update_customlink($menulinkids)
	{
		$createdate = date('Y-m-d H:i:s');
		$data= array(
			"custom_link_title" => $this->input->post("custom_link_title"),
			"custom_link" =>  $this->input->post("custom_link"),
			"modified_date"=> $createdate
			);
			$this->db->where('id', $menulinkids);
			$this->db->update($this->menulink_table, $data);
	}
	function insert_procat()
	{ 
		$createdate = date('Y-m-d H:i:s');
		if(isset($_REQUEST['procat']) && !empty($_REQUEST['procat'])){
			foreach($_REQUEST['procat'] as $procat){
				$data= array(
					"menu_id" => $this->input->post("menu_type_id"),
					"menu_type" => 'pro_cat',
					"link_id" => $procat,
					"created_date"=> $createdate,
					"modified_date"=> $createdate
					);
				$this->db->insert($this->menulink_table,$data);
				$id = $this->db->insert_id();
			}
		}	
		return $id;
	}
	
	function update_menu($menuid)
	{ 
		$menulevel_ids = $this->input->post("levelids");
		$ids = json_decode($menulevel_ids,true);
		
			$createdate = date('Y-m-d H:i:s');
			$this->db->query("update ".$this->menuss_table." set menuleve_data = '".$menulevel_ids."',modified_date = '".$createdate."' where id  = '".$menuid."'");
		
	}
	
	
	
	function delete_record($id)
	{
		$this->db->delete($this->menulink_table,array('id'=>$id));
	}
	
	function update_statusm($id)
	{
		$this->db->query('update '.$this->menulink_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->menulink_table.' set status = "active"  where id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->menulink_table.' set status = "inactive"  where id = "'.$id.'"');
	}
}
?>