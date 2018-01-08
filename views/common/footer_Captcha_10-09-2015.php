<div id="footer">
	<input type="hidden" id="selecttabidname" name="selecttabidname" value=""> 
<div class="wrapper"> 
			
        	<div class="footer_cols">
				<?php echo $footerblock[0]['footer_content'];?>
            </div>
            <div class="footer_cols1">
            	<h4>Newsletter</h4>
                <p>Soyez au courant de nos dernières offres et bons plans </p>
				
				<?php 
				$succ_update = $this->session->userdata('succ_update');
				$already_exists = $this->session->userdata('already_exists');
				if(isset($succ_update) && !empty($succ_update))
				{
					echo $succ_update;
					$this->session->unset_userdata('succ_update');
				}
				else if(isset($already_exists) && !empty($already_exists))
				{
					echo $already_exists;
					$this->session->unset_userdata('already_exists');
				}
				?>
				
				<form name="newsletter" id="newsletter" method="post" action="<?php echo $this->config->site_url();?>home/subscribe">
					<input type="text" name="nesname" id="nesname" onblur="if (this.value == '') {this.value = 'Votre Nom';} " onfocus="if (this.value == 'Votre Nom') {this.value = '';}" value="Votre Nom" />
					<input type="text" name="nesemail" id="nesemail" onblur="if (this.value == '') {this.value = 'Votre Adresse email';} " onfocus="if (this.value == 'Votre Adresse email') {this.value = '';}" value="Votre Adresse email" />                
					<input class="submit_btn" type="submit" value="Souscrire" />
				</form>
				
            </div>
            <div class="footer_cols2">
            	<h4>Contactez-Nous</h4>
				<p>
					<?php echo $generalsetting[0]['address'];?>
					<br/>
					Email : <a href="mailto:<?php echo $generalsetting[0]['email_id'];?>"><?php echo $generalsetting[0]['email_id'];?></a>
					<br />Tél. : <?php echo $generalsetting[0]['phone_no'];?>
				</p>
                <div class="footer_icon">
					<?php foreach($socialicon as $socialicons){?>
						<a href="<?php echo $socialicons['url'];?>" target="_blank" class="footer_<?php echo $socialicons['name'];?>"></a>
					<?php } ?>
                </div>
			</div>
    </div>
</div>
<div style="float:none; clear:both; width:auto;"></div>



<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/footer_js.js"></script>
<?php 
$slug = $this->uri->segment_array();
$destslugcheck  = array_slice($slug,1,1);
if(isset($destslugcheck[0]) && !empty($destslugcheck[0]) && $destslugcheck[0] == 'voyages'){?>
	<script type="text/javascript">
	var drpss = jQuery.noConflict();
		drpss( document ).ready(function() {
		  drpss("#sticker2").sticky({bottomSpacing:640, center:true, className:"hey" });
		});
	</script>
<?php }else{ ?>
	<script type="text/javascript">
	var drpss = jQuery.noConflict();
		drpss( document ).ready(function() {
		  drpss("#sticker").sticky({bottomSpacing:320, center:true, className:"hey" });
		});
	</script>
<?php } ?>
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

<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?1ijE8cH4flH0ZBIBgldma1Tp4FVq8uxw";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");

function showhidefrmesc(){jqfrm("#hideshow-frm").hide(),jqfrm(".stepContainer").height("310")}
function hidefrmesc(){$("#showfrms").hide()} 
</script>
<!--End of Zopim Live Chat Script-->
<script type="text/javascript">
var blog_cat_m = jQuery.noConflict();
blog_cat_m(document).ready(function() {
	blog_cat_m('#mobile_left_panel_blog').hide();
	blog_cat_m("#category_show_mobile").click(function() {
		blog_cat_m('#mobile_left_panel_blog').toggle();
	});
});

