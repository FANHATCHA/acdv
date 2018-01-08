<?php
/*===========================================================================================
||			 -------------------- HOME CONTROLLER -------------------						||
||																				   			||
||																							||
=============================================================================================*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function Home()
	{
		parent::__construct();	
		//$this->output->cache(1400);
		$this->load->model("homemodel");
		$this->load->model("commonlibmodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library("email");
		$this->load->library("mailin");
		$key = 'home';
		//$this->lang->load('defines_front', 'english');
		/*======================= LOAD COMMON LIBRARY ===================*/
		$this->load->library('commonlib');
		/*======================= LOAD COMMON LIBRARY ===================*/
	}
	
	
	public function index()
	{
			$this->data["homeslider"]  	= $this->homemodel->gethomeslider(33);
			$this->data["homegallery"] 	= $this->homemodel->getgallery(34);
			$this->data["cmsblock1"]  	= $this->homemodel->getcmsblock(11);
			$this->data["cmsblock2"]  	= $this->homemodel->getcmsblock(6);
			$this->data["cmsblock3"] 	= $this->homemodel->getcmsblock(7);
			$this->data["cmsblock4"]    = $this->homemodel->getcmsblock(1);
			$this->data["slider1"]      = $this->homemodel->getcmsblock(8);
			$this->data["slider2"]      = $this->homemodel->getcmsblock(9);
			$this->data["slider3"]      = $this->homemodel->getcmsblock(10);
			/* ================= SPECIAL OFFERS ==========================*/
			/*$this->data["slider12"]     = $this->homemodel->getcmsblock(12);
			$this->data["slider13"]     = $this->homemodel->getcmsblock(13);
			$this->data["slider14"]     = $this->homemodel->getcmsblock(14);*/
			$this->data["PromotingOffers"]     = $this->homemodel->getPromotingOffers();
			/* ================= SPECIAL OFFERS ==========================*/
			/* ============= Lacommunaute PART ===================*/
			$this->data["homelacommunauteclientlogos"]  = $this->homemodel->getcmsblock(16);
			$this->data["clientreview"] 			    = $this->homemodel->getclientreview();
			$this->data["userdetails_left"] 			= $this->homemodel->getclientuserdetails('left');
			$this->data["userdetails_right"]  			= $this->homemodel->getclientuserdetails('right');
			/* ============= Lacommunaute PART ===================*/
			$this->headerdata = $this->commonlib->headerdata();
			$this->footerdata = $this->commonlib->footerdata();
			$pagemetadesc = $this->commonlibmodel->getmetadetails(97);
			if(isset($pagemetadesc['meta_title']) && !empty($pagemetadesc['meta_title']))
			{
				$pagetitle = $pagemetadesc['meta_title'] ;
			}
			else
			{
				$pagetitle = $pagemetadesc['cms_title'] ;
			}
			$this->headerdata["page_title"] 	= $pagetitle;
			$this->headerdata["page_head"]  = $pagetitle;
			$this->headerdata["meta_desc"]  = $pagemetadesc['meta_description'];
			$this->headerdata["meta_key"]   = $pagemetadesc['meta_keyword'];
			$this->headerdata["robots"]     = $pagemetadesc['robots'];
			//$this->headerdata["canonical"]  = $this->config->base_url().$this->uri->uri_string;
			$this->load->view("common/header",$this->headerdata);
			$this->load->view('home',$this->data);
			$this->load->view("common/footer",$this->footerdata);
			
			//$this->scache->write($key, $cache);
			//$cache = $this->load->view('home', $data, true);
			//$this->load->view('home', array('segment'=>$cache));
		
	}
	
	public function subscribe()
	{
		
		/* CLEAR CATCH CODE */
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Connection: close");
		/* CLEAR CATCH CODE */
		
		$this->form_validation->set_rules("nesname","nesname","required");
		$this->form_validation->set_rules("nesemail","nesemail","required");
		$this->form_validation->set_rules('nesemail', 'nesemail', 'callback_check_dups');
		
		$formemail = $this->input->post('nesemail');
		$admindetails  = $this->commonlibmodel->getgeneralsetting();
		$url = $_SERVER['HTTP_REFERER'];
		
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->commonlibmodel->insert_record();
			
			
			/************ subscribe on API *****************/
			$name = $this->input->post("nesname");
			$email = $this->input->post("nesemail");
			$listid = 9;
			$reference_id = 1;
			$info = array();
			$suserdata = $this->session->all_userdata();
			$info['PHPSESSID'] = $suserdata['session_id'];
			$info['sib_form_list_id'] = $listid;
			$info['reference_id'] = $reference_id;
			$info['email'] = $email;
			$info['name'] = $name;
			
			$mailin = new Mailin('https://api.sendinblue.com/v2.0','bMcBhgaLY7XHrJUZ');  
			
			$attributes = array("NAME"=>$name);
			$blacklisted = 0;
			$listid = array(9);
			$listid_unlink = array();
			$blacklisted_sms = 0;
			$response = $mailin->create_update_user($email,$attributes,$blacklisted,$listid,$listid_unlink,$blacklisted_sms);
			
			//var_dump($response);
			/****************************************************/
			
			
			$name = $this->input->post("nesname");
			$email = $this->input->post("nesemail");
			
			
			$htmlmail ='';
			$htmlmail .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0"><meta name="format-detection" content="telephone=no"><style type="text/css">
			.ReadMsgBody { width: 100%; background-color: #ebebeb;}
			.ExternalClass {width: 100%; background-color: #ebebeb;}
			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
			body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
			body {margin:0; padding:0;}
			table {border-spacing:0;}
			table td {border-collapse:collapse;}
			.yshortcuts a {border-bottom: none !important;}
			.rnb-del-min-width{ min-width: 0 !important; }
			/* Image width by default for 3 columns */
			img[class="rnb-col-3-img"] {
			max-width:170px;
			}
			/* Image width by default for 2 columns */
			img[class="rnb-col-2-img"] {
			max-width:264px;
			}
			/* Image width by default for 2 columns aside small size */
			img[class="rnb-col-2-img-side-xs"] {
			max-width:180px;
			}
			/* Image width by default for 2 columns aside big size */
			img[class="rnb-col-2-img-side-xl"] {
			max-width:350px;
			}
			/* Image width by default for 1 column */
			img[class="rnb-col-1-img"] {
			max-width:550px;
			}
			/* Image width by default for header */
			img[class="rnb-header-img"] {
			max-width:590px;
			}
			/* ----- MEDIA QUERY SMALL SCREENS -----
			Constrain email width for small screens */
			@media screen and (max-width: 600px) {
			table[class="rnb-container"] {
			width: 95% !important;
			}
			table[class="rnb-btn-col-content"] {
			width: 100% !important;
			}
			}
			/* ----- MEDIA QUERY MOBILE -----
			Give content more room on mobile */
			@media screen and (max-width: 480px) {
			td[class="rnb-container-padding"] {
			padding-left: 10px !important;
			padding-right: 10px !important;
			}
			/* force container nav to (horizontal) blocks */
			td[class="rnb-force-nav"] {
			display: block;
			}
			}
			/* ----- MEDIA QUERY SMALL SCREENS -----
			Styles for forcing columns to rows */
			@media only screen and (max-width : 600px) {
			/* center the address & social icons */
			.rnb-text-center {text-align:center !important;}
			/* force container columns to (horizontal) blocks */
			td[class="rnb-force-col"] {
			display: block;
			padding-right: 0 !important;
			padding-left: 0 !important;
			}
			table[class="rnb-col-3"] {
			/* unset table align="left/right" */
			float: none !important;
			width: 100% !important;
			/* change left/right padding and margins to top/bottom ones */
			margin-bottom: 10px;
			padding-bottom: 10px;
			border-bottom: 1px solid #eee;
			}
			table[class="rnb-last-col-3"] {
			/* unset table align="left/right" */
			float: none !important;
			width: 100% !important;
			}
			table[class="rnb-col-2"] {
			/* unset table align="left/right" */
			float: none !important;
			width: 100% !important;
			/* change left/right padding and margins to top/bottom ones */
			margin-bottom: 10px;
			padding-bottom: 10px;
			border-bottom: 1px solid #eee;
			}
			table[class="rnb-col-2-noborder-onright"] {
			/* unset table align="left/right" */
			float: none !important;
			width: 100% !important;
			/* change left/right padding and margins to top/bottom ones */
			margin-bottom: 10px;
			padding-bottom: 10px;
			}
			table[class="rnb-col-2-noborder-onleft"] {
			/* unset table align="left/right" */
			float: none !important;
			width: 100% !important;
			/* change left/right padding and margins to top/bottom ones */
			margin-top: 10px;
			padding-top: 10px;
			}
			table[class="rnb-last-col-2"] {
			/* unset table align="left/right" */
			float: none !important;
			width: 100% !important;
			}
			table[class="rnb-col-1"] {
			/* unset table align="left/right" */
			float: none !important;
			width: 100% !important;
			}
			img[class="rnb-col-3-img"] {
			max-width:none !important;
			width:100% !important;
			}
			img[class="rnb-col-2-img"] {
			max-width:none !important;
			width:100% !important;
			}
			img[class="rnb-col-2-img-side-xs"] {
			max-width:none !important;
			width:100% !important;
			}
			img[class="rnb-col-2-img-side-xl"] {
			max-width:none !important;
			width:100% !important;
			}
			img[class="rnb-col-1-img"] {
			max-width:none !important;
			width:100% !important;
			}
			img[class="rnb-header-img"] {
			max-width:none !important;
			width:100% !important;
			}
			}</style></head><body>	
			<table class="main-template" style="background-color:#ede6df;" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody><tr style="display:none !important; font-size:1px;"><td>Votre demande de devis chez Au Coeur du Voyage</td><td></td></tr>
				<tr>
					<td style="background-color:#ede6df;" align="center" bgcolor="#ede6df" valign="top">
						<table class="rnb-del-min-width" style="min-width:590px; background-color:#ede6df" name="Layout_0" id="Layout_0" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody><tr>
								<td class="rnb-del-min-width" style="min-width:590px; background-color: #555;" align="center" valign="top">
									<table align="center" border="0" cellpadding="0" cellspacing="0">
										<tbody><tr>
											<td style="font-size:1px; line-height:1px;" height="10"> </td>
										</tr>
										<tr>
											<td style="font-size: 13px; color: rgb(255, 255, 255); font-weight: normal; text-align: center; font-family: Arial,Helvetica,sans-serif;" align="center" height="20">
												
											</td>
										</tr>
										<tr>
											<td style="font-size:1px; line-height:1px;" height="10"> </td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td style="background-color:#ede6df;" align="center" bgcolor="#ede6df" valign="top">
						<table class="rnb-del-min-width" style="min-width:590px; background-color:#ede6df;" name="Layout_14" id="Layout_14" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody><tr>
								<td class="rnb-del-min-width" style="min-width:590px;" align="center" valign="top">
									<table class="rnb-container" style="background-color:#ede6df;" align="center" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="590">
										<tbody><tr>
											<td align="center" valign="top">
												<a href="'.$this->config->base_url().'" style="text-decoration:none;" target="_blank">
													<img src="'.$this->config->base_url().'img/header.png" class="rnb-header-img" alt="" style="max-width:590px; display:block; border-radius:0px; height:px; width:590px;" border="0" height="" hspace="0" vspace="0" width="590">
												</a>
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
				<td style="background-color:#ede6df;" align="center" bgcolor="#ede6df" valign="top">
					<table style="background-color:##ede6df;" name="Layout_56" id="Layout_56" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
						<tbody><tr>
							<td style="background-color: ##ede6df;" align="center" bgcolor="#ede6df" valign="top">
								<table style="height: 0px; background-color: rgb(255, 255, 255); border-bottom: 0px solid rgb(200, 200, 200); border-radius: 0px; padding-left: 20px; padding-right: 20px; border-collapse: separate;" class="rnb-container" bgcolor="##ffffff" border="0" cellpadding="0" cellspacing="0" width="590">
									<tbody><tr>
										<td class="rnb-container-padding" style="background-color: #ffffff; font-size: px;font-family: ; color: ;" bgcolor="#ffffff">
											<table class="rnb-columns-container" align="center" border="0" cellpadding="0" cellspacing="0">
												<tbody><tr>
													<td style="padding-right: 0px;" class="rnb-force-col" align="center">
														<table class="rnb-col-1" align="center" border="0" cellpadding="0" cellspacing="0">
															<tbody><tr>
																<td height="10"></td>
															</tr>
															<tr>
																<td style="font-size:18px;font-family:Arial,Helvetica,sans-serif; color:#555; font-weight:bold; text-align:center;">
																		<span style="color:#555; font-weight:bold;"><div>Votre message</div></span>
																</td>
															</tr>
															<tr>
																<td height="10"></td>
															</tr>
														</tbody></table>
													</td>
												</tr>
											</tbody></table>
										</td>
									</tr>
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
			<tr>
				<td style="background-color:#ede6df;" align="center" bgcolor="#ede6df" valign="top">
				<table class="rnb-del-min-width" style="min-width:590px; background-color:#ede6df;" name="Layout_53" id="Layout_53" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody><tr>
					<td class="rnb-del-min-width" style="min-width:590px; background-color: #ede6df;" align="center" bgcolor="#ede6df" valign="top">
						<table style="background-color: rgb(255, 255, 255); border-bottom: 0px solid rgb(200, 200, 200); border-radius: 0px; padding-left: 20px; padding-right: 20px; border-collapse: separate;" class="rnb-container" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="590">
							<tbody><tr>
								<td style="font-size:1px; line-height:1px;" height="20"> </td>
							</tr>
							<tr>
								<td class="rnb-container-padding" style="background-color: #ffffff;" align="left" bgcolor="#ffffff" valign="top">
									<table class="rnb-columns-container" border="0" cellpadding="0" cellspacing="0" width="100%">
										<tbody><tr>
											<td style="padding-right: 0px;" class="rnb-force-col" valign="top">
												<table valign="top" class="rnb-col-1" align="left" border="0" cellpadding="0" cellspacing="0" width="550">
													<tbody>
													<tr>
													
														<td style="font-size:13px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#555;">
																	<div style="text-align: left;"><br>
																	<span style="font-size:14px;"><strong>Newsletter</strong></span>
																	<br>
																	 Votre Nom : '.$name.'
																	<br>Votre Adresse email : <a href="mailto:'.$email.'">'.$email.'</a><br>';
														$htmlmail .= '</td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
							<tr>
								<td style="font-size:1px; line-height:1px;" height="20"> </td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr><tr>
		<td style="background-color:#ede6df;" align="center" bgcolor="#ede6df" valign="top">
            <table style="background-color:##ede6df;" name="Layout_55" id="Layout_55" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody><tr>
                    <td style="background-color: ##ede6df;" align="center" bgcolor="#ede6df" valign="top">
                        <table style="height: 0px; background-color: rgb(255, 255, 255); border-bottom: 0px solid rgb(200, 200, 200); border-radius: 0px; padding-left: 20px; padding-right: 20px; border-collapse: separate;" class="rnb-container" bgcolor="##ffffff" border="0" cellpadding="0" cellspacing="0" width="590">
                            <tbody><tr>
                                <td class="rnb-container-padding" style="background-color: #ffffff; font-size: px;font-family: ; color: ;" bgcolor="#ffffff">
                                    <table class="rnb-columns-container" align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tbody><tr>
                                            <td style="padding-right: 0px;" class="rnb-force-col" align="center">
                                                <table class="rnb-col-1" align="center" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody><tr>
                                                        <td height="10"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:16px;font-family:Arial,Helvetica,sans-serif; color:#555; font-weight:bold; text-align:center;">
																	<span style="color:#555; font-weight:bold;">
																		<div>Au Coeur du Voyage vous remercie pour votre intérêt.</div>
																		<div>Une conseillère reviendra vers vous dans les plus brefs délais.</div>
																	</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="10"></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
		</td>
	</tr><tr>
		<td style="background-color:#ede6df;" align="center" bgcolor="#ede6df" valign="top">
			<table class="rnb-del-min-width" style="min-width:590px; background-color:#ede6df;" name="Layout_29" id="Layout_29" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody><tr>
					<td class="rnb-del-min-width" style="min-width:590px;" align="center" valign="top">
						<table class="rnb-container" style="background-color:#ede6df;" align="center" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="590">
							<tbody><tr>
								<td align="center" valign="top">
                                    <a href="'.$this->config->base_url().'" style="text-decoration:none;" target="_blank">
										<img src="img/destinations.png" class="rnb-header-img" alt="" style="max-width:590px; display:block; border-radius:0px; height:px; width:590px;" border="0" height="" hspace="0" vspace="0" width="590">
									</a>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</td>
		</tr>
		<tr>
			<td style="background-color:#ede6df;" align="center" bgcolor="#ede6df" valign="top">
				<table class="rnb-del-min-width" style="min-width:590px; background-color:#ede6df;" name="Layout_34" id="Layout_34" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
					<tbody><tr>
						<td class="rnb-del-min-width" style="min-width:590px; background-color: #ede6df;" align="center" bgcolor="#ede6df" valign="top">
							<table style="background-color: rgb(255, 255, 255); border-bottom: 0px solid rgb(200, 200, 200); border-radius: 0px; padding-left: 20px; padding-right: 20px; border-collapse: separate;" class="rnb-container" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="590">
								<tbody><tr>
									<td style="font-size:1px; line-height:1px;" height="20"> </td>
								</tr>
								<tr>
									<td class="rnb-container-padding" style="background-color: #ffffff;" align="left" bgcolor="#ffffff" valign="top">
										<table class="rnb-columns-container" border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody><tr>
												<td style="padding-right: 0px;" class="rnb-force-col" valign="top">
													<table valign="top" class="rnb-col-1" align="left" border="0" cellpadding="0" cellspacing="0" width="550">
														<tbody><tr>
															<td align="left" valign="top" width="100%">
																<a href="'.$this->config->base_url().'" target="_blank">
																	<img src="'.$this->config->base_url().'img/destinations.gif" class="rnb-col-1-img" alt="" style="vertical-align:top; width:550px;" border="0" hspace="0" vspace="0" width="550">
																</a>
															</td>
														</tr>
														<tr>
															<td style="font-size:1px; line-height:1px;" height="20"> </td>
														</tr>
														<tr>
															<td style="font-size:13px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#555;">
																<div></div>
															</td>
														</tr>
													</tbody></table>
												</td>
											</tr>
										</tbody></table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px; line-height:1px;" height="20"> </td>
								</tr>
							</tbody></table>
						</td>
					</tr>
				</tbody></table>
			</td>
			</tr><tr>
				<td style="background-color:#ede6df;" align="center" bgcolor="#ede6df" valign="top">
					<table class="rnb-del-min-width" style="min-width:590px; background-color:#ede6df;" name="Layout_30" id="Layout_30" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
						<tbody><tr>
							<td class="rnb-del-min-width" style="min-width:590px;" align="center" valign="top">
								<table class="rnb-container" style="background-color:#ede6df;" align="center" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="590">
									<tbody><tr>
										<td align="center" valign="top">
											<img src="'.$this->config->base_url().'img/bottom.png" class="rnb-header-img" alt="" style="max-width:590px; display:block; border-radius:0px; height:px; width:590px;" border="0" height="" hspace="0" vspace="0" width="590">
										</td>
									</tr>
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
					</td>
			</tr><tr>
				<td style="background-color:#ede6df;" align="center" bgcolor="#ede6df" valign="top">
					<table class="rnb-del-min-width" style="min-width:590px; background-color:#ede6df;" name="Layout_24" id="Layout_24" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
						<tbody><tr>
							<td class="rnb-del-min-width" style="min-width:590px; background-color: #ede6df;" align="center" bgcolor="#ede6df" valign="top">
								<table class="rnb-container" style="padding-right:5px; padding-left:5px;" align="center" border="0" cellpadding="0" cellspacing="0" width="590">
									<tbody><tr>
										<td style="font-size:1px; line-height:1px;" height="20"> </td>
									</tr>
									<tr>
										<td class="rnb-container-padding" style="font-size: 13px; font-family: Arial,Helvetica,sans-serif; color: #919191;" align="left" valign="top">
											<table class="rnb-columns-container" border="0" cellpadding="0" cellspacing="0" width="100%">
												<tbody><tr>
													<td class="rnb-force-col" style="padding-right:20px;" valign="top">
														<table valign="top" class="rnb-col-2" style="border-bottom:0;" align="left" border="0" cellpadding="0" cellspacing="0" width="264">
															<tbody><tr>
																<td valign="top">
																	<table class="rnb-btn-col-content" align="left" border="0" cellpadding="0" cellspacing="0">
																		<tbody><tr>
																			<td style="font-size:13px; font-family:Arial,Helvetica,sans-serif; color:#919191;" class="rnb-text-center" align="left" valign="middle">
																				<div><div><span style="color:#ec8234;"><span style="font-size: 14px;"><strong>Au Coeur du Voyage</strong></span></span></div>
																			<div><span style="color:#696969;">66 avenue des Champs Elysées</span></div>
																			<div><span style="color:#696969;">75008 Paris</span></div>
																			<div><span style="color:#696969;">Tél : 01 84 16 04 60 - Fax: 09 59 72 02 91</span></div>
																			<div><span style="color:#696969;"><strong>info@aucoeurduvoyage.com</strong></span></div>
																			</div>
																			</td>
																		</tr>
																	</tbody></table>
																</td>
															</tr>
														</tbody></table>
													</td>
													<td class="rnb-force-col" valign="top">
														<table valign="top" class="rnb-last-col-2" align="right" border="0" cellpadding="0" cellspacing="0" width="264">
															<tbody><tr>
																<td valign="top">
																	<table class="rnb-btn-col-content" align="right" border="0" cellpadding="0" cellspacing="0">
																		<tbody><tr>
																			<td class="rnb-text-center" valign="middle">
																				<span style="color:#ffffff; font-weight:normal;">
																					<a href="https://www.facebook.com/pages/Au-Coeur-Du-Voyage/233613626680309?fref=ts"><img src="'.$this->config->base_url().'img/fb.gif" alt="Facebook" style="vertical-align:top;" target="_blank" border="0" hspace="0" vspace="0"></a>
																				</span><span style="color:#ffffff; font-weight:normal;">
																					<a href="https://twitter.com/aucoeurduvoyage"><img src="'.$this->config->base_url().'img/tw.gif" alt="Twitter" style="vertical-align:top;" target="_blank" border="0" hspace="0" vspace="0"></a>
																				</span><span style="color:#ffffff; font-weight:normal;">
																					<a href="https://plus.google.com/u/0/+Aucoeurduvoyage/posts"><img src="'.$this->config->base_url().'img/gg.gif" alt="Google+" style="vertical-align:top;" target="_blank" border="0" hspace="0" vspace="0"></a>
																				</span><span style="color:#ffffff; font-weight:normal;">
																					<a href="http://www.linkedin.com/company/au-coeur-du-voyage"><img src="'.$this->config->base_url().'img/in.gif" alt="LinkedIn" style="vertical-align:top;" target="_blank" border="0" hspace="0" vspace="0"></a>
																				</span><span style="color:#ffffff; font-weight:normal;">
																					<a href="http://www.viadeo.com/v/company/au-coeur-du-voyage"><img src="'.$this->config->base_url().'img/vi.gif" alt="Viadeo" style="vertical-align:top;" target="_blank" border="0" hspace="0" vspace="0"></a>
																				</span><span style="color:#ffffff; font-weight:normal;">
																					<a href="http://i.instagram.com/aucoeurduvoyage/#"><img src="'.$this->config->base_url().'img/inst.png" alt="Instagram" style="vertical-align:top;" target="_blank" border="0" hspace="0" vspace="0"></a>
																				</span><span style="color:#ffffff; font-weight:normal;">
																					<a href="http://www.pinterest.com/aucoeurduvoyage/boards/"><img src="'.$this->config->base_url().'img/pinterest.png" alt="Pinterest" style="vertical-align:top;" target="_blank" border="0" hspace="0" vspace="0"></a>
																				</span>
																			</td>
																		</tr>
																	</tbody></table>
																</td>
															</tr>
														</tbody></table>
													</td>
												</tr>
											</tbody></table>
										</td>
									</tr>
									<tr>
										<td style="font-size:1px; line-height:1px;" height="20"> </td>
									</tr>
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr><tr>
				<td style="background-color:#ede6df;" align="center" bgcolor="#ede6df" valign="top">
					<table class="rnb-del-min-width" style="min-width:590px; background-color:#ede6df;" name="Layout_3" id="Layout_3" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
						<tbody><tr>
							<td class="rnb-del-min-width" style="min-width:590px; background-color: #ede6df;" align="center" bgcolor="#ede6df" valign="top">
								<table class="rnb-container" style="padding-right:20px; padding-left:20px;" align="center" border="0" cellpadding="0" cellspacing="0" width="590">
									<tbody><tr>
										<td style="font-size:1px; line-height:1px;" height="10"> </td>
									</tr>
									<tr>
										<td>
											<div style="font-size:13px; color:#919191; font-weight:normal; text-align:center; font-family:Arial,Helvetica,sans-serif;"><div>
		<div><span style="color:#696969;">Vous avez reçu cet email car vous vous êtes inscrit sur Au Coeur du Voyage.</span></div>
		<div> </div>
		</div>
		</div>
											<div style="font-size:13px; font-weight:normal; text-align:center; font-family:Arial,Helvetica,sans-serif;">
												<a href="mailto:info@aucoeurduvoyage.com?subject=Désinscription liste emailing" style="text-decoration:none; color:#474747;" target="_blank">Se désinscrire</a>
											</div>
										</td>
									</tr>
									<tr>
										<td style="font-size:1px; line-height:1px;" height="10"> </td>
									</tr>
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr><tr>
				<td style="background-color:#ede6df;" align="center" bgcolor="#ede6df" valign="top">
					<table class="rnb-del-min-width" style="min-width:590px; background-color:#ede6df;" name="Layout_4" id="Layout_4" bgcolor="#ede6df" border="0" cellpadding="0" cellspacing="0" width="100%">
						<tbody><tr>
							<td class="rnb-del-min-width" style="min-width:590px; background-color: #555;" align="center" bgcolor="#555" valign="top">
								<table class="rnb-container" style="padding-right:20px; padding-left:20px;" align="center" border="0" cellpadding="0" cellspacing="0" width="590">
									<tbody><tr>
										<td style="font-size:1px; line-height:1px;" height="10"> </td>
									</tr>
									<tr>
										<td style="font-size:13px; color:#ffffff; font-weight:normal; text-align:center; font-family:Arial,Helvetica,sans-serif;">
											<div>© 2017 Au Coeur du Voyage</div>
										</td>
									</tr>
									<tr>
										<td style="font-size:1px; line-height:1px;" height="10"> </td>
									</tr>
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
		</tbody></table>
		</body></html>';
		
			/*$this->email->from($admindetails[0]['email_id'],$admindetails[0]['company_name']);
			$this->email->to($email);
			$this->email->subject("Votre demande de devis Voyage de Noces");
			$this->email->set_mailtype('html');
			$this->email->message($htmlmail);
			$this->email->send();*/
			
			/*$this->email->from($email);
			$this->email->to($admindetails[0]['email_id']);
			$this->email->subject("Nouvelle demande de devis Voyage de Noces");
			$this->email->set_mailtype('html');
			$this->email->message($htmlmail);
			$this->email->send();*/
			
			$this->session->set_userdata('succ_update','<span class="success">'.$this->lang->line('NEWSLETTER_THANKYOU').'</span>');
			header('location:'.$url);
		}
		else
		{	
			$this->session->set_userdata('already_exists','<span class="error">'.$this->lang->line('NEWSLETTER_EMAIL_ERROR').'</span>');
			header('location:'.$url);
		}
		
	}
	
	function check_dups()
	{ 
		$nesemail = $this->input->post("nesemail");

		$query = $this->db->query("select email_id  FROM newsletter WHERE email_id = '".$nesemail."' AND status IN('Subscribed')");
		$resultsubscribe = $query->num_rows();
		
		if($resultsubscribe > 0)
		{
			$this->form_validation->set_message('check_dups',"Email address already exists");
			return false;
		}
		

	}
}

?>