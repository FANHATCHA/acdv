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
<div class="maries">
<div class="client-review-bnner">

	<div class="slider-wrapper theme-default">   

			<div class="slider_search">            	

				<div class="Social_slider">
					<?php 
					$comlibmod   = new Commonlibmodel();
					$socialmedialink = $comlibmod->getsocialiconSlider();
					foreach($socialmedialink as $socialmedialinks){	?>
						<a target="_blank" href="<?php echo $socialmedialinks['url']; ?>" class="<?php echo $socialmedialinks['name']; ?>"><?php echo $socialmedialinks['name']; ?></a>
					<?php } ?>
				</div>

			</div>

			<div id="slider" class="nivoSlider">

				<?php

				if(isset($homeslider) && !empty($homeslider))

				{ 	$i = 1;

					foreach($homeslider as $homeslide)

					{?>

						<img  width="1500" height="400" src="<?php echo $this->config->base_url();?>application/uploads/sliderimages/<?php echo $homeslide['image']; ?>" title="#htmlcaption<?php echo $i;?>" alt="<?php echo $homeslide['slider_title']; ?>" />

					<?php $i++;

					}

				}

				?>

			</div>

			<?php

			if(isset($homeslider) && !empty($homeslider))

			{ $i = 1;

				foreach($homeslider as $homeslide)

				{?>

					<div id="htmlcaption<?php echo $i;?>" class="nivo-html-caption">

						<h1><?php echo $homeslide['slider_title'];?> </h1>

						<h3><?php echo $homeslide['short_description'];?></h3>

						<p><?php echo $homeslide['description'];?></p>

					</div>

				<?php $i++;

				}

			}

			?>

	</div>	

</div>	

<div class="wrapper">

	<div class="maries_page">

		<div class="description">

			<?php echo $cmspagedetails['cms_content']; ?>

			<div class="hide-this-part-wrap">

				<h3 morelink-text="Remplir le formulaire de contact" id="hide-this-part-4" class="hide-this-part-more">Remplir le formulaire de contact</h3>

				<div class="hide-this-part" status="invisible" style="display: none;">

					<div class="contact_maries">

						<?php 

						$succ_update_contact_maries = $this->session->userdata('succ_update_contact_maries');

						if(isset($succ_update_contact_maries) && !empty($succ_update_contact_maries))

						{

							echo $succ_update_contact_maries;

							$this->session->unset_userdata('succ_update_contact_maries');

						}

						?>

						<?php $hidden = array('type' => 'contact', 'prod' => ''); ?>

						<?php $attributes = array('class'=>'contact','id'=>'contactsForm_maries');?>

						<?php echo form_open('contact/maries',$attributes,$hidden); ?>

						<?php

						if(validation_errors()){?>

							<strong><?php echo validation_errors(); ?></strong>

						<? } ?> 

						<div class="form-group">

							<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="firstname" id="firstname" placeholder="Nom et Prénom">

						</div>

						<div class="form-group form-group_right form_group_right_drop">

							<label>Votre destination</label>

							<select name="destination" id="destination" class="cu_dds">

								<option value="">Choisir un Pays</option>

								<?php

								foreach($catname as $catnames){?>

									<option value="<?php echo $catnames;?>"><?php echo $catnames;?></option>

								<?php }?>

							</select>  

						</div>

						<input type="hidden" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="lastname" id="lastname" placeholder="Prenom">

						<div class="form-group fclear">

							<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="email" id="email" placeholder="Email">

						</div>

						<div class="form-group form-group_right">

							<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="phone" id="phone" placeholder="Téléphone">

						</div>

						<div class="form-group">

							 <textarea id="comment" name="comment"  placeholder="Quel est votre projet de voyage ?"></textarea>              			

						</div>

						<div class="form-group form_group_btn_left">

							<div id="uniform-category" class="chaeckbox_mn_align">

								<span><input type="checkbox" id="accept" name="accept"></span>

							</div>

							J’accepte de recevoir des offres ou articles intéressants par email		

						</div>

						<div class="form-group form-group-btn">

							<?php echo form_submit(array('id' => 'submit','name'=>'submit','value' => 'ENVOYER')); ?>

						</div>
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
                    <div class="fclear"></div>

				</div>	

			</div>

		</div>

		

	</div>

</div>


