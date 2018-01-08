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
								
								<div class="recaptchacontainer fclear"></div>
								<div id='recaptcha' class="g-recaptcha" data-sitekey="6Lf_TSkUAAAAAM4ugtq9_OF7GGwuTL8ntPbpXCkD" data-callback="validationfrm" data-size="invisible"></div>
								
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

	if(!from && from.length <= 0){

	   isValid = false;

	   if(!focusOn)

	   {

		focusOn=document.getElementById("from");

	   }

	   $("#msg_from").html("Les dates sélectionnées semblent incorrectes").show();

	}else{

	   $("#msg_from").html("").hide();

	}   

	var to = $("#to").val();
	if(!to && to.length <= 0){
	   isValid = false;
	   if(!focusOn)
	   {
		focusOn=document.getElementById("to");
	   }

	   $("#msg_to").html("Les dates sélectionnées semblent incorrectes").show();

	}else{

	   $("#msg_to").html("").hide();

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
		
		grecaptcha.execute();
		var response = grecaptcha.getResponse();
		if(response.length > 0)
		{
			//alert('Validated - '+response);
			document.getElementById("requestfrm").submit();
		}
		/*else
		{
			alert('Not validated yet - '+response);
		}*/

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

</script>
