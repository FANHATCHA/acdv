<!DOCTYPE html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<!--Beampulse-->
<script type="text/javascript"> (function() { var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = ('https:' == document.location.protocol ? 'https://' : 'http://' )+'js-project.s3.amazonaws.com/AS-2313074.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x); })();</script><!--Beampulse-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$urlsegment 	  = $this->uri->rsegments[1];
if(isset($urlsegment) && !empty($urlsegment) && $urlsegment == 'home') {?>
<title>Au Coeur du Voyage - Voyages sur mesure Océan Indien, Polynésie, États-Unis et Asie</title>
<?php }else{ ?>
<title><?php echo $page_title;?> | Au Coeur du Voyage</title>
<?php } ?>

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
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/allcssload.css?version=55" type="text/css"/>
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/style.css?version=55" type="text/css" />
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/responsive.css?version=54" type="text/css" />

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
</script>

<script type="text/javascript">var jqfrm3=jQuery.noConflict();jqfrm3(document).ready(function(){jqfrm3("#from").Zebra_DatePicker({always_visible:jqfrm3("#container"),pair:jqfrm3("#to"),firstDay:1,direction:!0,format: 'd/m/y'}),jqfrm3("#to").Zebra_DatePicker({selectWeek:!0,always_visible:jqfrm3("#container2"),direction:!0,format: 'd/m/y'})}),jqfrm3(function(){jqfrm3("#slider").nivoSlider({effect:"fade",slices:1,boxCols:8,boxRows:4,animSpeed:500,pauseTime:3000,startSlide:0,directionNav:true,directionNavHide:false,controlNav:true,keyboardNav:true,pauseOnHover:true,manualAdvance:false})});</script>

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
(function(a,e,c,f,g,h,b,d){var k={ak:"1015212314",cl:"q_OtCOnu6GAQmtKL5AM",autoreplace:"+33 (0) 1 84 21 42 12"};a[c]=a[c]||function(){(a[c].q=a[c].q||[]).push(arguments)};a[g]||(a[g]=k.ak);b=e.createElement(h);b.async=1;b.src="//www.gstatic.com/wcm/loader.js";d=e.getElementsByTagName(h)[0];d.parentNode.insertBefore(b,d);a[f]=function(b,d,e){a[c](2,b,k,d,null,new Date,e)};a[f]()})(window,document,"_googWcmImpl","_googWcmGet","_googWcmAk","script");
</script>
<link href="<?php echo $this->config->base_url();?>assets/front/css/visualcaptcha.css" media="all" rel="stylesheet">
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
	<nav id="menu" class="menu_responsive">
    	<ul>
			<?php
			$menuleve_data = json_decode($menulist[0]['menuleve_data'],true);
            $modelc = new Commonlibmodel();
            $main_menu_mobile = $modelc->menutreestructure_mobile($menuleve_data);
			echo $main_menu_mobile;
			?>
        </ul>
    </nav>
    <!-- Start header -->
    <div class="header_top">
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
    <div id="header">    	
    	<div class="wrapper">
        	<a href="#menu" class="menu_ic_mn">menu</a>
    		<h1 id="logo"><a href="<?php echo $this->config->base_url();?>"><img width="386" height="87" src="<?php echo $this->config->base_url();?>assets/front/images/logo.png" alt="" /></a></h1>
			<?php /*================================================= MENU PART START =================================================*/ ?>
        	<div class="menu">
        	<ul>
				<?php 
					$menuleve_data = json_decode($menulist[0]['menuleve_data'],true);
					$modelc = new Commonlibmodel();
					$main_menu = $modelc->menutreestructure($menuleve_data);
					echo $main_menu;
				?>
            </ul>	
        </div>
			<?php /*================================================= MENU PART END =================================================*/ ?>       
        </div>
    </div>
	<?php
	$urlsegment 	  = $this->uri->rsegments[1];
	if(isset($urlsegment) && !empty($urlsegment) && $urlsegment != 'demandededevis'){
		if(isset($urlsegment) && !empty($urlsegment) && $urlsegment == "home" || ($urlsegment != "destination" && $urlsegment != 'voyages' && $urlsegment != 'tags' && $urlsegment != 'clientreview' && $this->uri->uri_string !='confirmation-envoi-message' && $this->uri->uri_string !='confirmation-demande-de-devis')){
		?>
		<div class="if_not_homepage">
			<div class="contact-btn">
				<div class="quotestion_frm_mobile">
					<a href="<?php echo $this->config->base_url().'demandededevis';?>">DEMANDE DE DEVIS</a>
				</div>
				<a id="Devis-misc" onClick="showhidefrm();ga('send', 'event', 'Devis', 'click', 'Misc-Top');" class="header_right_btn"><?php echo $this->lang->line('RECEVEZ_ALL_PAGES_BUTTON_HOME');?></a>
				<div id="hideshow-frm" style="display:none">
					<div class="home_bg_popup" onClick="showhidefrm();"></div>
					<div class="home_bg_wi">
					<?php 
					$commonmod   =   new Commonlibmodel();
					$AllFieldFrm =   $commonmod->ContactAllFiledFrm();
					echo $AllFieldFrm;
					?>
					</div>
				</div> 
			</div>
        </div>
		<script type="text/javascript">
			$(document).keyup(function(e) {
			  if (e.keyCode == 27) { showhidefrmesc(); } 
			});
		</script>
		<?php }else if(isset($urlsegment) && !empty($urlsegment) && $urlsegment == "destination" || $urlsegment == 'voyages'){ ?>
		<div class="if_not_homepage">
			<div class="contact-btn">
				<div class="quotestion_frm_mobile">
					<a onclick="fillpurlstring();">DEMANDE DE DEVIS</a>
				</div>
			</div>
		</div>	
	    <div class="if_not_homepage1">
			<div class="contact-btn" style="display:none" id="showfrms">
				<!--<a onClick="hidefrm()" class="header_right_btn" id="frmname"></a>-->
				<div id="hideshow-frm">
					<div class="home_bg_popup" onClick="hidefrm();"></div>
					<div class="home_bg_wi">
					<?php 
						$commonmod   =   new Commonlibmodel();
						$AllFieldFrm =   $commonmod->ContactFiledFrm();
						echo $AllFieldFrm;
					?>
					</div>
				</div> 
			</div>
        </div>
		<script type="text/javascript">
			$(document).keyup(function(e) {
			  if (e.keyCode == 27) { hidefrmesc(); } 
			});
		</script>
		<?php }else if(isset($urlsegment) && !empty($urlsegment) && $urlsegment != "destination" && $urlsegment != 'voyages' && $urlsegment != "home"){ ?>
		<div class="if_not_homepage">
			<div class="contact-btn">
				<div class="quotestion_frm_mobile">
					<a  href="<?php echo $this->config->base_url().'demandededevis';?>">DEMANDE DE DEVIS</a>
				</div>
			</div>
		</div>	
		<div class="if_not_homepage">
		<div class="contact-btn" style="display:none" id="showfrms">
			<a onClick="hidefrm()" class="header_right_btn" id="frmname"></a>
			<div id="hideshow-frm">
				<div class="home_bg_popup" onClick="hidefrm();"></div>
				<div class="home_bg_wi">
				<?php 
					$commonmod   =   new Commonlibmodel();
					$AllFieldFrm =   $commonmod->ContactAllFiledFrm();
					echo $AllFieldFrm;
				?>
				</div>
			</div> 
		</div>
        </div>
		<script type="text/javascript">
			$(document).keyup(function(e) {
			  if (e.keyCode == 27) { hidefrmesc(); } 
			});
		</script>
		<?php } 
	}?>	
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
	