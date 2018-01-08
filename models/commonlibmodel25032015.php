<?php
class Commonlibmodel extends CI_Model{

	function __construct()
	{
		$this->menulink_table 		  = "menulink";
		$this->menuss_table 		  = "menu";
		$this->cms_table 			  = "cmspage";
		$this->cmsblock_table 		  = "cms_block";
		$this->procat_table 		  = "products_categories";
		$this->product_table 		  = "products";
		$this->tags_table 			  = "tags";
		$this->general_settings_table = "general_settings";
		$this->socialmedia_table 	  = "socialmedia";
		$this->slider_table 		  = "slider";
		$this->slider_content_table   = "slider_content";
		$this->footer_table 		  = "footer";
		$this->newsletter_table 	  = "newsletter";
		$this->products_rel_table 	  = "product_cat_rel";
		$this->url_redirect_table 	  = "url_redirect";
	}
	function tokengenerat()
	{
		$token  = md5(rand(time (), true)) ;
		$this->session->set_userdata('token_ids',$token);
		return $token;
	}
	function getproducturl($proid)
	{
		$query = $this->db->query("select pc.slug from ".$this->products_rel_table." as pcr LEFT JOIN ".$this->procat_table." as pc ON(pc.category_id = pcr.cat_id)  WHERE pcr.product_id = '".$proid."' AND(pc.parent_id = '4' OR pc.parent_id = '246' OR pc.parent_id = '247' OR pc.parent_id = '248' OR pc.parent_id = '249' OR pc.category_id = '4' OR pc.category_id = '246' OR pc.category_id = '247' OR pc.category_id = '248' OR pc.category_id = '249') AND pc.status IN('active')");
		$categoryid = $query->result_array();
		foreach($categoryid  as $catid)
		{
			
			$catslugforpro[] = $catid['slug'];
		}
		$destination_slg = implode('-',$catslugforpro);
		return $destination_slg;
	}
	
	function getproductidtodestinationslug($proid)
	{
		$query = $this->db->query("select pc.slug from ".$this->products_rel_table." as pcr LEFT JOIN ".$this->procat_table." as pc ON(pc.category_id = pcr.cat_id)  WHERE pcr.product_id = '".$proid."' AND(pc.parent_id = '4' OR pc.parent_id = '246' OR pc.parent_id = '247' OR pc.parent_id = '248' OR pc.parent_id = '249' OR pc.category_id = '4' OR pc.category_id = '246' OR pc.category_id = '247' OR pc.category_id = '248' OR pc.category_id = '249') AND pc.status IN('active')");
		$categoryid = $query->row_array();
		return $categoryid['slug'];
	}
	
	function getredirecturl()
	{
		$query = $this->db->query("select old_url,new_url  from ".$this->url_redirect_table." WHERE status IN('active')");
		return $query->result_array();
	}
	
	function getproidtocatid($proid)
	{
		$query = $this->db->query("select prt.product_id,prt.cat_id from ".$this->products_rel_table." as prt LEFT JOIN ".$this->product_table." as p ON(prt.product_id = p.id) WHERE  prt.product_id = '".$proid."'");	
		return $query->row_array();
	}	
	
	/* CATEGROY ID TO SLUG */
	function getmetadetails($cmsid)
	{
		$query = $this->db->query("select meta_title,meta_keyword,meta_description,cms_title,cms_content,robots FROM ".$this->cms_table." WHERE id = '".$cmsid."'");
		return $query->row_array();
	}
	function getdestinationidtoname($catid)
	{
		$query = $this->db->query("select category_name FROM ".$this->procat_table." WHERE category_id = '".$catid."'");
		$catslug = $query->result_array();
		return $catslug[0]['category_name'];
	}
	
	function categorytoslug($catid)
	{
		$query = $this->db->query("select slug FROM ".$this->procat_table." WHERE category_id = '".$catid."'");
		$catslug = $query->result_array();
		return $catslug[0]['slug'];
	}
	
