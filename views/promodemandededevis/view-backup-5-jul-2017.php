<!DOCTYPE html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<!--Beampulse-->
<script type="text/javascript"> (function() { var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = ('https:' == document.location.protocol ? 'https://' : 'http://' )+'js-project.s3.amazonaws.com/AS-2313074.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x); })();</script><!--Beampulse-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Au Coeur du Voyage - Demande De Devis</title>
<meta name="description" content="<?php if(isset($meta_desc) && !empty($meta_desc)){echo $meta_desc; }?>" />
<meta name="keywords" content="<?php if(isset($meta_key) && !empty($meta_key)){echo $meta_key; }?>" />
<meta name=viewport content="width=device-width, initial-scale=1">
<?php if(isset($robots) && !empty($robots) && $robots == 'no'){?>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<?php } ?>
<?php if(isset($current_url) && !empty($current_url)){?>
<?php /*<link rel="canonical" href="<?php echo $current_url;?>" />*/?>
<?php } ?>
<?php if(isset($next_url) && !empty($next_url)){?>
<link rel="next" href="<?php echo $next_url;?>"/>
<?php } ?>
<?php if(isset($prev_url) && !empty($prev_url)){?>
<link rel="prev" href="<?php echo $prev_url;?>"/>
<?php } ?>

<?php if(isset($canonical) && !empty($canonical)){?>
<link rel="canonical" href="<?php echo $canonical;?>" />
<?php } ?>

<link rel="icon"        href="<?php echo $this->config->base_url();?>assets/front/images/favicon.ico" type="image/png" >
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/allcssload.css?version=52" type="text/css"/>
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/style.css?version=3" type="text/css" />
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/responsive.css?version=5" type="text/css" />

<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/autoscrolling/main.js"></script>

<!-- Tracking des clics sur les boutons de demande de devis-->
<script type="text/javascript">
$('#buttonFinish').click(function() {
 //ga('send', 'event', 'Devis', 'click', 'Envoi');
});
</script> 

<!-- Fin du tracking des clics sur les boutons de demande de devis-->

<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/header_js1.js"></script>
<?php
$urlsegment 	  = $this->uri->rsegments[1];
if(isset($urlsegment) && !empty($urlsegment) && $urlsegment != 'demandededevis'){
if(isset($urlsegment) && !empty($urlsegment) && $urlsegment == "destination" || $urlsegment == 'voyages'){?>
	<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/validation/fieldfrm.js"></script>
<?php }else{ ?>	
	<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/validation/Allfieldfrm.js"></script>
<?php } } ?>	
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery.lightSlider.js"></script> 
<script type="text/javascript">
var jqfrm3225 = jQuery.noConflict();
jqfrm3225(document).ready(function() {
	jqfrm3225("#demo").lightSlider({
		loop:false,
		keyPress:false,
		enableDrag:false
	});
});
jqfrm3225(document).ready(function() {
	jqfrm3225("#demo2").lightSlider({
		loop:true,
		keyPress:true
	});
});
var jqfrm3=jQuery.noConflict();jqfrm3(document).ready(function(){jqfrm3("#from").Zebra_DatePicker({always_visible:jqfrm3("#container"),pair:jqfrm3("#to"),firstDay:1,direction:!0,format: 'd/m/y'}),jqfrm3("#to").Zebra_DatePicker({selectWeek:!0,always_visible:jqfrm3("#container2"),direction:!0,format: 'd/m/y'})}),jqfrm3(function(){jqfrm3("#slider").nivoSlider({effect:"fade",slices:1,boxCols:8,boxRows:4,animSpeed:500,pauseTime:3000,startSlide:0,directionNav:true,directionNavHide:false,controlNav:true,keyboardNav:true,pauseOnHover:true,manualAdvance:false})});
</script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/header_js2.js"></script>
<script type="text/javascript">
function getScrollTop(){if("undefined"!=typeof pageYOffset)return pageYOffset;var e=document.body,t=document.documentElement;return t=t.clientHeight?t:e,t.scrollTop}jQuery(document).ready(function(){jQuery(window).scroll(function(){getScrollTop()>136?jQuery(".contact-btn").addClass("fixed"):jQuery(".contact-btn").removeClass("fixed")})});
</script>
<script type="text/javascript" >
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-26525825-1', 'auto');
  ga('send', 'pageview');
</script>
<script>jQuery.noConflict();</script>
<script type="text/javascript">
(function(a,e,c,f,g,h,b,d){var k={ak:"1015212314",cl:"q_OtCOnu6GAQmtKL5AM",autoreplace:"+33 (0)1 84 16 04 60"};a[c]=a[c]||function(){(a[c].q=a[c].q||[]).push(arguments)};a[g]||(a[g]=k.ak);b=e.createElement(h);b.async=1;b.src="//www.gstatic.com/wcm/loader.js";d=e.getElementsByTagName(h)[0];d.parentNode.insertBefore(b,d);a[f]=function(b,d,e){a[c](2,b,k,d,null,new Date,e)};a[f]()})(window,document,"_googWcmImpl","_googWcmGet","_googWcmAk","script");
</script>
</head>
<?php
function string_limit($string, $limit) { 
	$string = strip_tags($string);
	if (strlen($string) > $limit) {
		// truncate string
		$stringCut = substr($string, 0, $limit);
		// make sure it ends in a word so assassinate doesn't become ass...
		$string = substr($stringCut, 0, strrpos($stringCut, ' '))	; 
	}
	return $string;
}
?>
<body>
    <!-- Start header -->
    <div class="header_top" style="display:none;">
    	<div class="wrapper">
        	<div class="header_call"><span><img src="<?php echo $this->config->base_url();?>assets/front/images/telephone.png" alt="Tél.:" border="0" height="21px" width="19px"/></span> <a href="tel:+33184160460"><?php echo $generalsetting[0]['phone_no'];?></a></div>
            <div class="header_right">
                <div class="header_search">
                    <div id="sb-search" class="sb-search">
                        <form onSubmit="return false;" action="#">
                            <input id="dd_user_input" class="sb-search-input"  placeholder="Rechercher" type="text" name="search" id="search" />
                            <input class="sb-search-submit" type="submit" value="" />
                            <span class="sb-icon-search"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End header -->
	
	<?php		
		$slug			  = $this->uri->segment_array();	
		$checkdestorpro = array_slice($slug,0,1);	
		$checkpro 		= array_slice($slug,1,1);	
		$commod = new Commonlibmodel();		
		if(isset($checkdestorpro[0]) && !empty($checkdestorpro[0]) && $checkdestorpro[0] == 'destination')	
		{				
			$destinationslug 	= array_slice($slug,1,2);
			$destinationname 	  = $commod->getcatslugtocatname($destinationslug[0]);
			echo "<form name='qutoinform' id='qutoinform' method='post'><input type='hidden' name='hidden_qutoinform' id='hidden_qutoinform' value='".$destinationname."'>";	
			echo "<input type='hidden' name='hidden_qutoinform_type' id='hidden_qutoinform_type' value='destination'></form>";	
		}	
		else if(isset($checkpro[0]) && !empty($checkpro[0]) && $checkpro[0] == 'voyages')	
		{		
			$productslug	 	  = array_slice($slug,-1,1);	
			$pronamename 	 	  = $commod->getproslugtoproname($productslug[0]);
			echo "<form name='qutoinform' id='qutoinform' method='post'><input type='hidden' name='hidden_qutoinform' id='hidden_qutoinform' value='".$pronamename."'>";	
			echo "<input type='hidden' name='hidden_qutoinform_type' id='hidden_qutoinform_type' value='voyage'></form>";				
		}		
	?>
	<script type="text/javascript">
	function  fillpurlstring()
	{
		document.getElementById('qutoinform').action = '<?php echo $this->config->base_url().'demandededevis';?>';
		document.getElementById("qutoinform").submit();
		
	}
	
	$("#Devis-misc").click( function() {
		$(window).scrollTop(0);
	});
	</script>
	


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


<div id="wizard" class="swMainpop"></div>
				
<div class="Contact_bg_mn">	
	<div class="wrapper">
        <div class="conatct_top_row_mn">
            <h1>Demande De <span>Devis</span></h1>
        </div>
		<div class="demandededevis">
        	<form action="<?php echo $this->config->base_url();?>contact/simplerequestquotefrm" method="post" name="requestfrm" id="requestfrm" >
            	<input type="hidden" name="issubmit" value="1">
                <div id="wizard" class="swMainpop">
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
                            <h2 class="demandededevis_step2_lab">VOS COORDONN&Eacute;ES</h2>    
                            <div>    
                                <!--<span class="part-top">Vos coordonnées : </span>    -->
                                <div class="top-field-cols_right">    
	                                <div class="top-field">    
    	                                <div class="top-field-cols">    
        	                                <input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="name" id="name" value="Nom">
                                            <div id="msg_name" class="msg_step2_error"></div>
                                        </div>
                                        <div class="top-field-cols top-field-cols1">
                                        	<input type="hidden" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="firstname" id="firstname" value=" ">
                                            <div id="msg_firstname" class="msg_step2_error"></div>
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
                                <!--<span class="part-bottom">Vous voyagez : </span>     
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
                                </div>    -->
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

<script type="text/javascript">
$( document ).ready(function() {
	$('.frmname').hide();
});

$( document ).ready(function() {
	tabcalling2();
});
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
$('.buttonNext').hide();

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
	  $("#msg_destination").html("Veuillezchoisirune destination").show();
	}
	else
	{
		isValid = true;
		$("#msg_destination").html("").hide();
	} 
	var name = $("#name").val();
	if(!name && name.length < 0 || name == "Nom"){
	   isValid = false;
	   if(!focusOn)
	   {
		focusOn=document.getElementById("name");
	   }
	   $("#msg_name").html("Veuillez entrer votre nom").show();
	   
	}else{
	   $("#msg_name").html("").hide();
	}
	
	var firstname = $("#firstname").val();
	if(!firstname && firstname.length < 0 || firstname == "Prénom"){
	   isValid = false;
	   if(!focusOn)
	   {
		focusOn=document.getElementById("firstname");
	   }
	   $("#msg_firstname").html("Veuillez entrer votre prénom").show();
	}else{
	   $("#msg_firstname").html("").hide();
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
		$("#msg_email").html("Veuillezentrervotre L’emailsemble").show();
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
		$("#msg_phone").html("Veuillezentrervotre Le n° de telephonesemble").show();
	} 

var selecttabidname = document.getElementById('selecttabidname').value;
if(selecttabidname == '#tab-2')
{
	$("#group_adults").html("").hide();
	var familyadults = $("#adults").val();
	var familychildren = $("#children").val();
	
	if (familyadults.length == 0 && familychildren.length == 0) {
		isValid = false;
		if (!focusOn) {
			focusOn = document.getElementById("adults");
		}
		$("#family_adults").html("Veuillez renseigner les informations demandées").show();
	} else {
		$("#family_adults").html("").hide();
	}
	}
	else if(selecttabidname == '#tab-3')
	{
		$("#family_adults").html("").hide();
		var groupadults = $("#adults3").val();
		var groupchildren = $("#children3").val();
		if (groupadults.length == 0 && groupchildren.length == 0) {
			isValid = false;
			if (!focusOn) {
				focusOn = document.getElementById("adults3");
			}
			$("#group_adults").html("Veuillez renseigner les informations demandées").show();
		} else {
			$("#group_adults").html("").hide();
		}
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

		$("#msg_price").html("Veuillez rentrer un budget").show();

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



<input type="hidden" id="selecttabidname" name="selecttabidname" value=""> 
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/footer_js.js"></script>
<?php
$slug			  = $this->uri->segment_array();	
$marigepage       = end($slug);
if($marigepage != 'liste-de-mariage'){?>
	<script type="text/javascript">
	function tabcalling(){jQuery("#tabs-container ul li:first a").trigger("click")}function tabcalling2(){jQuery("#tabs-container ul li:first a").trigger("click")}function getScrollTop(){if("undefined"!=typeof pageYOffset)return pageYOffset;var e=document.body,t=document.documentElement;return t=t.clientHeight?t:e,t.scrollTop}var drp=jQuery.noConflict();drp("input:checkbox").uniform(),drp(document).ready(function(){drp(".cu_dds").selectbox("","searchbox")}),drp(document).ready(function(){drp(".cu_dds2").selectbox("","searchbox")}),drp(document).ready(function(){drp(".cu_dds3").selectbox("","searchbox")});var jQuery=jQuery.noConflict();jQuery("#product-tabs li a").click(function(e){e.preventDefault(),jQuery("#product-content > div").hide();var t=jQuery(this).attr("href"),r=jQuery(this).attr("id");jQuery("#product-content div"+t).show(),jQuery("#product-tabs > li").removeClass("active"),jQuery(r).addClass("active")}),jQuery(".tabs-menu a").click(function(e){e.preventDefault(),jQuery(this).parent().addClass("current"),jQuery(this).parent().siblings().removeClass("current");var t=jQuery(this).attr("href");jQuery(".tab-content").not(t).css("display","none"),jQuery(".tab-content"+t).show();var r=jQuery(this).attr("href");document.getElementById("selecttabidname").value=r});var jqr2=jQuery.noConflict();jqr2(document).ready(function(){jqr2(".hide-this-part").hide(),jqr2(".hide-this-part-more").click(function(){var e=jqr2("#"+this.id).next();if(e.slideToggle("slow"),"invisible"===e.attr("status"))e.attr("status","visible"),jqr2("#"+this.id).addClass("visible");else{e.attr("status","invisible");{jqr2("#"+this.id).attr("morelink-text")}jqr2("#"+this.id).removeClass("visible"),jqr2("#"+this.id).show()}})}),new UISearch(document.getElementById("sb-search")),jQuery(document).ready(function(){jQuery(window).scroll(function(){getScrollTop()>100?jQuery(".contact-btn").addClass("fixed"):jQuery(".contact-btn").removeClass("fixed"),getScrollTop()>500?jQuery(".pagination").addClass("fixed_show"):jQuery(".pagination").removeClass("fixed_show")})});
	var poup=jQuery.noConflict();poup(document).ready(function(){poup("#product-content a").addClass("group2"),poup("#product-content a").each(function(){poup(this).attr("href",poup.trim(poup(this).attr("href")))}),poup(".blog-content .blog-description a img").each(function(){poup(this).parent().addClass("group2"),poup(this).parent().attr("href",poup.trim(poup(this).parent().attr("href")))})}),poup(document).ready(function(){poup(".group2").colorbox({rel:"group2",transition:"fade"})});
	function showfrm(o){tabcalling(),$("#showfrms").toggle(function(){$("#showfrms").hide()},function(){$("#showfrms").show()}),$("#frmname").html(o)}function hidefrm(){$("#showfrms").hide()}var auto=jQuery.noConflict();auto(function(){auto("#dd_user_input").autocomplete({source:"<?php echo $this->config->site_url();?>ajaxcall/autocomplete_search",minLength:2,select:function(o,t){var e=t.item.id;"#"!=e&&(location.href=e)},html:!0,open:function(){auto(".ui-autocomplete").css("z-index",1e3)}})});
	</script>
<?php } ?>	

<!--Start of Ve Script-->
<script type="text/javascript">
!function(){var a=document.createElement("script");a.type="text/javascript",a.async=!0,a.src="//config1.veinteractive.com/tags/EDD97E53/AC4A/4321/87E9/3B1A2101A7D0/tag.js";var b=document.getElementsByTagName("head")[0];if(b)b.appendChild(a,b);else{var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)}}();
</script>
<!--End of Ve Script-->
</script>
<!--- RESPONSIVE MENU ADD CSS AND JS -->
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery.mmenu.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $this->config->base_url();?>assets/front/css/jquery.mmenu.css" media="screen, projection"/>
<!--- RESPONSIVE MENU ADD CSS AND JS -->
<?php 
$filename 		= str_replace(':','',$this->session->userdata['ip_address']);
?>

<script type="text/javascript">
function captcha_ref()
{
	var imgsrcreq = "<?php echo $this->config->site_url();?>application/views/contact/imagebuilder.php";
	logf(".captcha_codeclass_image").attr("src", imgsrcreq + '?timestamp=' +  new Date().getTime());
	
}
</script>

<style>
.loader {color: #fff !important;}
</style>
</body>
</html>
