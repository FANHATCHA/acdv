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
<div>	
	<div class="wrapper">
		<div class="demandededevispop">
			<form action="<?php echo $this->config->base_url();?>contact/simpleprodestinationfrm" method="post" name="requestfrm" id="requestfrm" >
            	<input type="hidden" name="issubmit" value="1">
                <div id="wizard" class="swMainpop">
                	<ul>
						<li id="tclose" onclick="hidefrm();">X</li>
						<li class="title_for_pupup"><h2 class="difftitle">Demande De <span style="color:#7bc200;">Devis</span></h2>
							<h3>
							<?php		
							$slug			  = $this->uri->segment_array();	
							$checkdestorpro = array_slice($slug,0,1);	
							$checkpro 		= array_slice($slug,1,1);		
							if(isset($checkdestorpro[0]) && !empty($checkdestorpro[0]) && $checkdestorpro[0] == 'destination')	
							{				
								$destinationslug 	= array_slice($slug,1,2);
								$destinationname 	  = $commod->getcatslugtocatname($destinationslug[0]);
								echo '"'.$destinationname.'"';		
								echo "<input type='hidden' name='destinationname' id='destinationname' value='".$destinationname."'>";	
								}	
								else if(isset($checkpro[0]) && !empty($checkpro[0]) && $checkpro[0] == 'voyages')	
								{		
								$productslug	 	  = array_slice($slug,-1,1);						$pronamename 	 	  = $commod->getproslugtoproname($productslug[0]);
								echo '"'.$pronamename.'"';	
								echo "<input type='hidden' name='productname' id='productname' value='".$pronamename."'>";		
								}		
							?>
							</h3>
						</li>
                        <li class="demandededevispop_step2">
                            <h2 class="demandededevispop_step2_lab">VOS COORDONN&Eacute;ES</h2>    
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
                        <li class="demandededevispop_step3">    
                            <h2 class="demandededevispop_step3_lab">DATES</h2>    
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
                        
                        <li class="demandededevispop_step4">    
                            <h2 class="demandededevispop_step4_lab">BUDGET</h2>    
                            <div>    
                                <input type="text" name="price" id="price"><label> &#128; par personne </label>    
                                <div id="msg_price"></div>	    
                            </div>    
                        </li>                        
                        <li class="demandededevispop_step5">    
                            <h2 class="demandededevispop_step5_lab">COMMENTAIRES</h2>    
                            <div>    
                                <label class="demandededevispop_step5_lab_cols">Merci d’indiquer toute information susceptible de nous aider à créer le voyage qui vous convient </label>    
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
									<p class="demandededevispop_step5_lab_cols">Cliquez ou touchez <strong style="color:#7bc200;"><?php echo $v; ?></strong></p>
									<div class="visualCaptcha-possibilities">
										<input type='hidden' name='hidden_challenge_question' id='hidden_challenge_question' value='<?php echo $v; ?>'>
										<input type='hidden' name='hidden_challenge_answer' id='hidden_challenge_answer' value=''>

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
									
                                    <button onclick="return validationfrm();ga('send', 'event', 'Devis', 'click', 'Envoi');" type="button" name="demandededevispopsub" id="demandededevispopsub">ENVOYER</button>    
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

<script type="text/javascript">
jQuery(".tabs-menu a").click(function(event) {
	var curenttab = jQuery(this).attr('href');
	document.getElementById('currentid').value = curenttab;
});

$('.buttonFinish').hide();
$('.buttonNext').hide();

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

<script>
function validationfrm()
{
	var isValid = true; 
	focusOn 	= false;
	var un = $("#dest").val();
	if(un == "-1")
	{
	  isValid = false;
	  if(!focusOn)
	   {
		focusOn=document.getElementById("dest");
	   }
	  $("#msg_destination").html("Veuillez choisir une destination").show();
	}
	else
	{
		isValid = true;
		$("#msg_destination").html("").hide();
	} 
	var name = $("#name").val();
	if(!name && name.length < 0 || name == "Nom prénom"){
	   isValid = false;
	   if(!focusOn)
	   {
		focusOn=document.getElementById("name");
	   }
	   $("#msg_name").html("Veuillez entrer votre nom et prénom").show();
	   
	}else{
	   $("#msg_name").html("").hide();
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
		$("#msg_email").html("L'email semble incorrect").show();           
		}else{
			$("#msg_email").html("").hide();
		}
	}
	else
	{
		isValid = false;
		if(!focusOn)
		{
		   focusOn=document.getElementById("email");
		}
		$("#msg_email").html("Veuillez entrer votre email").show();
	} 

	var phoneno = $("#phoneno").val();
	if(phoneno && phoneno.length > 0 || phoneno != "N° de téléphone")
	{
		if(!isValidPhoneNo(phoneno)){
			   isValid = false;
				if(!focusOn)
				{
				   focusOn=document.getElementById("phoneno");
				}	
			$("#msg_phone").html("Le n° de telephone semble incorrect").show();           
		}else{
			$("#msg_phone").html("").hide();
		}
	}
	else
	{
		isValid = false;
		if(!focusOn)
		{
		   focusOn=document.getElementById("phoneno");
		}	
		$("#msg_phone").html("Veuillez entrer votre numero de telephone").show();
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
	
	var price = $("#price").val();

	if(price && price.length > 0)

	{

		if(!isValidPrice(price)){

			   isValid = false;

				if(!focusOn)

				{

				   focusOn=document.getElementById("price");

				}	

			   $("#msg_price").html("budget incorrect").show();           

		}else{

			$("#msg_price").html("").hide();

		}

	}

	else

	{

		isValid = false;

		if(!focusOn)

		{

		   focusOn=document.getElementById("price");

		}	

		$("#msg_price").html("Veuillez nous indiquer votre budget").show();

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
	var today = mm+'/'+dd+'/'+yy;
	
	var d = departdate.split('/');   
	var departdate = d[1] +'/'+ d[0] +'/'+ d[2];
	
	if (departdate < today) {
		//alert('1-'+departdate+'-'+today);
		return 0;
	} 
	else {
		//alert('2-'+departdate+'-'+today);
		return 1;
	}
}

function isValidToDate(departdate, returndate) {
	var d = departdate.split('/');   
	var departdate = d[1] +'/'+ d[0] +'/'+ d[2];
	
	var r = returndate.split('/');   
	var returndate = r[1] +'/'+ r[0] +'/'+ r[2];
	
	if (departdate > returndate) {
		//alert('1');
		return 0;
	} 
	else {
		//alert('2');
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
