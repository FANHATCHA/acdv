<?php
header('Content-Type: text/html; charset=utf-8');
?>
<div class="Contact_bg_mn">	
	<div class="wrapper">
        <div class="conatct_top_row_mn">
            <h1>Demande De <span>Devis</span></h1>
        </div>
		<div class="demandededevis">
        	<form action="<?php echo $this->config->base_url();?>contact/requestquotefrm" method="post" name="requestfrm" id="requestfrm" >
            	<input type="hidden" name="issubmit" value="1">
                <div id="wizard" class="swMain">
                	<ul>
						<?php
						
							$destination_name = $this->input->post('hidden_qutoinform');
							$type			  = $this->input->post('hidden_qutoinform_type');
							
						if(isset($type) && !empty($type) && $type == 'destination'){ ?>
							<li class="demandededevis_step1">
								<h2 class="demandededevis_step1_lab">DESTINATION</h2>
								<div>	
									<label><?php echo $destination_name;?></label>
									<input type="hidden" name="dest" id="dest" value="<?php echo $destination_name;?>"/>
									<input type="hidden" name="destinationname" id="destinationname" value="<?php echo $destination_name;?>"/>
								</div>
							</li>
						<?php }else if(isset($type) && !empty($type) && $type == 'voyage'){ ?>
							<li class="demandededevis_step1">
								<h2 class="demandededevis_step1_lab">Voyage</h2>
								<div>	
									<label><?php echo $destination_name;?></label>
									<input type="hidden" name="dest" id="dest" value="<?php echo $destination_name;?>"/>
									<input type="hidden" name="productname" id="productname" value="<?php echo $destination_name;?>"/>
								</div>
							</li>
						<?php }else{?>
						<li class="demandededevis_step1">
                        	<h2 class="demandededevis_step1_lab">DESTINATION</h2>
                            <div>	
                                <select name="dest" id="dest" class="cu_dds">
                                    <option value="-1">Choisir un Pays</option>
                                    <?php
                                    foreach($catname as $catnames){?>
                                        <option value="<?php echo $catnames;?>"><?php echo $catnames;?></option>
                                    <?php }?>
                                </select>      
                                <div id="msg_destination"></div>	
							</div>
						</li>
						<?php } ?>
                        <li class="demandededevis_step2">
                            <h2 class="demandededevis_step2_lab">PARTICIPANTS</h2>    
                            <div>    
                                <span class="part-top">Vos coordonnées : </span>    
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
                                <span class="part-bottom">Vous voyagez : </span>     
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
                                                <div id="uniform-category" class="chaeckbox_mn_align">    
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
											<div id="family_adults" class="msg_step2_tab3_error"></div>
                                        </div>    
                                        <div id="tab-3" class="tab-content">    
                                            <label>Nombre d&#8217;adultes</label>    
                                            <input type="text" name="adults3" id="adults3" size="5">    
                                            <label>Nombre d&#8217;enfants</label>    
                                            <input type="text" name="children3" id="children3" size="5">   
											<div id="group_adults" class="msg_step2_tab3_error"></div>											
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
                        </li>
                        <li class="demandededevis_step3">    
                            <h2 class="demandededevis_step3_lab">DATES</h2>    
                            <div>    
                                <div class="step-3-cols">    
                                    <label for="from">Date de d&eacute;part</label>    
                                    <input type="hidden" id="from" name="from">     
                                    <div id="container" style="height: 250px"></div>                      
                                    <div id="msg_from" class="msg_step2_error"></div>    
                                </div>    
                                <div class="step-3-cols">    
                                    <label for="to">Date de retour</label>    
                                    <input type="hidden" id="to" name="to">	    
                                    <div id="container2" style="height: 250px"></div>	    
                                    <div id="msg_to" class="msg_step2_error"></div>    
                                </div>    
                                <div class="step-3-cols1">    
                                    <label>                                            
                                        Dates flexibles?    
                                        <div id="uniform-category" class="chaeckbox_mn_align">    
                                            <span><input type="checkbox" id="flexibles" name="flexibles"></span>    
                                        </div>    
                                    </label>    
                                </div>    
                            </div>    
                        </li>
                        
                        <li class="demandededevis_step4">    
                            <h2 class="demandededevis_step4_lab">BUDGET</h2>    
                            <div>    
                                <input type="text" name="price" id="price"><label> &#128; par personne </label>    
                                <div id="msg_price"></div>	    
                            </div>    
                        </li>                        
                        <li class="demandededevis_step5">    
                            <h2 class="demandededevis_step5_lab">COMMENTAIRES</h2>    
                            <div>    
                                <label class="demandededevis_step5_lab_cols">Merci d’indiquer toute information susceptible de nous aider à créer le voyage qui vous convient </label>    
                                <textarea id="comment" name="comment" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">Précisez ici vos attentes et vos éventuelles personnalisations...</textarea>              			    
                                <div id="msg_comment" class="msg_step2_error"></div>    
                                <div class="fclear">    
                                    <label>    
                                        <div id="uniform-category" class="chaeckbox_mn_align">    
                                            <span><input type="checkbox" id="accept" name="accept"></span>    
                                        </div>    
                                        J’accepte de recevoir des offres ou articles intéressants par email
                                    </label>    
									<div class="captcha_main">
										<img class="captcha_codeclass_image" src="<?php echo $this->config->site_url();?>application/views/contact/imagebuilder.php">
										
										<input class="captcha_form_text" type="text" onclick="check_captchacode();" onfocus="check_captchacode();" onkeypress="check_captchacode();" onKeyUp="check_captchacode();" onblur="check_captchacode();" name="captcha" id="captcha" placeholder="Merci de recopier le texte ci-contre">
										
										<a href="javascript:void(0);" onclick="captcha_ref();" class="captcha_referesh_tag" title="Cliquez ici pour obtenir une nouvelle image de captcha.">
											<img height="27" src="<?php echo $this->config->site_url();?>assets/front/images/01-refresh-icon.png" />
										</a>
										
										<div class="captchar_error" for="captch_notmatch" id="captch_notmatch"></div>
										<div style="color:red;" id="msg_captcha"></div>
									</div>
                                    <button onclick="return validationfrm();ga('send', 'event', 'Devis', 'click', 'Envoi');" type="button" name="demandededevissub" id="demandededevissub">ENVOYER</button>    
                                    <div id="msg_accept" class="msg_step2_error"></div>    
                                </div>    
                            </div>    
                        </li>
                    </ul>
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

