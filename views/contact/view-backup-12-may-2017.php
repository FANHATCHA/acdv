<?php
header('Content-Type: text/html; charset=utf-8'); 
?>
<div id="container">
	<div class="Contact_bg_mn">
		<div class="wrapper">
	    	<div class="conatct_top_row_mn">
            	<?php echo $companyinfo[0]['description'];?>
			</div>    
            <div class="conatct_top_left">
    <?php 
	$succ_update_contact = $this->session->userdata('succ_update_contact');
	if(isset($succ_update_contact) && !empty($succ_update_contact))
	{
		echo $succ_update_contact;
		$this->session->unset_userdata('succ_update_contact');
	}
	?>
	<?php $hidden = array('type' => 'contact', 'prod' => ''); ?>
	
	<?php $attributes = array('class'=>'contact','id'=>'contactsForm');?>
	<?php echo form_open('contact/add',$attributes,$hidden); ?>
	<?php
	if(validation_errors()){?>
		<strong><?php echo validation_errors(); ?></strong>
	<? } ?> 
	<div class="form-group">
		<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="firstname" id="firstname" placeholder="Nom">
	</div>
	<div class="form-group">
		<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="lastname" id="lastname" placeholder="Prénom">
	</div>
	<div class="form-group">
		<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="email" id="email" placeholder="Email">
	</div>
	<div class="form-group">
		<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="phone" id="phone" placeholder="Téléphone">
	</div>
	<div class="form-group">
		 <textarea id="comment" name="comment"  placeholder="Votre message"></textarea>              			
	</div>
	<div class="form-group">
		<img class="captcha_codeclass_image" src="<?php echo $this->config->site_url();?>application/views/contact/imagebuilder.php">
		<input class="captcha_codeclass" onclick="check_captchacode();" onfocus="check_captchacode();" onblur="check_captchacode();" type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="captcha" id="captcha" placeholder="Captcha">
		<div class="error" for="captch_notmatch" id="captch_notmatch"></div>
	</div>
	<div class="form-group form_group_btn_left">
    	<div id="uniform-category" class="chaeckbox_mn_align">
        	<span><input type="checkbox" id="accept" name="accept"></span>
        </div>
        J’accepte de recevoir des offres ou articles intéressants par email		
	</div>
	<div class="form-group form-group-btn">
		<?php echo form_submit(array('id' => 'submit','name'=>'submit','value' => 'ENVOYER','onclick'=>'check_captchacode()')); ?>
	</div>
	<input type="hidden" name="captchavalid" id="captchavalid" value="0"/>
	<?php
	$token = uniqid();
	//$tokens = array();
	if($this->session->userdata('token')){
		$tokens = $this->session->userdata('token');
	}
	$token_value = md5(rand(9000,1055548).'allfield');
	$tokens[$token] = $token_value;
	$this->session->set_userdata('token',$tokens);
	?>
	<input type="hidden" name="token" id="token" value="<?php echo $token_value;?>">
	<input type="hidden" name="token_key" id="token_key" value="<?php echo $token;?>">
	<?php echo form_close(); ?>
            </div>
            <div class="conatct_top_right">
            	<?php
				echo $contactrightdescription;	
				?>
				<iframe width="370" height="275" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Au%20Coeur%20du%20Voyage%2C%20Bagnolet%2C%20France&key=AIzaSyDxR29bNtRzBkt3K92opTHVWaEkEBuSl7c"></iframe>
            </div>
			<!-- <div class="conatct_map">
            	<?php /*<iframe src="https://mapsengine.google.com/map/embed?mid=zMxG08yRUQaY.kICX9zf4EUR0" width="100%" frameborder="0" height="480"></iframe>*/?>
            </div>-->
    	</div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $.validator.addMethod("customrule", function(e, i, r) {
        return this.optional(i) || e != r
    }, "You must enter {0}"), $("#contactsForm").validate({
        rules: {
            firstname: {
                required: !0
            },
            lastname: {
                required: !0
            },
            email: {
                required: !0,
                email: !0
            },
            phone: {
                number: !0,
                required: !0
            },
            comment: {
                required: !0
            },
            captcha: {
                required: !0
            }
        },
        messages: {
            firstname: {
                required: "Ce champ est obligatoire"
            },
            lastname: {
                required: "Ce champ est obligatoire"
            },
            email: {
                required: "Ce champ est obligatoire",
				email:"L'email semble incorrect"
            },
            phone: {
                required: "Ce champ est obligatoire",
                number: "Le téléphone semble incorrect"
            },
            comment: {
                required: "Ce champ est obligatoire"
            },
            captcha: {
                required: "Ce champ est obligatoire"
            }
        },
        submitHandler: function(e) {
			if($('#captchavalid').val() == '1')
			{			
				e.submit()
			}
        }
    })
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
</script>

