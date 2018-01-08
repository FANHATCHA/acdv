<?php
Class Contactmodel extends CI_Model
{
	function __construct()
	{
		$this->contact_table = "contacts";
		$this->quotation_form_table = "quotation_form_data";
	}
	
	function insert_record()
	{
		$createdate = date('Y-m-d H:i:s');
		$accept = $this->input->post("accept");
		if(isset($accept) && !empty($accept) )
		{
			$accept = 'yes';
		}
		else
		{
			$accept = 'no';
		}
		$data= array(
			"firstname" => $this->input->post("firstname"),
			"lastname" => $this->input->post("lastname"),
			"email" => $this->input->post("email"),
			"phone" => $this->input->post("phone"),
			"comments" => mysql_real_escape_string($this->input->post("comment")),
			"destination" => "",
			"product" => "",
			"type" => "contact",
			"created_date"=> $createdate,
			"modified_date"=> $createdate,
			"accept"=> $accept
		);
		$this->db->insert($this->contact_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	function insert_record_requestform_mariage()
	{
		$createdate = date('Y-m-d H:i:s');
		$accept = $this->input->post("accept");
		if(isset($accept) && !empty($accept) )
		{
			$accept = 'yes';
		}
		else
		{
			$accept = 'no';
		}
		$data= array(
			"firstname" => $this->input->post("firstname"),
			"email" => $this->input->post("email"),
			"phone" => $this->input->post("phone"),
			"comments" => mysql_real_escape_string($this->input->post("comment")),
			"destination" => $this->input->post("destination"),
			"product" => "",
			"type" => "mariage",
			"created_date"=> $createdate,
			"modified_date"=> $createdate,
			"accept"=> $accept
		);
		$this->db->insert($this->contact_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	function insert_record_requestform_allfield($currentid,$pageurls)
	{
		session_start();
		header('Content-Type: text/html; charset=utf-8');
		
		$id = '';
		
		$dest 		= $this->input->post("dest");
		$name 		= $this->input->post("name");
		$firstname  = $this->input->post("firstname");
		$email 		= $this->input->post("email");
		$phoneno 	= $this->input->post("phoneno");
		$price 		= $this->input->post("price");
		$startdate  = date('Y-m-d H:i:s',strtotime($this->input->post("from")));
		$enddate    = date('Y-m-d H:i:s',strtotime($this->input->post("to")));
		$captcha 	= $this->input->post("captcha");
		
		if(!isset($dest) && empty($dest) || $dest == '-1')
		{
			return $id;
		}
		if(!isset($name) && empty($name))
		{
			return $id;
		}
		if(!isset($firstname) && empty($firstname))
		{
			return $id;
		}
		if(!isset($email) && empty($email))
		{
			return $id;
		}
		if(!isset($phoneno) && empty($phoneno))
		{
			return $id;
		}
		if(!isset($price) && empty($price))
		{
			return $id;
		}
		if(!isset($startdate) && empty($startdate) && !isset($enddate) && empty($enddate))
		{
			return $id;
		}
		if($captcha != $_SESSION['vercode'])
		{
			return $id;
		}
		
		
		$createdate = date('Y-m-d H:i:s');
		$seul 			= $this->input->post("seul");
		$couple 		= $this->input->post("couple");
		$EnFamillead 	= $this->input->post("adults");
		$EnFamillech 	= $this->input->post("children");
		$EnGroupead		= $this->input->post("adults3");
		$EnGroupech 	= $this->input->post("children3");
		$famille		= 'no';
		$groupe			= 'no';
		if(isset($currentid) && !empty($currentid) && $currentid == '#tab-4')
		{
			if(isset($seul) && !empty($seul))
			{
				$seul = 'yes';
			}
			else
			{
				$seul = 'no';
			}
		}
		else
		{$seul = 'no';}
		if(isset($currentid) && !empty($currentid) && $currentid == '#tab-1')
		{
			if(isset($couple) && !empty($couple))
			{
				$couple = 'yes';
			}
			else
			{
				$couple = 'no';
			}
		}
		else
		{$couple = 'no';}
		if(isset($currentid) && !empty($currentid) && $currentid == '#tab-2')
		{
			$famille = 'yes';
			if(!empty($EnFamillead) || !empty($EnFamillech))
			{ 
				$EnFamillead = $this->input->post("adults");
				$EnFamillech = $this->input->post("children");
			}
		}else
		{$famille = 'no';}
		if(isset($currentid) && !empty($currentid) && $currentid == '#tab-3')
		{	
			$groupe = 'yes';
			if(!empty($EnGroupead) || !empty($EnGroupech))
			{
				$EnGroupead = $this->input->post("adults3");
				$EnGroupech = $this->input->post("children3");
			}
		}else
		{$groupe = 'no';}
		$flexibles = $this->input->post("flexibles");
		if(isset($flexibles) && !empty($flexibles))
		{
			$flexibles = 'yes';
		}
		else
		{
			$flexibles = 'no';
		}
		$startdate = date('Y-m-d H:i:s',strtotime($this->input->post("from")));
		$enddate   = date('Y-m-d H:i:s',strtotime($this->input->post("to")));
		$price 	   = $this->input->post("price");
		$comments  = $this->input->post("comment");
		$accept = $this->input->post("accept");
		if(isset($accept) && !empty($accept))
		{
			$accept = 'yes';
		}
		else
		{
			$accept = 'no';
		}
		$data= array(
			"form_type" 			=> 'other',
			"destination_id" 		=> $this->input->post("dest"),
			"firstname"				=> $this->input->post("name"),
			"lastname" 				=> $this->input->post("firstname"),
			"email" 				=> $this->input->post("email"),
			"telephone" 			=> $this->input->post("phoneno"),
			"single"				=> $seul,
			"couple" 				=> $couple,
			"famille" 				=> $famille,
			"famille_adultes"		=> $EnFamillead,
			"famille_enfants"		=> $EnFamillech,
			"groupe" 				=> $groupe,
			"groupe_adultes" 		=> $EnGroupead,
			"groupe_enfants" 		=> $EnGroupech ,
			"startdate"				=> $startdate,
			"enddate"				=> $enddate,
			"date_flexibles"		=> $flexibles,
			"price" 				=> $price,
			"comments"				=> mysql_real_escape_string($comments),
			"accepte"				=> $accept,
			"created_date"			=> $createdate,
			"modified_date" 		=> $createdate,
			"pageurl"				=> $pageurls
		);
		$this->db->insert($this->quotation_form_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
	function insert_record_requestform_prodestination($currentid,$pageurls)
	{
		session_start();
		$productname 	 = $this->input->post("productname");
		$destinationname = $this->input->post("destinationname");
		$name			 = $this->input->post("name");
		$firstname		 = $this->input->post("firstname");
		$email			 = $this->input->post("email");
		$phoneno		 = $this->input->post("phoneno");
		$price 	  		 = $this->input->post("price");
		$captcha 	  	 = $this->input->post("captcha");
		$startdate		 = date('Y-m-d H:i:s',strtotime($this->input->post("from")));
		$enddate  		 = date('Y-m-d H:i:s',strtotime($this->input->post("to")));
		$id = '';
		
		if(!isset($productname) && empty($productname) || !isset($destinationname) && empty($destinationname))
		{
			return $id;
		}
		if(!isset($name) && empty($name))
		{
			return $id;
		}
		if(!isset($firstname) && empty($firstname))
		{
			return $id;
		}
		if(!isset($email) && empty($email))
		{
			return $id;
		}
		if(!isset($phoneno) && empty($phoneno))
		{
			return $id;
		}
		if(!isset($price) && empty($price))
		{
			return $id;
		}
		if(!isset($startdate) && empty($startdate) && !isset($enddate) && empty($enddate))
		{
			return $id;
		}
		if($captcha != $_SESSION['vercode'])
		{
			return $id;
		}
		
		$createdate = date('Y-m-d H:i:s');
		$seul 			= $this->input->post("seul");
		$couple 		= $this->input->post("couple");
		$EnFamillead 	= $this->input->post("adults");
		$EnFamillech 	= $this->input->post("children");
		$EnGroupead		= $this->input->post("adults3");
		$EnGroupech 	= $this->input->post("children3");
		$famille		= 'no';
		$groupe			= 'no';
		
		if(isset($currentid) && !empty($currentid) && $currentid == '#tab-4')
		{
			if(isset($seul) && !empty($seul))
			{
				$seul = 'yes';
			}
			else
			{
				$seul = 'no';
			}
		}
		else
		{$seul = 'no';}
		
		if(isset($currentid) && !empty($currentid) && $currentid == '#tab-1')
		{
			if(isset($couple) && !empty($couple))
			{
				$couple = 'yes';
			}
			else
			{
				$couple = 'no';
			}
		}
		else
		{$couple = 'no';}
		if(isset($currentid) && !empty($currentid) && $currentid == '#tab-2')
		{
			$famille = 'yes';
			if(!empty($EnFamillead) || !empty($EnFamillech))
			{ 
				$EnFamillead = $this->input->post("adults");
				$EnFamillech = $this->input->post("children");
			}
		}else
		{$famille = 'no';}
		if(isset($currentid) && !empty($currentid) && $currentid == '#tab-3')
		{	
			$groupe = 'yes';
			if(!empty($EnGroupead) || !empty($EnGroupech))
			{
				$EnGroupead = $this->input->post("adults3");
				$EnGroupech = $this->input->post("children3");
			}
		}else
		{$groupe = 'no';}
		$flexibles = $this->input->post("flexibles");
		if(isset($flexibles) && !empty($flexibles))
		{
			$flexibles = 'yes';
		}
		else
		{
			$flexibles = 'no';
		}
		$startdate = date('Y-m-d H:i:s',strtotime($this->input->post("from")));
		$enddate   = date('Y-m-d H:i:s',strtotime($this->input->post("to")));
		$price 	   = $this->input->post("price");
		$comments  = $this->input->post("comment");
		$accept = $this->input->post("accept");
		if(isset($accept) && !empty($accept))
		{
			$accept = 'yes';
		}
		else
		{
			$accept = 'no';
		}
		
		
		if(isset($productname) && !empty($productname))
		{
			$data= array(
				"form_type" 			=> 'Product',
				"product_id" 			=> $productname,
				"firstname"				=> $this->input->post("name"),
				"lastname" 				=> $this->input->post("firstname"),
				"email" 				=> $this->input->post("email"),
				"telephone" 			=> $this->input->post("phoneno"),
				"single"				=> $seul,
				"couple" 				=> $couple,
				"famille" 				=> $famille,
				"famille_adultes"		=> $EnFamillead,
				"famille_enfants"		=> $EnFamillech,
				"groupe" 				=> $groupe,
				"groupe_adultes" 		=> $EnGroupead,
				"groupe_enfants" 		=> $EnGroupech ,
				"startdate"				=> $startdate,
				"enddate"				=> $enddate,
				"date_flexibles"		=> $flexibles,
				"price" 				=> $price,
				"comments"				=> mysql_real_escape_string($comments),
				"accepte"				=> $accept,
				"created_date"			=> $createdate,
				"modified_date" 		=> $createdate,
				"pageurl"				=> $pageurls
			);
		}
		else if(isset($destinationname) && !empty($destinationname))
		{
			$data= array(
				"form_type" 			=> 'Destination',
				"destination_id" 		=> $destinationname,
				"firstname"				=> $this->input->post("name"),
				"lastname" 				=> $this->input->post("firstname"),
				"email" 				=> $this->input->post("email"),
				"telephone" 			=> $this->input->post("phoneno"),
				"single"				=> $seul,
				"couple" 				=> $couple,
				"famille" 				=> $famille,
				"famille_adultes"		=> $EnFamillead,
				"famille_enfants"		=> $EnFamillech,
				"groupe" 				=> $groupe,
				"groupe_adultes" 		=> $EnGroupead,
				"groupe_enfants" 		=> $EnGroupech ,
				"startdate"				=> $startdate,
				"enddate"				=> $enddate,
				"date_flexibles"		=> $flexibles,
				"price" 				=> $price,
				"comments"				=> mysql_real_escape_string($comments),
				"accepte"				=> $accept,
				"created_date"			=> $createdate,
				"modified_date" 		=> $createdate,
				"pageurl"				=> $pageurls
			);
		}
		
		$this->db->insert($this->quotation_form_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	function insert_record_maries()
	{
		$createdate = date('Y-m-d H:i:s');
		$data= array(
			"firstname" => $this->input->post("firstname"),
			"lastname" => "",
			"email" => $this->input->post("email"),
			"phone" => $this->input->post("phone"),
			"comments" => mysql_real_escape_string($this->input->post("comment")),
			"destination" => $this->input->post("destination"),
			"product" => "",
			"type" => "maries",
			"created_date"=> $createdate,
			"modified_date"=> $createdate
		);
		$this->db->insert($this->contact_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
}
?>