<?php

class Redirectmodel extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->url_redirect_table = "url_redirect";
		$this->rel_table  = "rel_attribute";
	}
	
	function getrelattributes()
	{
		$query = $this->db->query("SELECT attribute_name  FROM ".$this->rel_table."");
		$attributes = $query->result_array();
		return $attributes;
	}

	function geturldata()
	{
		$query = $this->db->query("select * from ".$this->url_redirect_table);
		return $query->result_array();
	}
	
	function geturlsname($id)
	{
		$query = $this->db->query("SELECT old_url FROM ".$this->url_redirect_table." WHERE id='".$id."'");
		$urlname = $query->result();
		return $urlname[0]->old_url;
	}
	
	
	function single_urldata($id)
	{
		$query = $this->db->get_where($this->url_redirect_table,array('id'=>$id));
		return $query->row_array();
	}
	
	function insert_record()
	{ 
		$createdate = date('Y-m-d H:i:s');
		$data= array(
			"old_url" => $this->input->post("old_url"),
			"new_url" => $this->input->post("new_url"),
			"is_seo" => $this->input->post("is_seo"),
			"meta_title" => $this->input->post("meta_title"),
			"meta_keyword"=> $this->input->post("meta_keyword"),
			"meta_description"=> $this->input->post("meta_description"),
			"status" => $this->input->post("status"),
			"robots" => $this->input->post("robots"),
			"rel"=> $this->input->post("rel"),
			"canonical_url"=> $this->input->post("canonical_url"),
			"is_display_on_sitemap" => $this->input->post("is_display_on_sitemap"),
			"created_date"=> $createdate,
			"modified_date"=> $createdate
		);
		$this->db->insert($this->url_redirect_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	
	function update_record()
	{
		$createdate = date('Y-d-m H:i:s');
		$data= array(
			"old_url" => $this->input->post("old_url"),
			"new_url" => $this->input->post("new_url"),
			"is_seo" => $this->input->post("is_seo"),
			"meta_title" => $this->input->post("meta_title"),
			"meta_keyword"=> $this->input->post("meta_keyword"),
			"meta_description"=> $this->input->post("meta_description"),
			"status" => $this->input->post("status"),
			"robots" => $this->input->post("robots"),
			"rel"=> $this->input->post("rel"),
			"canonical_url"=> $this->input->post("canonical_url"),
			"is_display_on_sitemap" => $this->input->post("is_display_on_sitemap"),
			"created_date"=> $createdate,
			"modified_date"=> $createdate
		);
		$this->db->where('id', $this->input->post('url_id'));
		$this->db->update($this->url_redirect_table, $data);
	}
	
	function delete_record($id)
	{
		$this->db->delete($this->url_redirect_table,array('id'=>$id));
	}
	
	function update_statusm($id)
	{
		$this->db->query('update '.$this->url_redirect_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->url_redirect_table.' set status = "active"  where id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->url_redirect_table.' set status = "inactive"  where id = "'.$id.'"');
	}
	

}
?>