</div>	

</div>
</div>

<script>
$( document ).ready(function() {
	tabcalling2();
});
var jqfrm = jQuery.noConflict();
function validationfrm()
{
	var isValid = true; 
	focusOn 	= false;
	var un = jqfrm("#dest").val();
	if(un == "-1")
	{
	  isValid = false;
	  if(!focusOn)
	   {
		focusOn=document.getElementById("dest");
	   }
	  jqfrm("#msg_destination").html("Veuillezchoisirune destination").show();
	}
	else
	{
		isValid = true;
		jqfrm("#msg_destination").html("").hide();
	} 
	var name = jqfrm("#name").val();
	if(!name && name.length < 0 || name == "Nom"){
	   isValid = false;
	   if(!focusOn)
	   {
		focusOn=document.getElementById("name");
	   }
	   jqfrm("#msg_name").html("Veuillez entrer votre nom").show();
	   
	}else{
	   jqfrm("#msg_name").html("").hide();
	}
	
	var firstname = jqfrm("#firstname").val();
	if(!firstname && firstname.length < 0 || firstname == "Prénom"){
	   isValid = false;
	   if(!focusOn)
	   {
		focusOn=document.getElementById("firstname");
	   }
	   jqfrm("#msg_firstname").html("Veuillez entrer votre prénom").show();
	}else{
	   jqfrm("#msg_firstname").html("").hide();
	}
	
	var email = $("#email").val();
	if(email && email.length > 0 || email != "Adresse email")
	{
		if(!isValidEmailAddress(email)){
		isValid = false;
		if(!focusOn)
		{
			focusOn=document.getElementById("email");
		}	 
		jqfrm("#msg_email").html("L'email semble incorrect").show();           
		}else{
			jqfrm("#msg_email").html("").hide();
		}
	}
	else
	{
		isValid = false;
		if(!focusOn)
		{
		   focusOn=document.getElementById("email");
		}
		jqfrm("#msg_email").html("Veuillezentrervotre L’emailsemble").show();
	} 

	var phoneno = jqfrm("#phoneno").val();
	if(phoneno && phoneno.length > 0 || phoneno != "N° de téléphone")
	{
		if(!isValidPhoneNo(phoneno)){
			   isValid = false;
				if(!focusOn)
				{
				   focusOn=document.getElementById("phoneno");
				}	
			jqfrm("#msg_phone").html("Le n° de telephone semble incorrect").show();           
		}else{
			jqfrm("#msg_phone").html("").hide();
		}
	}
	else
	{
		isValid = false;
		if(!focusOn)
		{
		   focusOn=document.getElementById("phoneno");
		}	
		jqfrm("#msg_phone").html("Veuillezentrervotre Le n° de telephonesemble").show();
	} 

var selecttabidname = document.getElementById('selecttabidname').value;
if(selecttabidname == '#tab-2')
{
	jqfrm("#group_adults").html("").hide();
	var familyadults = jqfrm("#adults").val();
	var familychildren = jqfrm("#children").val();
	
	if (familyadults.length == 0 && familychildren.length == 0) {
		isValid = false;
		if (!focusOn) {
			focusOn = document.getElementById("adults");
		}
		jqfrm("#family_adults").html("Veuillez renseigner les informations demandées").show();
	} else {
		jqfrm("#family_adults").html("").hide();
	}
	}
	else if(selecttabidname == '#tab-3')
	{
		jqfrm("#family_adults").html("").hide();
		var groupadults = jqfrm("#adults3").val();
		var groupchildren = jqfrm("#children3").val();
		if (groupadults.length == 0 && groupchildren.length == 0) {
			isValid = false;
			if (!focusOn) {
				focusOn = document.getElementById("adults3");
			}
			jqfrm("#group_adults").html("Veuillez renseigner les informations demandées").show();
		} else {
			jqfrm("#group_adults").html("").hide();
		}
	}
	

	var from = jqfrm("#from").val();

	if(!from && from.length <= 0){

	   isValid = false;

	   if(!focusOn)

	   {

		focusOn=document.getElementById("from");

	   }

	   jqfrm("#msg_from").html("Les dates sélectionnées semblent incorrectes").show();

	}else{

	   jqfrm("#msg_from").html("").hide();

	}   

	var to = jqfrm("#to").val();
	if(!to && to.length <= 0){
	   isValid = false;
	   if(!focusOn)
	   {
		focusOn=document.getElementById("to");
	   }

	   jqfrm("#msg_to").html("Les dates sélectionnées semblent incorrectes").show();

	}else{

	   jqfrm("#msg_to").html("").hide();

	}

	

	var price = jqfrm("#price").val();

	if(price && price.length > 0)

	{

		if(!isValidPrice(price)){

			   isValid = false;

				if(!focusOn)

				{

				   focusOn=document.getElementById("price");

				}	

			   jqfrm("#msg_price").html("budget incorrect").show();           

		}else{

			jqfrm("#msg_price").html("").hide();

		}

	}

	else

	{

		isValid = false;

		if(!focusOn)

		{

		   focusOn=document.getElementById("price");

		}	

		jqfrm("#msg_price").html("Veuillez rentrer un budget").show();

	} 
	
	var captcha = jqfrm("#captcha").val();
	if(captcha != '')
	{
		check_captchacode();
		jqfrm("#msg_captcha").html("").hide();
		var captcha_check = document.getElementById('captchavalid').value;
		if(captcha_check == 0)
		{
			jqfrm("#msg_captcha").html("").hide();
			isValid = false;
		}
		else
		{
			jqfrm("#msg_captcha").html("").hide();
		}
	}
	else
	{
		isValid = false;
		if(!focusOn)
		{
		   focusOn=document.getElementById("captcha");
		   jqfrm("#msg_captcha").html("").hide();
		}	
		jqfrm('#captch_notmatch').html('');
		jqfrm("#msg_captcha").html("Le captcha semble incorrect").show();
	} 

	
	if(focusOn)
	{
		focusOn.focus();
	}
	if(isValid == false)
	{
		return false;
	}	
	else
	{
		<?php
		$type	 = $this->input->post('hidden_qutoinform_type');
		if(isset($type) && !empty($type) && $type == 'destination' || $type == 'voyage'){ ?>
			document.getElementById('requestfrm').action = '<?php echo $this->config->base_url();?>contact/prodestinationfrm';
		<?php } ?>
		
		document.getElementById("requestfrm").submit();

	}

	

}

function isValidEmailAddress(emailAddress) {

  var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

  return pattern.test(emailAddress);

}

function isValidPhoneNo(phoneNo) {

  var pattern = new RegExp(/^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/i);

  return pattern.test(phoneNo);

}

function isValidPrice(Price) {

  var pattern = new RegExp(/^\d+(?:(\,||\.)\d\d?)*?$/i);

  return pattern.test(Price);

} 

</script>
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
			jqfrm("#msg_captcha").html("").hide();
			$('#captch_notmatch').html('Le captcha semble incorrect');
		}
		else
		{
			$('#captchavalid').val('1');
			 jqfrm("#msg_captcha").html("").hide();
			$('#captch_notmatch').html('');
		}
	  },
	  error:function(){
		//alert('error');
	  }    
	});
}
</script>
