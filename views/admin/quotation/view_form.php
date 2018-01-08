<div class="clearfix">
</div>
<div class="page-container">
	<?php echo $left_nav;?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					<?php echo $page_title; ?>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo $this->config->site_url();?>admin/dashboard">
								<?php echo $this->lang->line('HOME');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
							<li>
							<a href="<?php echo $this->config->site_url();?>admin/setting">
								<?php echo $this->lang->line('CONFIGRATION_MENU');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<?php echo $page_head; ?>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
				
						<?php
						$succ_delete 	= $this->session->flashdata('succ_delete');
						if(isset($succ_delete) && !empty($succ_delete)){ ?>
							<div class="alert alert-success">
								<button class="close" data-dismiss="alert">×</button>
								<strong><?php echo $this->lang->line('REC_DELETE_SUCC');$this->session->unset_userdata('succ_delete');?></strong>
							</div>
						<?php } ?>
						
						 
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<?php echo $page_head; ?>
							</div>
						</div>
						<div class="portlet-body">
							<div class="portlet-body form">
								<div class="form-horizontal">
									<div class="form-body">
										<h3 class="form-section"><?php if(isset($formdata[0]['product_id']) && !empty($formdata[0]['product_id'])){?>Voyage<?php }else if(isset($formdata[0]['destination_id']) && !empty($formdata[0]['destination_id'])){?>Destination<?php } ?></h3>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label col-md-3" style="width:12%"></label>
													<div class="col-md-10">
														<?php if(isset($formdata[0]['product_id']) && !empty($formdata[0]['product_id'])){?>
															<input type="text" readonly="readonly" class="form-control" value="<?php  echo $formdata[0]['product_id'];?>">
														<?php }else if(isset($formdata[0]['destination_id']) && !empty($formdata[0]['destination_id'])){?>	
															<input type="text" readonly="readonly" class="form-control" value="<?php  echo $formdata[0]['destination_id'];?>">
														<?php } ?>	
													</div>
												</div>
											</div>
										</div>
										<h3 class="form-section">Participants</h3>
										<!--/row-->
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label col-md-3"></label>
													<div class="col-md">
														<label class="control-label col-md-2"></label>
														<div style="font-size:20px;">Vos coordonnées :</div>
													</div>
												</div>
											</div>	
										</div>	
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3"></label>
													<div class="col-md-9">
														<label class="control-label">Nom</label>
														<input type="text" readonly="readonly" class="form-control" value="<?php  echo $formdata[0]['firstname'];?>">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="col-md-9">
														<label class="control-label">Prénom</label>
														<input type="text" readonly="readonly" class="form-control" value="<?php  echo $formdata[0]['lastname'];?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3"></label>
													<div class="col-md-9">
														<label class="control-label">Adresse email</label>
														<input type="text" readonly="readonly" class="form-control" value="<?php  echo $formdata[0]['email'];?>">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="col-md-9">
														<label class="control-label">N° de téléphone</label>
														<input type="text" readonly="readonly" class="form-control" value="<?php  echo $formdata[0]['telephone'];?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label col-md-3"></label>
													<div class="col-md">
														<label class="control-label col-md-2"></label>
														<div  style="font-size:20px">Vous voyagez...</div>
													</div>
												</div>
											</div>	
										</div>	
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label col-md-1" style="width: 12%;"></label>
													<?php if(isset($formdata[0]['single']) && !empty($formdata[0]['single']) && $formdata[0]['single'] == 'yes'){ ?>
														<div class="col-md-10">
															<div class="col-md-11" type="text" style="background-color:#eeeeee;border: 1px solid #e5e5e5;border-radius: 0;box-shadow: none;color: #333333;font-size: 14px;height: auto;padding: 10px;text-align: center;" >
																« Vous voyagez Seul <br>Seul : Oui »
															</div>
														</div>
													<?php }else if($formdata[0]['couple'] == 'no' && $formdata[0]['famille'] == 'no' && $formdata[0]['groupe'] == 'no' && $formdata[0]['single'] == 'no'){?>
														<div class="col-md-10">
															<div class="col-md-11" type="text" style="background-color:#eeeeee;border: 1px solid #e5e5e5;border-radius: 0;box-shadow: none;color: #333333;font-size: 14px;height: auto;padding: 10px;text-align: center;" >
																«  »
															</div>
														</div>		
													<?php }else if(isset($formdata[0]['couple']) && !empty($formdata[0]['couple']) && $formdata[0]['couple'] == 'yes'){?>
														<div class="col-md-10">
															<div class="col-md-11" type="text" style="background-color:#eeeeee;border: 1px solid #e5e5e5;border-radius: 0;box-shadow: none;color: #333333;font-size: 14px;height: auto;padding: 10px;text-align: center;" >
																« Vous partez En Couple <br>Voyage de Noces : Oui »
															</div>
														</div>
													<?php }else if(isset($formdata[0]['couple']) && !empty($formdata[0]['couple']) && $formdata[0]['couple'] == 'no' && $formdata[0]['famille'] != 'yes' &&  $formdata[0]['groupe'] != 'yes' && $formdata[0]['single'] != 'yes'){?>
														<div class="col-md-10">
															<div class="col-md-11" type="text" style="background-color:#eeeeee;border: 1px solid #e5e5e5;border-radius: 0;box-shadow: none;color: #333333;font-size: 14px;height: auto;padding: 10px;text-align: center;" >
																« Vous partez En Couple <br>Voyage de Noces : Non »
															</div>
														</div>
													<?php }else if(isset($formdata[0]['famille']) && !empty($formdata[0]['famille']) && $formdata[0]['famille'] == 'yes'){?>
														<div class="col-md-10">
															<div class="col-md-11" type="text" style="background-color:#eeeeee;border: 1px solid #e5e5e5;border-radius: 0;box-shadow: none;color: #333333;font-size: 14px;height: auto;padding: 10px;text-align: center;" >
																« Vous partez En Famille 
																	<br> Nombre d'adultes : <?php if(isset($formdata[0]['famille_adultes']) && !empty($formdata[0]['famille_adultes'])){echo $formdata[0]['famille_adultes'];}?> 
																	<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'enfants : <?php if(isset($formdata[0]['famille_enfants']) && !empty($formdata[0]['famille_enfants'])){echo $formdata[0]['famille_enfants'];}?>  »
															</div>
														</div>
													<?php }else if(isset($formdata[0]['groupe']) && !empty($formdata[0]['groupe']) && $formdata[0]['groupe'] == 'yes'){?>
														<div class="col-md-10">
															<div class="col-md-11" type="text" style="background-color:#eeeeee;border: 1px solid #e5e5e5;border-radius: 0;box-shadow: none;color: #333333;font-size: 14px;height: auto;padding: 10px;text-align: center;" >
																« Vous partez En Groupe 
																	<br> Nombre d'adultes : <?php if(isset($formdata[0]['groupe_adultes']) && !empty($formdata[0]['groupe_adultes'])){echo $formdata[0]['groupe_adultes'];}?> 
																	<br> &nbsp;&nbsp;Nombre d'enfants : <?php if(isset($formdata[0]['groupe_enfants']) && !empty($formdata[0]['groupe_enfants'])){echo $formdata[0]['groupe_enfants'];}?>  »
															</div>
														</div>
																								
													<?php } ?>
												</div>
											</div>
										</div>
										<h3 class="form-section">Dates</h3>
										<!--/row-->
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3"></label>
													<div class="col-md-9">
														<label class="control-label">Date de départ</label>
														<input type="text" readonly="readonly" class="form-control" value="<?php  echo date('d-m-Y',strtotime($formdata[0]['startdate']));?>">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="col-md-9">
														<label class="control-label">Date de retour</label>
														<input type="text" readonly="readonly" class="form-control" value="<?php  echo date('d-m-Y',strtotime($formdata[0]['enddate']));?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">	
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3"></label>
													<div class="col-md-9">
														<input class="group-checkable" type="checkbox" <?php if(isset($formdata[0]['date_flexibles']) && !empty($formdata[0]['date_flexibles']) && $formdata[0]['date_flexibles'] == 'yes'){?> checked="checked" <?php } ?>> 
														<label class="control-label"> Dates flexibles?</label>
													</div>
												</div>	
											</div>	
										</div>	
										
										<h3 class="form-section">Budget</h3>
										<!--/row-->
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3"></label>
													<div class="col-md-9">
														<label class="control-label">Budget</label>
														<input type="text" readonly="readonly" class="form-control" value="<?php echo number_format($formdata[0]['price'],0,',','');?> € par personne ">
													</div>
												</div>
											</div>
										</div>	
										
										<h3 class="form-section">Commentaires</h3>
										<!--/row-->
										<div class="row">
											<div class="form-group">
												<label class="control-label col-md-2" style="width:13.667%;"></label>
												<div class="col-md-10">
													<textarea readonly="readonly" class="wysihtml5 form-control" data-error-container="#editor1_error" name="editor1" rows="6"><?php echo $formdata[0]['comments'];?></textarea>
												</div>
											</div>
										</div>
										<div class="row">	
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label col-md-2" style="width: 12.5%;"></label>
													<div class="col-md-10">
														<input class="group-checkable" type="checkbox" <?php if(isset($formdata[0]['accepte']) && !empty($formdata[0]['accepte']) && $formdata[0]['accepte'] == 'yes'){?> checked="checked" <?php } ?>> 
														<label class="control-label">  J’accepte de recevoir des offres ou articles intéressants par email </label>
													</div>
												</div>	
											</div>	
										</div>	
										
										<h3 class="form-section">Extra Information</h3>
										<div class="row">	
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label col-md-3"  style="width:12%"></label>
													<div class="col-md-10">
														<label class="control-label">Page Url</label>
														<input readonly="readonly" class="form-control" type="text" value="<?php if(isset($formdata[0]['pageurl']) && !empty($formdata[0]['pageurl']) && $formdata[0]['pageurl']){ echo $formdata[0]['pageurl']; } ?>"> 
													</div>
												</div>	
											</div>	
										</div>											
										
										<div class="form-actions fluid">
											<div class="row">
												<div class="col-md-6">
													<div class="col-md-offset-3 col-md-9">
														<button type="button" class="btn default" onclick="window.location='<?php echo $this->config->site_url();?>admin/quotation'" > « Back</button>
													</div>
												</div>
												<div class="col-md-6">
												</div>
											</div>
										</div>
									</div>
									<!-- END FORM-->
								</div>	
							</div>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
	</div>
</div>