</script>
<!--Start of Ve Script-->
<script type="text/javascript">
!function(){var a=document.createElement("script");a.type="text/javascript",a.async=!0,a.src="//config1.veinteractive.com/tags/EDD97E53/AC4A/4321/87E9/3B1A2101A7D0/tag.js";var b=document.getElementsByTagName("head")[0];if(b)b.appendChild(a,b);else{var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)}}();
</script>
<!--End of Ve Script-->
</script>
<!--- RESPONSIVE MENU ADD CSS AND JS -->
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/front/js/jquery.mmenu.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $this->config->base_url();?>assets/front/css/jquery.mmenu.css" media="screen, projection"/>
<script type="text/javascript">
	var menu_mobile22 = jQuery.noConflict();
	menu_mobile22(function() {
		menu_mobile22('nav#menu').mmenu();
	});			
</script>
<!--- RESPONSIVE MENU ADD CSS AND JS -->


<!--- RESPONSIVE MENU ADD CSS AND JS -->

<?php 
$filename 		= str_replace(':','',$this->session->userdata['ip_address']);
?>
<script type="text/javascript">
var logf = jQuery.noConflict();
logf("a#step1").click(function(){
	$('.buttonFinish').hide();
	var txtfileurl = "<?php echo $filename;?>.txt";
	var agentdetails = "<?php echo $this->session->userdata['user_agent']?>";
	var destination = logf('#dest_input').val();
	if(typeof destination != 'undefined')
	{
		var pageurl = document.URL;
		var datas = "\r\n PAGE URL "+"\r\n\r\n"+pageurl;
		datas += "\r\nSTEP 1"+"\r\n\r\n"+destination;
		var url = "<?php echo $this->config->base_url();?>quotations_log/write.php";
		$.ajax({
			type: "POST",
			url: url,
			data: {"filename" :txtfileurl,'data':datas,'agentdetails':agentdetails},
			cache: false,
			success: function(data){
			}
		});
	}
	else
	{
		var pageurl = document.URL;
		var datas = "\r\n PAGE URL "+"\r\n\r\n"+pageurl;
		var url = "<?php echo $this->config->base_url();?>quotations_log/write.php";
		$.ajax({
			type: "POST",
			url: url,
			data: {"filename" :txtfileurl,'data':datas,'agentdetails':agentdetails},
			cache: false,
			success: function(data){
			}
		});
	}
	
});
logf("a#step2").click(function(){
	$('.buttonFinish').hide();
	var txtfileurl = "<?php echo $filename;?>.txt";
	var agentdetails = "<?php echo $this->session->userdata['user_agent']?>";
	var name		= logf('#name').val();
	var firstname 	= logf('#firstname').val();
	var email 		= logf('#email').val();
	var phoneno 	= logf('#phoneno').val();
	var datas = "\r\nSTEP 2"+"\r\n\r\n"+name+"\r\n"+firstname+"\r\n"+email+"\r\n"+phoneno;
	var url = "<?php echo $this->config->base_url();?>quotations_log/write.php";
	$.ajax({
		type: "POST",
		url: url,
		data: {"filename" :txtfileurl,'data':datas,'agentdetails':agentdetails},
		cache: false,
		success: function(data){
	    }
    });
});
logf("a#step3").click(function(){
	$('.buttonFinish').hide();
	var txtfileurl = "<?php echo $filename;?>.txt";
	var agentdetails = "<?php echo $this->session->userdata['user_agent']?>";
	var from 		= logf('#from').val();
	var to 			= logf('#to').val();
	var datas = "\r\nSTEP 3"+"\r\n\r\n"+from+"\r\n"+to;
	var url = "<?php echo $this->config->base_url();?>quotations_log/write.php";
	$.ajax({
		type: "POST",
		url: url,
		data: {"filename" :txtfileurl,'data':datas,'agentdetails':agentdetails},
		cache: false,
		success: function(data){
	    }
    });
});
logf("a#step4").click(function(){
	
	if($('.swMain .anchor li').length == 6)
	{
		$('.buttonFinish').hide();
	}
	else if($('.swMain .anchor li').length == 5)
	{
		$('.buttonFinish').show();
	}
	var txtfileurl = "<?php echo $filename;?>.txt";
	var agentdetails = "<?php echo $this->session->userdata['user_agent']?>";
	var price 		= logf('#price').val();
	var datas = "\r\nSTEP 4"+"\r\n\r\n"+price;
	var url = "<?php echo $this->config->base_url();?>quotations_log/write.php";
	$.ajax({
		type: "POST",
		url: url,
		data: {"filename" :txtfileurl,'data':datas,'agentdetails':agentdetails},
		cache: false,
		success: function(data){
	    }
    });
});
logf("a#step5").click(function(){
	$('.buttonFinish').show();
	var txtfileurl = "<?php echo $filename;?>.txt";
	var agentdetails = "<?php echo $this->session->userdata['user_agent']?>";
	var comment 		= logf('#comment').val();
	var datas = "\r\nSTEP 5"+"\r\n\r\n"+comment;
	var url = "<?php echo $this->config->base_url();?>quotations_log/write.php";
	$.ajax({
		type: "POST",
		url: url,
		data: {"filename" :txtfileurl,'data':datas,'agentdetails':agentdetails},
		cache: false,
		success: function(data){
	    }
    });
});

