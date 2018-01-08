<?php
header('Content-Type: text/html; charset=utf-8');
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
						$catid = $commod->getmenuidtocatid($menuleve3->id);
						$catname[] = $commod->getmenuidtoname($catid);
					}
				}
			}
			
		 }
	}
}

?>

<form action="<?php echo $this->config->base_url();?>contact/requestquotefrm" method="post" name="requestfrm" id="requestfrm" >
		<input type="hidden" name="issubmit" value="1">
		<div id="wizard" class="swMain">
			<ul>
            	<li class="title_for_pupup"><h3>Demande de devis</h3></li>
				<li class="">
					<a id="step1" href="#step-1" >
						DESTINATION
                        <span class="demande_ic_done">&nbsp;</span>
                        <span class="demande_ic_error">&nbsp;</span>
                        <span class="demande_ic_selected">&nbsp;</span>
					</a>
				</li>
				<li>
					<a id="step2" href="#step-2">
						PARTICIPANTS
                        <span class="demande_ic_done">&nbsp;</span>
                        <span class="demande_ic_error">&nbsp;</span>
                        <span class="demande_ic_selected">&nbsp;</span>
					</a>
				</li>
				<li>
					<a id="step3" href="#step-3">
						DATES
                        <span class="demande_ic_done">&nbsp;</span>
                        <span class="demande_ic_error">&nbsp;</span>
                        <span class="demande_ic_selected">&nbsp;</span>
					</a>
				</li>
				<li>
					<a id="step4" href="#step-4">
						BUDGET
                        <span class="demande_ic_done">&nbsp;</span>
                        <span class="demande_ic_error">&nbsp;</span>
                        <span class="demande_ic_selected">&nbsp;</span>
					</a>
				</li>
				<li>
					<a id="step5" href="#step-5">
						COMMENTAIRES
                        <span class="demande_ic_done">&nbsp;</span>
                        <span class="demande_ic_error">&nbsp;</span>
                        <span class="demande_ic_selected">&nbsp;</span>
					</a>
				</li>
            </ul>
			
			<div id="step-1">	
				<select name="dest" id="dest" class="cu_dds">
					<option value="-1">Choisir un Pays</option>
					<?php
					foreach($catname as $catnames){?>
						<option value="<?php echo $catnames;?>"><?php echo $catnames;?></option>
					<?php }?>
				</select>  
				<div id="msg_destination"></div>	
			</div>
			<div id="step-2">
				<span class="part-top">Vos coordonnées</span>
                <div class="top-field-cols_right">
				<div class="top-field">
                	<div class="top-field-cols">
						<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="name" id="name" value="Nom">
						<div id="msg_name" class="msg_step2_error"></div>
                    </div>
                    <div class="top-field-cols top-field-cols1">
						<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="firstname" id="firstname" value="Prénom">
						<div id="msg_firstname" class="msg_step2_error"></div>
                    </div>
				</div>
				<div class="bottom-field">
                	<div class="top-field-cols">
						<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="email" id="email" value="Adresse email">
						<div id="msg_email" class="msg_step2_error"></div>
                    </div>
                    <div class="top-field-cols top-field-cols1">
						<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="phoneno" id="phoneno" value="N° de téléphone">
						<div id="msg_phone" class="msg_step2_error"></div>
                    </div>
				</div>
                </div>
				<span class="part-bottom">Vous voyagez...</span> 
				<div id="tabs-container">
					<ul class="tabs-menu">
						<li class="current"><a href="#tab-1">En Couple</a></li>
						<li><a href="#tab-2">En Famille</a></li>
						<li><a href="#tab-3">En Groupe</a></li>
						<li><a href="#tab-4">Seul</a></li>
					</ul>
					<div class="tab">
						<div id="tab-1" class="tab-content">
							<label>
								<div id="uniform-category1" class="chaeckbox_mn_align">
									<span><input type="checkbox" name="couple" id="couple" size="15"></span>
								</div>
								Voyage de noces ?
							</label> 
						</div>
						<div id="tab-2" class="tab-content">
							<label>Nombre d&#8217;adultes</label>
							<input type="text" name="adults" id="adults" size="5">
							<label>Nombre d&#8217;enfants</label>
							<input type="text" name="children" id="children" size="5">
							<div id="family_adults" class="msg_step2_tab_error"></div>
						</div>
						<div id="tab-3" class="tab-content">
							<label>Nombre d&#8217;adultes</label>
							<input type="text" name="adults3" id="adults3" size="5">
							<label>Nombre d&#8217;enfants</label>
							<input type="text" name="children3" id="children3" size="5">
							<div id="group_adults" class="msg_step2_tab_error"></div>
						</div>
						<div id="tab-4" class="tab-content">
							<label class="seluheight">
								<div id="uniform-category" class="chaeckbox_mn_align">
									<span class="checked"><input type="hidden" name="seul" id="seul" value="1"></span>
								</div>
								&nbsp;
							</label>
						</div>
					</div>
				</div>
			</div>      
			
			<div id="step-3">
            	<div class="step-3-cols">
					<label >Date de d&eacute;part</label>
					<input type="hidden" id="from" name="from"> 
					<div id="container" style="margin: 10px 0 0 0; height: 250px"></div>					
					<div id="msg_from" class="msg_step2_calendar_error"></div>
                </div>
                <div class="step-3-cols">
					<label >Date de retour</label>
					<input type="hidden" id="to" name="to">	
					<div id="container2" style="margin: 10px 0 0 0; height: 250px"></div>
					<div id="msg_to" class="msg_step2_calendar_error"></div>
                </div>
                <div class="step-3-cols1">
					<label>
						<div id="uniform-category2" class="chaeckbox_mn_align">
							<span><input type="checkbox" id="flexibles" name="flexibles"></span>
						</div>
						Dates flexibles?
					</label>
                </div>
			</div>
			<div id="step-4">
				<input type="text" name="price" id="price"><label> &#128; par personne </label>
				<div id="msg_price"></div>	
			</div>
			<div id="step-5">
				<label class="labelstep5">Merci d’indiquer toute information susceptible de nous aider à créer le voyage qui vous convient </label>
				<textarea id="comment" name="comment" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">Merci de préciser ici votre ville de départ, vos attentes, et vos éventuelles personnalisations...</textarea>              			
				<div id="msg_comment" class="msg_step2_error"></div>
                <div class="step-5-row">
					<label>
						<div id="uniform-category3" class="chaeckbox_mn_align">
							<span><input type="checkbox" id="accept" name="accept"></span>
						</div>
						J’accepte de recevoir des offres ou articles intéressants par email
					</label>
					<div class="captcha_main">
						<img class="captcha_codeclass_image" src="<?php echo $this->config->site_url();?>application/views/contact/imagebuilder.php">
						<input class="captcha_form_text" onclick="check_captchacode();" onfocus="check_captchacode();" onblur="check_captchacode();" type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="captcha" id="captcha" placeholder="Merci de recopier le texte ci-contre">
						<div class="captchar_error" for="captch_notmatch" id="captch_notmatch"></div>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="currentid" id="currentid" value="#tab-1">
		<?php
		/*$token = uniqid();
		//$tokens = array();
		if($this->session->userdata('token')){
			$tokens = $this->session->userdata('token');
		}
		$token_value = md5(rand(9000,1055548).'allfield');
		$tokens[$token] = $token_value;
		$this->session->set_userdata('token',$tokens);*/
		?>
		<!--<input type="hidden" name="token" id="token" value="<?php //echo $token_value;?>">
		<input type="hidden" name="token_key" id="token_key" value="<?php //echo $token;?>">-->
		<input type="hidden" name="captchavalid" id="captchavalid" value="0"/>
</form>

<script type="text/javascript">
jQuery(".tabs-menu a").click(function(event) {
	var curenttab = jQuery(this).attr('href');
	document.getElementById('currentid').value = curenttab;
});

function check_captchacode()
{	
	
	var captchcode = document.getElementById("captcha").value;
	$.ajax({
	  url: "<?php echo $this->config->site_url();?>ajaxcall/captch_code_check",
	  type: "post",
	  data: {'code': captchcode},
	  success: function(data){
		if(data == 0)
		{
			$('#captch_notmatch').show();
			$('#captchavalid').val('0');
			$('#captch_notmatch').html('Le captcha semble incorrect');
		}
		else
		{
			$('#captchavalid').val('1');
			$('#captch_notmatch').html('');
		}
	  },
	  error:function(){
		//alert('error');
	  }    
	});
}
$('.buttonFinish').hide();
</script>