	function getcatslugtocatname($catslug)
	{
		$query = $this->db->query("select category_name FROM ".$this->procat_table." WHERE slug = '".$catslug."'");
		$catslug = $query->row_array();
		return $catslug['category_name'];
	}	function getcatslgtoUserid($catslug)
	{
		$query = $this->db->query("select user_details_id FROM ".$this->procat_table." WHERE slug = '".$catslug."'");
		$catslug = $query->row_array();
		return $catslug['user_details_id'];
	}
	function getmenutopageslug($pageid)
	{
		$query = $this->db->query("select slug FROM ".$this->cms_table." WHERE id = '".$pageid."'");
		$pageslug = $query->row_array();
		return $pageslug['slug'];
	}
	/* CATEGROY ID TO SLUG */
	
	/* PRODUCT ID TO SLUG */
	function producttoslug($proid)
	{
		$query = $this->db->query("select slug FROM ".$this->product_table." WHERE id = '".$proid."'");
		$proslug = $query->result_array();
		return $proslug[0]['slug'];
	}		
	function getproslugtoproname($proslug)
	{
		$query = $this->db->query("select product_name 	 FROM ".$this->product_table." WHERE slug = '".$proslug."'");
		$proslug = $query->row_array();
		return $proslug['product_name'];
	}
	/* PRODUCT ID TO SLUG */
	
	/* HOME PAGE CMS BLOCK  */
	function getcmsblock($id = '')
	{
		$query = $this->db->query("select * FROM ".$this->cmsblock_table." WHERE id = '".$id."' AND status IN('active')");
		return $query->result_array();
	}
	
	function getcanonicalurl($slug)
	{
		$query = $this->db->query("select canonical_url,robots FROM ".$this->tags_table." WHERE slug = '".$slug."'");
		return $query->row_array();
	}
	
	/* get URL Segments */
	function getIdFromSlug($select = 'id', $table = 'products_categories',$slug = '')
	{
		//echo "select ".$select." FROM ".$table." WHERE slug = '".$slug."' ";exit;
		$query = $this->db->query("select ".$select." FROM ".$table." WHERE slug = '".$slug."' ");
		$result = $query->result_array();
		if(isset($result[0]))
		{
			if(is_array($result)){
				$id = $result[0][''.$select.''];
			}
			else
			{
				$id = 0;	
			}
		}
		else
		{
			$id = 0;	
		}
		return $id;
		
	}
	function getIdFromSlugInfopage($select = 'id', $table = 'practical_information',$slug = '',$categoryid = '')
	{
		$query = $this->db->query("select ".$select." FROM ".$table." WHERE slug = '".$slug."' AND categories = '".$categoryid."' ");
		$result = $query->result_array();
		if(is_array($result)){
			$id = $result[0][''.$select.''];
		}else
		{
			$id = 0;	
		}
		return $id;
		
	}
	
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
	
	function toAscii($str) {
		$replace = array(
			'&lt;' => '', '&gt;' => '', '&#039;' => '', '&amp;' => '',
			'&quot;' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'Ae',
			'&Auml;' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'Æ' => 'Ae',
			'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Ď' => 'D', 'Đ' => 'D',
			'Ð' => 'D', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E',
			'Ę' => 'E', 'Ě' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G',
			'Ġ' => 'G', 'Ģ' => 'G', 'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I',
			'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
			'İ' => 'I', 'Ĳ' => 'IJ', 'Ĵ' => 'J', 'Ķ' => 'K', 'Ł' => 'K', 'Ľ' => 'K',
			'Ĺ' => 'K', 'Ļ' => 'K', 'Ŀ' => 'K', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N',
			'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
			'Ö' => 'Oe', '&Ouml;' => 'Oe', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O', 'Ŏ' => 'O',
			'Œ' => 'OE', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Š' => 'S',
			'Ş' => 'S', 'Ŝ' => 'S', 'Ș' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T',
			'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'Ue', 'Ū' => 'U',
			'&Uuml;' => 'Ue', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U',
			'Ŵ' => 'W', 'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'Ž' => 'Z',
			'Ż' => 'Z', 'Þ' => 'T', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
			'ä' => 'ae', '&auml;' => 'ae', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a',
			'æ' => 'ae', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
			'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e',
			'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e',
			'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h',
			'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i',
			'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j',
			'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l',
			'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n',
			'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'oe',
			'&ouml;' => 'oe', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'oe',
			'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ù' => 'u', 'ú' => 'u',
			'û' => 'u', 'ü' => 'ue', 'ū' => 'u', '&uuml;' => 'ue', 'ů' => 'u', 'ű' => 'u',
			'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y',
			'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'ß' => 'ss',
			'ſ' => 'ss', 'ый' => 'iy', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G',
			'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
			'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
			'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
			'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '',
			'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a',
			'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
			'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
			'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
			'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
			'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e',
			'ю' => 'yu', 'я' => 'ya'
		);

		$clean = str_replace(" ",'-', $str);
		$clean = str_replace(array_keys($replace),$replace,$clean);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/",'', $clean);
		$clean = str_replace("|",'', $clean);
		$clean = str_replace("--",'-', $clean);
		$clean = strtolower(trim($clean));
		return $clean;
	}
	
