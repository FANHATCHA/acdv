<!DOCTYPE html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript"> (function() { var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = ('https:' == document.location.protocol ? 'https://' : 'http://' )+'js-project.s3.amazonaws.com/AS-2313074.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x); })();</script>
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

<?php if(isset($robots) && !empty($robots) && $robots == 'no'){?>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<?php } ?>

<?php if(isset($canonical) && !empty($canonical)){?>
<link rel="canonical" href="<?php echo $canonical;?>" />
<?php } ?>

<link rel="icon"        href="<?php echo $this->config->base_url();?>assets/front/images/favicon.ico"     type="image/png" >
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/allcssload.css"     type="text/css"/>
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/style.css"          type="text/css" />
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery-1.7.1.min.js"></script>

<?php /*
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/slick.css"          type="text/css"/>
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/lightSlider.css"    type="text/css"/>
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/nivo-slider.css"    type="text/css" />
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/style.css"          type="text/css" />
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/jquery-ui.css"      type="text/css"/>
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/datepicker/reset.css"   type="text/css"/>
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/datepicker/default.css" type="text/css"/>
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/smart_wizard_vertical.css" type="text/css"/>
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/css/autocomplate.css"  type="text/css" />
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/front/colorbox/colorbox.css" type="text/css">  
<link rel="stylesheet"  href="<?php echo $this->config->base_url();?>assets/plugins/uniform/front/uniform.default.css"  type="text/css" />
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/datepicker/zebra_datepicker.js"></script>*/?>

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
var jqfrm3=jQuery.noConflict();jqfrm3(document).ready(function(){jqfrm3("#from").Zebra_DatePicker({always_visible:jqfrm3("#container"),pair:jqfrm3("#to"),firstDay:1,direction:!0}),jqfrm3("#to").Zebra_DatePicker({selectWeek:!0,always_visible:jqfrm3("#container2"),direction:!0})}),jqfrm3(function(){jqfrm3("#slider").nivoSlider({effect:"fade",slices:15,boxCols:8,boxRows:4,animSpeed:500,pauseTime:3000,startSlide:0,directionNav:true,directionNavHide:false,controlNav:true,keyboardNav:true,pauseOnHover:true,manualAdvance:false})});
</script>
<?php /*<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/main.js"></script> 
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/searchbar/modernizr.custom.js"></script>*/?>
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
</head>
<?php
function string_limit($string, $limit) { 
	$string = substr($string, 0, strrpos(substr($string, 0, $limit), ' ')) . '...'; 
	return $string;
}

?>
<body>
    <!-- Start header -->
    <div class="header_top">
    	<div class="wrapper">
        	<div class="header_call"><span><img src="<?php echo $this->config->base_url();?>assets/front/images/telephone.png" alt="Tél.:" border="0" height="21px" width="19px"/></span> <?php echo $generalsetting[0]['phone_no'];?></div>
            <div class="header_right">
                <div class="header_search">
                    <div id="sb-search" class="sb-search">
                        <form onsubmit="return false;" action="#">
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
			<a id="Devis-misc" onclick="showhidefrm();ga('send', 'event', 'Devis', 'click', 'Misc-Top');" class="header_right_btn"><?php echo $this->lang->line('RECEVEZ_ALL_PAGES_BUTTON_HOME');?></a>
			<div id="hideshow-frm" style="display:none">
				<div class="home_bg_popup" onclick="showhidefrm();"></div>
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
        <div class="if_not_homepage1">
		<div class="contact-btn" style="display:none" id="showfrms">
			<a onclick="hidefrm()" class="header_right_btn" id="frmname"></a>
			<div id="hideshow-frm">
				<div class="home_bg_popup" onclick="hidefrm();"></div>
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
		<div class="contact-btn" style="display:none" id="showfrms">
			<a onclick="hidefrm()" class="header_right_btn" id="frmname"></a>
			<div id="hideshow-frm">
				<div class="home_bg_popup" onclick="hidefrm();"></div>
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
	
	


