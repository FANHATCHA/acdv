
<?php
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
<form action="<?php echo $this->config->base_url();?>contact/prodestinationfrm" method="post" name="requestfrm" id="requestfrm" >
		<input type="hidden" name="issubmit" value="1">
		<div id="wizard" class="swMain">
			<ul>
            	<li class="title_for_pupup"><h2>Demande de devis</h2><br>
					<h3>
					<?php
					$slug			  = $this->uri->segment_array();
					$checkdestorpro	  = array_slice($slug,-2,1);
					
					if(isset($checkdestorpro[0]) && !empty($checkdestorpro[0]) && $checkdestorpro[0] == 'destination' )
					{
						$destinationslug	  = array_slice($slug,-1,1);
						$destinationname 	  = $commod->getcatslugtocatname($destinationslug[0]);
						echo '"'.$destinationname.'"';
						echo "<input type='hidden' name='destinationname' id='destinationname' value='".$destinationname."'>";
					}
					else if(isset($checkdestorpro[0]) && !empty($checkdestorpro[0]) && $checkdestorpro[0] == 'voyages' )
					{
						$productslug	 	  = array_slice($slug,-1,1);
						$pronamename 	 	  = $commod->getproslugtoproname($productslug[0]);
						echo '"'.$pronamename.'"';
						echo "<input type='hidden' name='productname' id='productname' value='".$pronamename."'>";
					}
					?>
					</h3>
				</li>
				<li>
					<a id="step1" href="#step-1">
						PARTICIPANTS
                        <span class="demande_ic_done">&nbsp;</span>
                        <span class="demande_ic_error">&nbsp;</span>
                        <span class="demande_ic_selected">&nbsp;</span>
					</a>
				</li>
				<li>
					<a id="step2" href="#step-2">
						DATES
                        <span class="demande_ic_done">&nbsp;</span>
                        <span class="demande_ic_error">&nbsp;</span>
                        <span class="demande_ic_selected">&nbsp;</span>
					</a>
				</li>
				<li>
					<a id="step3" href="#step-3">
						BUDGET
                        <span class="demande_ic_done">&nbsp;</span>
                        <span class="demande_ic_error">&nbsp;</span>
                        <span class="demande_ic_selected">&nbsp;</span>
					</a>
				</li>
				<li>
					<a id="step4" href="#step-4">
						COMMENTAIRES
                        <span class="demande_ic_done">&nbsp;</span>
                        <span class="demande_ic_error">&nbsp;</span>
                        <span class="demande_ic_selected">&nbsp;</span>
					</a>
				</li>
                <li class="wizard_btn">
                	<a href="#">Recevoir mon devis</a></li>                    
                </li>
			</ul>
			<div id="step-1">
				<span class="part-top">Vos coordonnees</span>
                <div class="top-field-cols_right">
				<div class="top-field">
                	<div class="top-field-cols">
						<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="name" id="name" value="Nom">
						<div id="msg_name" class="msg_step2_error"></div>
                    </div>
                    <div class="top-field-cols top-field-cols1">
						<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="firstname" id="firstname" value="Prenom">
						<div id="msg_firstname" class="msg_step2_error"></div>
                    </div>
				</div>
				<div class="bottom-field">
                	<div class="top-field-cols">
						<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="email" id="email" value="Adresse email">
						<div id="msg_email" class="msg_step2_error"></div>
                    </div>
                    <div class="top-field-cols top-field-cols1">
						<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="phoneno" id="phoneno" value="N&#176; de telephone">
						<div id="msg_phone" class="msg_step2_error"></div>
                    </div>
				</div>
                </div>
				<span class="part-bottom">Vous voyagez:</span> 
				<div id="tabs-container">
					<ul class="tabs-menu">
						<li class="current"><a href="#tab-1">En famille</a></li>
						<li><a href="#tab-2">Seul</a></li>
						<li><a href="#tab-3">En Couple</a></li>
						<li><a href="#tab-4">Entre Amis</a></li>
						<li><a href="#tab-5">En Groupe</a></li>
					</ul>
					<div class="tab">
						<div id="tab-1" class="tab-content">
							<label>Nombre &#271;adultes</label>
							<input type="text" name="adults" id="adults" size="5">
							<label>Nombre &#271;enfants</label>
							<input type="text" name="children" id="children" size="5">
						</div>
						<div id="tab-2" class="tab-content">
							<label>
								<div id="uniform-category" class="chaeckbox_mn_align">
									<span><input type="checkbox" name="seul" id="seul" size="15"></span>
								</div>
								Seul
							</label>
						</div>
						<div id="tab-3" class="tab-content">
							<label>
								<div id="uniform-category" class="chaeckbox_mn_align">
									<span><input type="checkbox" name="couple" id="couple" size="15"></span>
								</div>
								Voyage de noces ?
							</label>
						</div>
						<div id="tab-4" class="tab-content">
							<label>Nombre &#271;adultes</label>
							<input type="text" name="adults2" id="adults" size="5">
							<label>Nombre &#271;enfants</label>
							<input type="text" name="children2" id="children" size="5">
						</div>
						<div id="tab-5" class="tab-content">
							<label>Nombre &#271;adultes</label>
							<input type="text" name="adults3" id="adults" size="5">
							<label>Nombre &#271;enfants</label>
							<input type="text" name="children3" id="children" size="5">
						</div>
					</div>
				</div>
			</div>      
			
			<div id="step-2">
            	<div class="step-3-cols">
					<label for="from">Date de d&eacute;part</label>
					<input type="hidden" id="from" name="from"> 
					<div id="container" style="margin: 10px 0 0 0; height: 250px"></div>               
					<div id="msg_from" class="msg_step2_error"></div>
                </div>
                <div class="step-3-cols">
					<label for="to">Date de retour</label>
					<input type="hidden" id="to" name="to">	
					<div id="container2" style="margin: 10px 0 0 0; height: 250px"></div>	
					<div id="msg_to" class="msg_step2_error"></div>
                </div>
                <div class="step-3-cols1">
					<label>
						<div id="uniform-category" class="chaeckbox_mn_align">
							<span><input type="checkbox" id="flexibles" name="flexibles"></span>
						</div>
						Dates flexibles?
					</label>
                </div>
			</div>
			<div id="step-3">
				<input type="text" name="price" id="price"><label> &#128; par personne </label>
				<div id="msg_price"></div>	
			</div>
			<div id="step-4">
				<label>Lorem ipsum dolor sit amet,consectetur adipiscing elit.</label>
				<textarea id="comment" name="comment" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">S'agit-il de votre voyage de noces ? Que souhaiteriez vous modifier ou ajouter a votre voyage ?....</textarea>              			
				<div id="msg_comment" class="msg_step2_error"></div>
                <div class="step-5-row">
					<label>
						<div id="uniform-category" class="chaeckbox_mn_align">
							<span><input type="checkbox" id="accept" name="accept"></span>
						</div>
						J'accepte de recevoir des offres ou articles ou articles in&eacute;ressants par mail
					</label>
                    <div id="msg_accept" class="msg_step2_error"></div>
                </div>
				
			</div>
		</div>
</form> 


