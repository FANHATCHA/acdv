<?php
Class Clientreviewmodel extends CI_Model
{
	function __construct()
	{
		$this->clientreview_table = "clientreview";
	}
	
	function gettotalclientreview($total_limit)
	{
		$items_per_group = $total_limit;
		$query = $this->db->query("select id from ".$this->clientreview_table." WHERE status IN('active')");
		$totalnumrow = $query->num_rows();
		return ceil($totalnumrow/$items_per_group);
		
	}
	
	function getclientreviewdata($position,$items_per_group,$filtercondition)
	{
	//print_r("select * from ".$this->clientreview_table." WHERE status IN('active') ".$filtercondition." ORDER BY review_date DESC LIMIT ".$position.",".$items_per_group."");exit;
		$query = $this->db->query("select * from ".$this->clientreview_table." WHERE status IN('active') ".$filtercondition." ORDER BY review_date DESC LIMIT ".$position.",".$items_per_group."");
		return $query->result_array();
	}
	
	
	function getreviewdate()
	{
		$query = $this->db->query("select review_date from ".$this->clientreview_table." WHERE status IN('active') GROUP BY MONTH(review_date),YEAR(review_date) ORDER BY review_date DESC");
		return  $query->result_array();
		
	}
	
	function getclientreviewdestination()
	{
		$query = $this->db->query("select destination_id from ".$this->clientreview_table." WHERE status IN('active')");
		$reviewdestination = $query->result_array();
		$i = 0;
		foreach($reviewdestination as $reviewdestinations)
		{
				$review_desti[$i] = explode(',',$reviewdestination[$i]['destination_id']);
				$review_desti2[$i] = implode(',',$review_desti[$i]);
				$i++;
		}
		$implode_reviewdesti = implode(',',$review_desti2);
		$explode_reviewdata  = explode(',',$implode_reviewdesti);
		$removeunigdesti = array_unique($explode_reviewdata);
		return $removeunigdesti; 
		
	}
	
	
	
}
?>