function nextbuttoncall()
{
	logf('.stepContainer .content').each(function(){
		var d = logf(this).css('display');
		if(d == 'block' || d == 'inline-block'){
			var activeid = logf(this).attr('id');
			
			
			
			if(activeid == 'step-1')
			{
				logf("a#step1").trigger('click');
			}
			else if(activeid == 'step-2')
			{
				logf("a#step2").trigger('click');
			}
			else if(activeid == 'step-3')
			{
				logf("a#step3").trigger('click');
			}
			else if(activeid == 'step-4')
			{
				logf("a#step4").trigger('click');
			}
			else if(activeid == 'step-5')
			{
				logf("a#step5").trigger('click');
			}
			
			
			if($('.swMain .anchor li').length == 6)
			{
				if(activeid == 'step-4')
				{
					$('.buttonFinish').show();
				}
				else
				{
					$('.buttonFinish').hide();
				}
			}
			else if($('.swMain .anchor li').length == 5)
			{
				if(activeid == 'step-3')
				{
					$('.buttonFinish').show();
				}
				else
				{
					$('.buttonFinish').hide();
				}
			}
		}
	});
	
}

function submitfuncall()
{
	$('#captcha').focus();
	if($('.swMain .anchor li').length == 6)
	{
		validateStep5();  
	}
	else if($('.swMain .anchor li').length == 5)
	{
		validateStep4();  
	}
	
	var txtfileurl = "<?php echo $filename;?>.txt";
	var agentdetails = "<?php echo $this->session->userdata['user_agent']?>";
	var destination = logf('#dest_input').val();
	var name		= logf('#name').val();
	var firstname 	= logf('#firstname').val();
	var email 		= logf('#email').val();
	var phoneno 	= logf('#phoneno').val();
	var from 		= logf('#from').val();
	var to 			= logf('#to').val();
	var price 		= logf('#price').val();
	var comment 		= logf('#comment').val();
	var datas = "\r\nSUBMIT BUTTON CLICK"+"\r\n\r\n"+destination+"\r\n"+name+"\r\n"+firstname+"\r\n"+email+"\r\n"+phoneno+"\r\n"+from+"\r\n"+to+"\r\n"+price+"\r\n"+comment+"\r\n";
	var url = "<?php echo $this->config->base_url();?>quotations_log/write.php";
	$.ajax({
		type: "POST",
		url: url,
		data: {"filename" :txtfileurl,'data':datas,'agentdetails':agentdetails},
		cache: false,
		success: function(data){
	    }
    });
}
//$('.buttonFinish').hide();

/*logf(document).ready(function(){
	logf('.captcha_referesh_tag').click(function(){
		var imgsrcreq = "<?php echo $this->config->site_url();?>application/views/contact/imagebuilder.php";
		logf.get( imgsrcreq, function( data ) {
		  logf(".captcha_codeclass_image").attr("src", imgsrcreq + '?timestamp=' +  new Date().getTime());
		});
		
	});
});*/
function captcha_ref()
{
	var imgsrcreq = "<?php echo $this->config->site_url();?>application/views/contact/imagebuilder.php";
	logf(".captcha_codeclass_image").attr("src", imgsrcreq + '?timestamp=' +  new Date().getTime());
	
}
</script>
</body>
</html>
