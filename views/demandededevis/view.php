<?php
header('Content-Type: text/html; charset=utf-8');
?>
<div class="Contact_bg_mn">	
	<div class="wrapper">
        <div class="conatct_top_row_mn">
            <h1>Demande De <span>Devis</span></h1>
        </div>
		<div class="demandededevis">
        	<form action="<?php echo $this->config->base_url();?>contact/simplerequestquotefrm" method="post" name="requestfrm" id="requestfrm" >
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
										<?php if ($this->input->get('destination') == $catnames) { ?>
											<option value="<?php echo $catnames;?>" selected><?php echo $catnames;?></option>
										<?php } else { ?>
											<option value="<?php echo $catnames;?>"><?php echo $catnames;?></option>
										<?php } 
                                    }?>
                                </select>      
                                <div id="msg_destination"></div>	
							</div>
						</li>
						<?php } ?>
                        <li class="demandededevis_step2">
                            <h2 class="demandededevis_step2_lab">VOS COORDONN&Eacute;ES</h2>    
                            <div>    
                                <div class="top-field-cols_right">    
	                                <div class="top-field">    
    	                                <div class="top-field-cols">    
        	                                <input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="name" id="name" value="Nom prénom">
                                            <div id="msg_name" class="msg_step2_error"></div>
                                        </div>
                                    </div>
									<div class="top-field">    
									<div class="top-field-cols">    
                                            <input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="email" id="email" value="Adresse email">
                                            <div id="msg_email" class="msg_step2_error"></div>    
                                        </div> 
									</div>	
                                    <div class="bottom-field">    
                                        <div class="top-field-cols top-field-cols1">    
                                            <input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="phoneno" id="phoneno" value="N° de téléphone">    
                                            <div id="msg_phone" class="msg_step2_error"></div>    
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
                                    <input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="from" id="from" value="DD/MM/YY" maxlength="8">
									<div id="container" style="height: 250px; position: absolute; margin-top:15px; z-index:99999999; display:none;"></div>
									<div id="msg_from" class="msg_step2_error"></div>    
                                </div>    
                                <div class="step-3-cols">    
                                    <label for="to">Date de retour</label>    
									<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="to" id="to" value="DD/MM/YY" maxlength="8">
                                    <div id="container2" style="height: 250px; position: absolute; margin-top:15px; z-index:99999999; display:none;"></div>	    
									<div id="msg_to" class="msg_step2_error"></div>    
                                </div>    
                                <div class="step-3-cols">    
                                    <label>Dates flexibles?</label>
                                        <div id="uniform-category" class="chaeckbox_mn_align">    
                                            <span><input type="checkbox" id="flexibles" name="flexibles"></span>    
                                        </div>    
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
								
								<div id="sample-captcha" class="visualCaptcha">
									<div class="visualCaptcha-accessibility-wrapper visualCaptcha-hide"></div>
									<?php
										$captcha_challenge_arr = array (
										"avion" => "avion.png", "ballons" => "ballons.png", "caméra" => "caméra.png", "voiture" => "voiture.png", 
										"chat" => "chat.png", "chaise" => "chaise.png", "agrafe" => "agrafe.png", "horloge" => "horloge.png", "nuage" => "nuage.png", 
										"ordinateur" => "ordinateur.png", "enveloppe" => "enveloppe.png", "œil" => "œil.png", "drapeau" => "drapeau.png", 
										"dossier" => "dossier.png", "pied" => "pied.png", "graphe" => "graphe.png", "maison" => "maison.png", "clé" => "clé.png", 
										"lampe" => "lampe.png", "feuille" => "feuille.png", "cadenas" => "cadenas.png", "homme" => "homme.png", "pantalon" => "pantalon.png", 
										"crayon" => "crayon.png", "imprimante" => "imprimante.png", "robot" => "robot.png", "ciseaux" => "ciseaux.png", 
										"lunettes de soleil" => "lunettes de soleil.png", "marque" => "marque.png", "arbre" => "arbre.png", "camion" => "camion.png", 
										"t-shirt" => "t-shirt.png", "parapluie" => "parapluie.png", "femme" => "femme.png", "monde" => "monde.png"
										);
										
										$captcha_challenge_random_arr = array_rand($captcha_challenge_arr, 5);
										$random_number = rand(0,4);
										$v = $captcha_challenge_random_arr[$random_number];
										
									?>
									<p class="demandededevis_step5_lab_cols">Cliquez ou touchez <strong style="color:#7bc200;"><?php echo $v; ?></strong></p>
									<div class="visualCaptcha-possibilities">
										<input type='hidden' name='hidden_challenge_question' id='hidden_challenge_question' value='<?php echo $v; ?>'>
										<input type='hidden' name='hidden_challenge_answer' id='hidden_challenge_answer' value=''>
										<input type='hidden' name='hidden_goawayspam' id='hidden_goawayspam' value=''>
										<?php 
											foreach($captcha_challenge_random_arr as $captcha_challenge_random)
											{
												//echo $captcha_challenge_random;
												?>
												<div class="img"><img src="<?php echo $this->config->base_url();?>assets/front/images/visualcaptcha/<?php echo $captcha_challenge_random; ?>" name="<?php echo $captcha_challenge_random; ?>"></div>
												<?php
											}
										?>
										
									</div>
									<div for="msg_captcha" id="msg_captcha"></div>
								</div>
								
                                <div class="fclear">    
                                    <label>    
                                        <div id="uniform-category" class="chaeckbox_mn_align">    
                                            <span><input type="checkbox" id="accept" name="accept"></span>    
                                        </div>    
                                        J’accepte de recevoir des offres ou articles intéressants par email
                                    </label>    
									
                                    <button onclick="return validationfrm();ga('send', 'event', 'Devis', 'click', 'Envoi');" type="button" name="demandededevissub" id="demandededevissub">ENVOYER</button>    
                                    <div id="msg_accept" class="msg_step2_error"></div>    
                                </div>    
                            </div>    
                        </li>
                    </ul>
				</div>
				<input type="hidden" name="currentid" id="currentid" value="#tab-1">
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
	  jqfrm("#msg_destination").html("Veuillez choisir une destination").show();
	}
	else
	{
		isValid = true;
		jqfrm("#msg_destination").html("").hide();
	} 
	var name = jqfrm("#name").val();
	if(!name && name.length < 0 || name == "Nom prénom"){
	   isValid = false;
	   if(!focusOn)
	   {
		focusOn=document.getElementById("name");
	   }
	   jqfrm("#msg_name").html("Veuillez entrer votre nom et prénom").show();
	   
	}else{
	   jqfrm("#msg_name").html("").hide();
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
		jqfrm("#msg_email").html("Veuillez entrer votre email").show();
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
		jqfrm("#msg_phone").html("Veuillez entrer votre numero de telephone").show();
	} 

	var from = $("#from").val();
	var to = $("#to").val();
	
	if(from && from.length > 0 && from != 'DD/MM/YY')
	{
		if(!isValidFromDate(from)){

			   isValid = false;

				if(!focusOn)
				{
				   focusOn=document.getElementById("from");
				}	

			   $("#msg_from").html("Les dates sélectionnées semblent incorrectes").show();           

		}else{
			$("#msg_from").html("").hide();
		}
	}
	else{
		if(!focusOn)
		{
		   focusOn=document.getElementById("from");
		}
		$("#msg_from").html("Veuillez entrer votre date de depart").show();
	}
	
	if(to && to.length > 0 && to != 'DD/MM/YY')
	{
		if(!isValidToDate(from, to)){

			   isValid = false;

				if(!focusOn)
				{
				   focusOn=document.getElementById("to");
				}	

			   $("#msg_to").html("Les dates sélectionnées semblent incorrectes").show();           

		}else{
			
			$("#msg_to").html("").hide();
		}
	}
	else{
		if(!focusOn)
		{
			focusOn=document.getElementById("to");
		}
		$("#msg_to").html("Veuillez entrer votre date de retour").show();
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

		jqfrm("#msg_price").html("Veuillez nous indiquer votre budget").show();

	} 
	
	var captcha_challenge_question = $("#hidden_challenge_question").val();
	var captcha_challenge_answer = $("#hidden_challenge_answer").val();
	
	if(captcha_challenge_answer && captcha_challenge_answer.length > 0 && captcha_challenge_answer != '')
	{
		if(captcha_challenge_question != captcha_challenge_answer){
			isValid = false;
			$("#msg_captcha").html("Le captcha semble incorrect").show();           
		}else{
			$("#msg_captcha").html("").hide();
		}
	}
	else{
		isValid = false;
		$("#msg_captcha").html("Le captcha semble incorrect").show();
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
			document.getElementById('requestfrm').action = '<?php echo $this->config->base_url();?>contact/simpleprodestinationfrm';
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

function isValidFromDate(departdate) {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yy = today.getFullYear()-2000;
	if(dd<10){
		dd='0'+dd;
	} 
	if(mm<10){
		mm='0'+mm;
	} 
	var dateToday = Date.parse(mm+'/'+dd+'/'+yy);
	
	var d = departdate.split('/');   
	var dateFrom = Date.parse(d[1] +'/'+ d[0] +'/'+ d[2]);
	
	if (dateToday > dateFrom) {
		//alert('1-----'+dateToday+'-'+dateFrom);
		return 0;
	} 
	else {
		//alert('2-----'+dateToday+'-'+dateFrom);
		return 1;
	}
}

function isValidToDate(departdate, returndate) {
	var d = departdate.split('/');   
	var dateFrom = Date.parse(d[1] +'/'+ d[0] +'/'+ d[2]);
	
	var r = returndate.split('/');   
	var dateTo = Date.parse(r[1] +'/'+ r[0] +'/'+ r[2]);
	
	if (dateFrom > dateTo) {
		//alert('3-----'+dateTo+'-'+dateFrom);
		return 0;
	} 
	else {
		//alert('4-----'+dateTo+'-'+dateFrom);
		return 1;
	}
}

$( document ).ready(function() {
	$('#from').bind('keyup','keydown', function(event) {
  	var inputLength = event.target.value.length;
    if (event.keyCode != 8){
      if(inputLength === 2 || inputLength === 5){
        var thisVal = event.target.value;
        thisVal += '/';
        $(event.target).val(thisVal);
    	}
    }
  })
  $('#to').bind('keyup','keydown', function(event) {
  	var inputLength = event.target.value.length;
    if (event.keyCode != 8){
      if(inputLength === 2 || inputLength === 5){
        var thisVal = event.target.value;
        thisVal += '/';
        $(event.target).val(thisVal);
    	}
    }
  })
});

$( document ).ready(function() {
    $(".visualCaptcha-possibilities img").click(function() {
		//alert($(this).attr("name")+"------------"+$('#hidden_challenge_question').val());
		$(".visualCaptcha-selected").removeClass("visualCaptcha-selected");
		$(this).parent().removeClass('img');
		$(this).parent().addClass('img visualCaptcha-selected');
		$('#hidden_challenge_answer').val($(this).attr("name"));
	});
});

</script>
<script type="text/javascript">
jQuery(".tabs-menu a").click(function(event) {
	var curenttab = jQuery(this).attr('href');
	document.getElementById('currentid').value = curenttab;
});


$( "#from" ).focus(function() {
	$("#from").removeAttr("readonly"); 
	$('#container').show();
});
$( "#from" ).blur(function() {
	$("#from").removeAttr("readonly"); 
	$('#container').fadeOut();
});

$( "#to" ).focus(function() {
	$("#to").removeAttr("readonly"); 
	$('#container2').show();
});
$( "#to" ).blur(function() {
	$("#to").removeAttr("readonly"); 
	$('#container2').fadeOut();
});

</script>
