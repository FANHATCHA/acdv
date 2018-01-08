<?php

class newslettermodel extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->newsletter_table = "newsletter";
	}
	
	function getnewsletterdata()
	{
		$query = $this->db->query("select * from ".$this->newsletter_table);
		return $query->result_array();
	}
	
	function delete_record($id)
	{
		$this->db->delete($this->newsletter_table,array('id'=>$id));
	}
	
	function update_newsletter_status($id)
	{
		$this->db->query('update '.$this->newsletter_table.' set status = case when status="Subscribed" then "Unsubscribed" else "Subscribed" end where id = "'.$id.'"');
	}
	function update_status_subscribed($id)
	{
		$this->db->query('update '.$this->newsletter_table.' set status = "Subscribed"  where id = "'.$id.'"');
	}
	function update_status_unsubscribed($id)
	{
		$this->db->query('update '.$this->newsletter_table.' set status = "Unsubscribed" where id = "'.$id.'"');
	}
	
}
?>