	function gettagtoslug($tag_name) {
		$query = $this->db->query("select slug FROM ".$this->tags_table." WHERE tag_name = '".mysql_real_escape_string($tag_name)."'");
		$taglug = $query->row_array();
		return $taglug['slug'];
	}
	function getslugtotag($slug) {
		$query = $this->db->query("select tag_name FROM ".$this->tags_table." WHERE slug = '".$slug."'");
		$taglug = $query->row_array();
		
		if(isset($taglug['tag_name']) && !empty($taglug['tag_name']))
		{
			$taglug = $taglug['tag_name'];
		}
		else
		{
			$taglug = '';
		}
		 
		 return $taglug;
	}
	
	function productprevnext($catid,$proslug,$catslug)
	{
		$query = $this->db->query("select p.display_order,pRel.product_id,pRel.cat_id from ".$this->products_rel_table." as pRel LEFT JOIN ".$this->product_table." as p ON pRel.product_id = p.id WHERE pRel.cat_id = '".$catid."' AND p.slug = '".$proslug."' AND p.status IN('active') ");
		$currentorder = $query->row_array();
		
		$query = $this->db->query("select p.slug,p.display_order,pRel.product_id,pRel.cat_id from ".$this->products_rel_table." as pRel LEFT JOIN ".$this->product_table." as p ON pRel.product_id = p.id WHERE pRel.cat_id = '".$catid."' AND p.display_order > '".$currentorder['display_order']."' AND p.status IN('active')  ORDER BY display_order ASC LIMIT 1");
		$nextpro = $query->row_array();
		
		$query = $this->db->query("select p.slug,p.display_order,pRel.product_id,pRel.cat_id from ".$this->products_rel_table." as pRel LEFT JOIN ".$this->product_table." as p ON pRel.product_id = p.id WHERE pRel.cat_id = '".$catid."' AND p.display_order < '".$currentorder['display_order']."' AND p.status IN('active') ORDER BY display_order DESC LIMIT 1");
		$prevpro = $query->row_array();
		$links = '';
		
		if(isset($nextpro) && !empty($nextpro))
		{
			$links .= "<div class='nextlink'><a href='".$this->config->site_url().$catslug."/voyages/".$nextpro['slug']."'>Next</a></div>";
		}
		if(isset($prevpro) && !empty($prevpro))
		{
			$links .= "<div class='prevlink'><a href='".$this->config->site_url().$catslug."/voyages/".$prevpro['slug']."'>Previous</a></div>";
		}	
		
		return $links;
		
	}
	
	
	function destinationprevnext($currentdestinationid)
	{
		$query = $this->db->query("select menu_title,id,menuleve_data  FROM ".$this->menuss_table." WHERE status IN('active') AND id='1' ");
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
						$menuurl[]= $this->getmenuidtocatid($menuleve2->id);
						
						if(isset($menuleve2->children) && !empty($menuleve2->children))
						{
							foreach($menuleve2->children as $menuleve3)
							{
								$menuurl[]= $this->getmenuidtocatid($menuleve3->id);
							}
							
						}
					}
					
				 }
			}
		}
		$links = '';
		foreach($menuurl as $key => $value)
		{
			if(isset($value) && !empty($value))
			{
				$emptyremove[] = $value;
			}
		}
		$index = array_search($currentdestinationid,$emptyremove);
		if($index !== FALSE)
		{
			
			if ( $index != count( $emptyremove ) - 1 )
   		    {
				$next = $emptyremove[$index + 1];
				$catslug = $this->categorytoslug($next);
				$links .= "<div class='prevlink'><a  href='".$this->config->site_url()."destination/".$catslug."'>Next</a></div>";
				
			}
			if($index != '0')
			{
				$prev = $emptyremove[$index - 1];
				$catslug = $this->categorytoslug($prev);
				$links .= "<div class='nextlink'><a href='".$this->config->site_url()."destination/".$catslug."'>Previous</a></div>";
			}
		}
		return $links;
		
	}
	

	
	function getmenuURL($id)
	{
		$query = $this->db->query("select * FROM ".$this->menulink_table." WHERE id = '".$id."'");
		$menudetails = $query->result_array();
		
		$mainmenuclass = $this->toAscii($this->getmenudetails($id));
		
		foreach($menudetails as $assmenulist)
		{
			if($assmenulist['menu_type'] == 'custom_link')
			{
				$CustomLink = $assmenulist['custom_link']; 
				if($assmenulist['clickable'] == 'yes')
				{
					$customlink = '<a href='.$CustomLink.'><span class="'.$mainmenuclass.'"></span>'.$assmenulist['custom_link_title'].'</a>';
				}
				else
				{
					$customlink ='<a><span class="'.$mainmenuclass.'"></span>'.$assmenulist['custom_link_title'].'</a>';
				}
				return $customlink;
			}
			if($assmenulist['menu_type'] == 'cms_page')
			{
				$cmspage 		= $this->getcmspagename($assmenulist['link_id']);
				$pageslugname   = $this->getmenutopageslug($assmenulist['link_id']);
				$cmslink = $this->config->base_url().$pageslugname;
				if($assmenulist['clickable'] == 'yes')
				{
					$CMSpagelink = '<a href='.$cmslink.'><span class="'.$mainmenuclass.'"></span>'.$cmspage[0]['cms_title'].'</a>';
				}
				else
				{
					$CMSpagelink ='<a><span class="'.$mainmenuclass.'"></span>'.$cmspage[0]['cms_title'].'</a>';
				}
				return $CMSpagelink;
				
			}
			if($assmenulist['menu_type'] == 'primary_tag')
			{
				$primerytag = $this->getsecondarytagsname($assmenulist['link_id']);
				$tagslugname  = $this->getmenutotagslug($assmenulist['link_id']);
				$taglink 	  = $this->config->base_url().'type-de-voyage/'.$tagslugname;
				if($assmenulist['clickable'] == 'yes')
				{
					$primarytaglink = '<a href='.$taglink.'><span class="'.$mainmenuclass.'"></span>'.$primerytag[0]['tag_name'].'</a>';
				}
				else
				{
					$primarytaglink ='<span class="'.$mainmenuclass.'"></span>'.$primerytag[0]['tag_name'];
				}
				return $primarytaglink;
			}
			if($assmenulist['menu_type'] == 'secondary_tag')
			{
				$secoundrytag = $this->getsecondarytagsname($assmenulist['link_id']);
				$tagslugname  = $this->getmenutotagslug($assmenulist['link_id']);
				$taglink 	  = $this->config->base_url().'type-de-voyage/'.$tagslugname;
				if($assmenulist['clickable'] == 'yes')
				{
					$secoundrytaglink = '<a href='.$taglink.'><span class="'.$mainmenuclass.'"></span>'.$secoundrytag[0]['tag_name'].'</a>';
				}
				else
				{
					$secoundrytaglink ='<span class="'.$mainmenuclass.'"></span>'.$secoundrytag[0]['tag_name'];
				}
				return $secoundrytaglink;
			}
			if($assmenulist['menu_type'] == 'pro_cat')
			{
				$procatname = $this->getcategoryname($assmenulist['link_id']);
				$slugname = $this->getslugname($assmenulist['link_id']);
				$procat = $this->config->base_url().'destination/'.$slugname;
				if($assmenulist['clickable'] == 'yes')
				{
					$PROcatlink = '<a href='.$procat.'><span class="'.$mainmenuclass.'"></span>'.$procatname[0]['category_name'].'</a>';
				}
				else
				{
					$PROcatlink ='<a><span class="'.$mainmenuclass.'"></span>'.$procatname[0]['category_name'].'</a>';
				}
				return $PROcatlink;
				
			}
		}
	}
	function getmenuURLdestination($id)
	{
		$query = $this->db->query("select * FROM ".$this->menulink_table." WHERE id = '".$id."'");
		$menudetails = $query->result_array();
		
		$mainmenuclass = $this->toAscii($this->getmenudetails($id));
		
		foreach($menudetails as $assmenulist)
		{
			
			if($assmenulist['menu_type'] == 'pro_cat')
			{
				$procatname = $this->getcategoryname($assmenulist['link_id']);
				$slugname = $this->getslugname($assmenulist['link_id']);
				$procat = $this->config->base_url().'destination/'.$slugname;
				if($assmenulist['clickable'] == 'yes')
				{
					$PROcatlink = '<a href='.$procat.'><span class="'.$mainmenuclass.'"></span>'.$procatname[0]['category_name'].'</a>';
				}
				else
				{
					$PROcatlink ='';
				}
				return $PROcatlink;
				
			}
		}
	}
	function getmenutotagslug($tagid)
	{
		$query = $this->db->query("select slug FROM ".$this->tags_table." WHERE id = '".$tagid."'");
		$tagslugname =  $query->row_array();
		return $tagslugname['slug'];
	}
	
	function getcategoryname($catid)
	{
		$query = $this->db->query("select category_id,category_name,image FROM ".$this->procat_table." WHERE category_id = '".$catid."'");
		return $query->result_array();
	}
	
	function getslugname($catid)
	{
		$query = $this->db->query("select slug FROM ".$this->procat_table." WHERE category_id = '".$catid."'");
		$slugname =  $query->row_array();
		return $slugname['slug'];
	}
	function getmenuidtocatid($menuid)
	{
		$query = $this->db->query("select link_id FROM ".$this->menulink_table." WHERE 	id 	 = '".$menuid."' AND clickable IN('yes')");
		$slugname =  $query->row_array();
		if(isset($slugname['link_id']) && !empty($slugname['link_id']))
		{
			return $slugname['link_id'];
		}
		else{
			return '';
		}
		
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
	/*=============== MAIN MENU GET =============================*/
	function getmenulist()
	{
		$query = $this->db->query("select menu_title,id,menuleve_data  FROM ".$this->menuss_table." WHERE status IN('active') AND id='1' ");
		return $query->result_array();
	}
	/*=============== MAIN MENU GET =============================*/
	
	public function menutreestructure($menuleve_data){
		$output = '';
		if(isset($menuleve_data) && !empty($menuleve_data))
		{
			foreach($menuleve_data as $menuleve)
			{	$mainmenuclass = '';
				$mainmenuclass = strtolower(trim($this->getmenuURL($menuleve['id'])));
				$output .='<li><h2>'.$this->getmenuURL($menuleve['id']).'</h2>';
							if(isset($menuleve['children']) && !empty($menuleve['children']))
							{
								$output .='<div class="menu_sub">';
									$i=0 ;
									foreach($menuleve['children'] as $menuleve2)
									{		$menuclass = '';
											if($i > 0){ $menuclass = "menu_sub_cols".$i; }
											 $output .='<div class="menu_sub_cols '.$menuclass.'">';
													if(isset($menuleve['id']) && !empty($menuleve['id']) && $menuleve['id'] == '321')
													{
														$output .='<h3>'.strip_tags($this->getmenuURL($menuleve2['id'])).'</h3>';
													}else
													{
														$output .='<ul>';
														$output .='<li><h3>'.strip_tags($this->getmenuURL($menuleve2['id']),'<a>').'</h3></li>';
														$output .='</ul>';
													}
												
														if(isset($menuleve2['children']) && !empty($menuleve2['children']))
														{
															$output .='<ul>';
															foreach($menuleve2['children'] as $menuleve3)
															{
																$output .='<li><h4>'.strip_tags($this->getmenuURL($menuleve3['id']),'<a>').'</h4></li>';
															}
															$output .='</ul>';
														}
													
											   $output .='</div>';
									$i++;}
								$output .='</div>';
							 }
					 $output .='</li>';
			}
		}
		return $output;
	}
	
	
	public function searchdestinationmenu($menuleve_data){

		$output = '';
		if(isset($menuleve_data) && !empty($menuleve_data))
		{
			foreach($menuleve_data as $menuleve)
			{	$mainmenuclass = '';
				
				if(isset($menuleve['id']) && !empty($menuleve['id']) && $menuleve['id'] == '321')
				{
					$output .='<li><label>Choisissez votre destination</label>';
							if(isset($menuleve['children']) && !empty($menuleve['children']))
							{
								$output .='<div class="menu_sub">';
									$i=0 ;
									foreach($menuleve['children'] as $menuleve2)
									{		$menuclass = '';
											if($i > 0){ $menuclass = "menu_sub_cols".$i; }
											 $output .='<div class="menu_sub_cols '.$menuclass.'">';
													
														$output .='<h2>'.strip_tags($this->getmenuURL($menuleve2['id'])).'</h2>';
													
														if(isset($menuleve2['children']) && !empty($menuleve2['children']))
														{
															$output .='<ul>';
															foreach($menuleve2['children'] as $menuleve3)
															{
																$output .='<li>'.strip_tags($this->getmenuURL($menuleve3['id']),'<a>').'</li>';
															}
															$output .='</ul>';
														}
													
											   $output .='</div>';
									$i++;}
								$output .='</div>';
							 }
					 $output .='</li>';
				}
			}
		}
		return $output;
	}
	
	function getfooter($id)
	{
		$query = $this->db->query("select * FROM ".$this->footer_table." WHERE id = '".$id."'");
		return $query->result_array();
	}
	
	function getgeneralsetting()
	{
		$query = $this->db->query("select * FROM ".$this->general_settings_table." WHERE id = '1'");
		return $query->result_array();
	}
	
	
	function getsocialicon()
	{
		$query = $this->db->query("select * FROM ".$this->socialmedia_table." WHERE status IN('active') ORDER BY display_order ASC LIMIT 0,4");
		return $query->result_array();
	}
	
	function getsocialiconSlider()
	{
		$query = $this->db->query("select * FROM ".$this->socialmedia_table." WHERE status IN('active') AND name != 'pinrest' ORDER BY display_order ASC LIMIT 0,3");
		return $query->result_array();
	}
	
	function insert_record()
	{
		$data= array(
			"name" => $this->input->post("nesname"),
			"email_id" => $this->input->post("nesemail"),
			"status" => 'Subscribed'
		);
		
		$this->db->insert($this->newsletter_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	
	function ContactAllFiledFrm()
	{
		return $this->load->view('form/allfieldfrm');
	}
	
	function getmenuidtoname($menuid)
	{
		$query = $this->db->query("select category_name FROM ".$this->procat_table." WHERE category_id = '".$menuid."'");
		$slugname =  $query->row_array();
		if(isset($slugname['category_name']) && !empty($slugname['category_name']))
		{
			return $slugname['category_name'];
		}
		else{
			return '';
		}
		
	}
	
	function ContactFiledFrm()
	{
		return $this->load->view('form/fieldfrm',true);
	}
	
	
	
	
}
