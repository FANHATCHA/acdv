<?php
Class Frontblogmodel extends CI_Model
{
	function __construct()
	{
		$this->blog_table = "blog";
		$this->blog_cat_table = "blog_categories";
		$this->banner_image_table = "banner_images";
	}
	
	/* GET CATEGORY WISE BLOG */
	
	
	function getcategoryblogsALL($limit,$offset,$catid)
	{
		$currentdate = date('y-m-d H:i:s');
		$query = $this->db->query("select * from ".$this->blog_table." WHERE categories = '".$catid."' AND status IN('active') AND blog_date <= '".$currentdate."' ORDER BY created_date DESC LIMIT ".$offset.",".$limit."");
		return $query->result_array();
	}
	
	function gettotalcategoryblogALL($total_limit,$catid)
	{
		$items_per_group = $total_limit;
		$query = $this->db->query("select id from ".$this->blog_table." WHERE categories = '".$catid."' AND status IN('active')");
		$totalnumrow = $query->num_rows();
		return $totalnumrow;
	}
	function getarchiveblogsALL($limit,$offset,$year,$month)
	{
		$currentdate = date('y-m-d H:i:s');
		$query = $this->db->query("select * from ".$this->blog_table." WHERE MONTH(created_date) = '".$month."' AND YEAR(created_date) = '".$year."' AND status IN('active') AND blog_date <= '".$currentdate."' ORDER BY created_date DESC LIMIT ".$offset.",".$limit."");
		return $query->result_array();
	}
	function gettotalarchiveblogALL($total_limit,$year,$month)
	{
		$items_per_group = $total_limit;
		$query = $this->db->query("select id from ".$this->blog_table." WHERE MONTH(created_date) = '".$month."' AND YEAR(created_date) = '".$year."' AND status IN('active')");
		$totalnumrow = $query->num_rows();
		return $totalnumrow;
	}
	function gettotalblogALL($total_limit)
	{
		$items_per_group = $total_limit;
		$query = $this->db->query("select id from ".$this->blog_table." WHERE status IN('active')");
		$totalnumrow = $query->num_rows();
		return $totalnumrow;
	}
	function getallblogsALL($limit,$offset)
	{
		$currentdate = date('y-m-d H:i:s');
		$query = $this->db->query("select * from ".$this->blog_table." WHERE status IN('active') AND blog_date <= '".$currentdate."' ORDER BY created_date DESC LIMIT ".$offset.",".$limit."");
		return $query->result_array();
	}
	
	
	
	function gettotalcategoryblog($total_limit,$catid)
	{
		$items_per_group = $total_limit;
		$query = $this->db->query("select id from ".$this->blog_table." WHERE categories = '".$catid."' AND status IN('active')");
		$totalnumrow = $query->num_rows();
		return ceil($totalnumrow/$items_per_group);
	}
	function getcategoryblogs($position,$items_per_group,$catid)
	{
		$currentdate = date('y-m-d H:i:s');
		$query = $this->db->query("select * from ".$this->blog_table." WHERE categories = '".$catid."' AND status IN('active') AND blog_date <= '".$currentdate."'   ORDER BY created_date DESC LIMIT ".$position.",".$items_per_group."");
		return $query->result_array();
	}
	/* GET CATEGORY WISE BLOG */
	
	/* GET archive WISE BLOG */
	function gettotalarchiveblog($total_limit,$year,$month)
	{
		$items_per_group = $total_limit;
		$query = $this->db->query("select id from ".$this->blog_table." WHERE MONTH(created_date) = '".$month."' AND YEAR(created_date) = '".$year."' AND status IN('active')");
		$totalnumrow = $query->num_rows();
		return ceil($totalnumrow/$items_per_group);
	}
	function getarchiveblogs($position,$items_per_group,$year,$month)
	{
		$currentdate = date('y-m-d H:i:s');
		$query = $this->db->query("select * from ".$this->blog_table." WHERE MONTH(created_date) = '".$month."' AND YEAR(created_date) = '".$year."' AND status IN('active') AND blog_date <= '".$currentdate."' ORDER BY created_date DESC LIMIT ".$position.",".$items_per_group."");
		return $query->result_array();
	}
	
	/* GET archive WISE BLOG */
	
	/* GET ALL BLOG */
	function gettotalblog($total_limit)
	{
		$items_per_group = $total_limit;
		$query = $this->db->query("select id from ".$this->blog_table." WHERE status IN('active')");
		$totalnumrow = $query->num_rows();
		return ceil($totalnumrow/$items_per_group);
	}
	function getallblogs($position,$items_per_group)
	{
		$currentdate = date('y-m-d H:i:s');
		$query = $this->db->query("select * from ".$this->blog_table." WHERE status IN('active') AND blog_date <= '".$currentdate."' ORDER BY created_date DESC LIMIT ".$position.",".$items_per_group."");
		return $query->result_array();
	}
	/* GET ALL BLOG */
	
	function counthits($id)
	{
		$query = $this->db->query("select hits from ".$this->blog_table." WHERE id = '".$id."'");
		$oldhitscount = $query->result_array();
		$total_count = $oldhitscount[0]['hits'] + 1;
		$this->db->query('update '.$this->blog_table.' set hits = '.$total_count.' where id = "'.$id.'"');
	}
	function getblogsdata($id)
	{
		$query = $this->db->get_where($this->blog_table,array('id'=>$id));
		return $query->result_array();
	}
	function getcategory()
	{
		$query = $this->db->query("select category_id,category_name,slug from ".$this->blog_cat_table." WHERE status IN('active') ORDER BY category_name ASC");
		return $query->result_array();
		
	}
	function getrecentarticles()
	{
		$currentdate = date('y-m-d H:i:s');
		$query = $this->db->query("select created_date,blog_title,id,slug from ".$this->blog_table." WHERE status IN('active') AND blog_date <= '".$currentdate."' ORDER BY created_date DESC LIMIT 0,4");
		return $query->result_array();
	}
	function getarchive()
	{
		$query = $this->db->query("select count(MONTH(created_date)) as countmonth,created_date,blog_title,id,slug from ".$this->blog_table." WHERE status IN('active') GROUP BY MONTH(created_date),YEAR(created_date) ORDER BY created_date DESC");
		return $query->result_array();
	}
	function getmostview()
	{
		$query = $this->db->query("select created_date,blog_title,id,slug,hits from ".$this->blog_table." WHERE status IN('active') ORDER BY hits DESC LIMIT 0,4");
		return $query->result_array();
	}
	function getblogslider($id)
	{
		$query = $this->db->query("select slider_id  from ".$this->blog_table." WHERE id = '".$id."'");
		$dest_sliderid = $query->result_array();
		$query = $this->db->query("select banner_image from ".$this->banner_image_table." WHERE banner_id= '".$dest_sliderid[0]['slider_id']."'");
		return $query->result_array();
	}
	
}
?>