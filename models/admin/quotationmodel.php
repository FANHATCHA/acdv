<?php

class quotationmodel extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->quotation_from_table = "quotation_form_data";
	}
	
	public function getquotationdata($limit,$offset,$search)
	{
		$where = '';
		if(isset($search) && !empty($search))
		{
			$search_e = explode(' ',$search);
			if(isset($search_e) && !empty($search_e))
			{
				$i = 1;
				foreach($search_e as $search_e_s)
				{	
					if($i == 1)
					{
						$where .= ' WHERE email LIKE "%'.$search_e_s.'%" OR firstname LIKE "%'.$search_e_s.'%" OR lastname LIKE "%'.$search_e_s.'%" OR form_type LIKE "%'.$search_e_s.'%"';
					}
					else
					{
						$where .= ' OR email LIKE "%'.$search_e_s.'%" OR firstname LIKE "%'.$search_e_s.'%" OR lastname LIKE "%'.$search_e_s.'%" OR form_type LIKE "%'.$search_e_s.'%"';
					}
					$i++;
				}
			}
		}
		
		/*echo "select * from ".$this->quotation_from_table." ".$where." ORDER BY created_date DESC LIMIT ".$offset.",".$limit."";
		exit;*/
		$query = $this->db->query("select * from ".$this->quotation_from_table." ".$where." ORDER BY created_date DESC LIMIT ".$offset.",".$limit."");
		return $query->result_array();
	}
	
	public function getsingleformdata($id)
	{
		$query = $this->db->query("select * from ".$this->quotation_from_table." WHERE quotation_id = '".$id."'");
		return $query->result_array();
	}
	
	public function delete_record($id)
	{
		$this->db->delete($this->quotation_from_table,array('quotation_id'=>$id));
	}
	
	public function gettotalquotationdata($search)
	{
		$where = '';
		if(isset($search) && !empty($search))
		{
			$search_e = explode(' ',$search);
			if(isset($search_e) && !empty($search_e))
			{
				$i = 1;
				foreach($search_e as $search_e_s)
				{	
					if($i == 1)
					{
						$where .= ' WHERE email LIKE "%'.$search_e_s.'%" OR firstname LIKE "%'.$search_e_s.'%" OR lastname LIKE "%'.$search_e_s.'%" OR form_type LIKE "%'.$search_e_s.'%"';
					}
					else
					{
						$where .= ' OR email LIKE "%'.$search_e_s.'%" OR firstname LIKE "%'.$search_e_s.'%" OR lastname LIKE "%'.$search_e_s.'%" OR form_type LIKE "%'.$search_e_s.'%"';
					}
					$i++;
				}
			}
		}
		
		$query 		   =  $this->db->query("SELECT quotation_id FROM ".$this->quotation_from_table." ".$where." ");
		$totalnumrow   =  $query->num_rows();
		return $totalnumrow;
	}
}
?>