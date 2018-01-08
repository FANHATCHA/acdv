<?php
class Promodemandededevis extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("Demandededevismodel");
		$this->load->helper("url");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library("email");
		$this->load->model("commonlibmodel");
		/*======================= LOAD COMMON LIBRARY ===================*/
		$this->load->library('commonlib');
		/*======================= LOAD COMMON LIBRARY ===================*/
				
	}
	function view() 
	{
		$commod = new Commonlibmodel();
		$query = $this->db->query("select menu_title,id,menuleve_data FROM menu WHERE status IN('active') AND id='1' ");
		$menulaveldata =  $query->row_array();
		$destinationmenu = json_decode($menulaveldata['menuleve_data']);
		$menuurl = array();
		foreach($destinationmenu as $menudata)
		{
			if(isset($menudata->id) && !empty($menudata->id) && $menudata->id == '321')
			{	
				if(isset($menudata->children) && !empty($menudata->children))
				{
					foreach($menudata->children as $menuleve2)
					{	
						if(isset($menuleve2->children) && !empty($menuleve2->children))
						{
							foreach($menuleve2->children as $menuleve3)
							{
								$catid 		= $this->commonlibmodel->getmenuidtocatid($menuleve3->id);
								$catname[] = $this->commonlibmodel->getmenuidtoname($catid);
							}
						}
					}
					
				 }
			}
		}
		$this->data['catname'] = $catname;
		
		$pagemetadesc = $this->commonlibmodel->getmetadetails(94);
		if(isset($pagemetadesc['meta_title']) && !empty($pagemetadesc['meta_title']))
		{
			$pagetitle = $pagemetadesc['meta_title'] ;
		}
		else
		{
			$pagetitle = $pagemetadesc['cms_title'] ;
		}
		$this->headerdata["page_title"] = $pagetitle;
		$this->headerdata["page_head"]  = $pagetitle;
		$this->headerdata["meta_desc"]  = $pagemetadesc['meta_description'];
		$this->headerdata["meta_key"]   = $pagemetadesc['meta_keyword'];
		$this->headerdata["robots"]     = $pagemetadesc['robots'];
		//$this->headerdata["canonical"]  = $this->config->base_url().$this->uri->uri_string;
	
		$this->load->view('promodemandededevis/view',$this->data);
	}
	
}
?>