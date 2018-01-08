<?php
class Homemodel extends CI_Model{

	function __construct()
	{
		
		$this->menulink_table = "menulink";
		$this->menuss_table = "menu";
		$this->cms_table = "cmspage";
		$this->cmsblock_table = "cms_block";
		$this->countdown_table = "countdown";
		$this->procat_table = "products_categories";
		$this->product_table = "products";
		$this->tags_table = "tags";
		$this->general_settings_table = "general_settings";
		$this->socialmedia_table = "socialmedia";
		$this->slider_table = "slider";
		$this->slider_content_table = "slider_content";
		$this->footer_table = "footer";
		$this->newsletter_table = "newsletter";
		$this->clientreview_table = "clientreview";
		$this->userdetails_table = "user_details";
	}
	
	function getproidtoproname($proid)
	{
		$query = $this->db->query("select product_name,price from ".$this->product_table." WHERE id = '".$proid."'");
		return $query->row_array();
	}
	
	function getPromotingOffers()
	{
		$query = $this->db->query("select * FROM ".$this->countdown_table." WHERE status IN('active') ORDER BY id DESC LIMIT 0,3");
		return $query->result_array();
	}
	
	function getcmsblock($id = '')
	{
		$query = $this->db->query("select * FROM ".$this->cmsblock_table." WHERE id = '".$id."' AND status IN('active')");
		return $query->result_array();
	}
	
	function gethomeslider($id)
	{
		$query = $this->db->query("select * FROM ".$this->slider_content_table." WHERE slider_id = '".$id."'");
		return $query->result_array();
	}
	
	function getgallery($id)
	{
		$query = $this->db->query("select * FROM ".$this->slider_content_table." WHERE slider_id = '".$id."'");
		return $query->result_array();
	}
	
	function getclientreview()
	{
		$query = $this->db->query("select clientreview_clickble,client_rating,name,thems_name,client_review,destination_id FROM ".$this->clientreview_table." WHERE status IN('active') ORDER BY review_date DESC LIMIT 0,5");
		return $query->result_array();
	}
	
	function getclientuserdetails($position = '')
	{
		$query = $this->db->query("select userblock_clickble,clickble_link,user_name,position,image FROM ".$this->userdetails_table." WHERE show_home_position = '".$position."' AND show_home IN(1) ORDER BY id DESC LIMIT 0,1");
		return $query->row_array();
	}
	
}
