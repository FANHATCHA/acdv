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
							<a href="<?php echo $this->config->site_url();?>admin/product_category">
								<?php echo $this->lang->line('CONTENT');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/product">
								<?php echo $this->lang->line('PRO_TITLE1');?>
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
					$success 		= $this->session->userdata('success');
					$updatescc 		= $this->session->userdata('updatescc');
					$error 			= $this->session->userdata('error');
					$succ_delete 	= $this->session->flashdata('succ_delete');
					$succ_update 	= $this->session->flashdata('succ_update');
					$succ_active 	= $this->session->flashdata('succ_active');
					$succ_inactive  = $this->session->flashdata('succ_inactive');
					if(isset($success) && !empty($success)){ ?>
						<div class="alert alert-success">
							<button class="close" data-dismiss="alert">×</button>
							<strong><?php echo $this->lang->line('REC_INSERT_SUCC');$this->session->unset_userdata('success');?></strong>
						</div>
					<?php }
					if(isset($updatescc) && !empty($updatescc)){ ?>
						<div class="alert alert-success">
							<button class="close" data-dismiss="alert">×</button>
							<strong><?php echo $this->lang->line('REC_UPDATE_SUCC');$this->session->unset_userdata('updatescc');?></strong>
						</div>
					<?php }
					
					 if(isset($error) && !empty($error)){ ?>
						<div class="alert alert-success">
							<button class="close" data-dismiss="alert">×</button>
							<strong><?php echo $this->session->userdata('error_msg');?></strong>
						</div>
					<?php
						$this->session->unset_userdata('error');
						$this->session->unset_userdata('error_msg'); 
						}
					 if(isset($succ_delete) && !empty($succ_delete)){ ?>
						<div class="alert alert-success">
							<button class="close" data-dismiss="alert">×</button>
							<strong><?php echo $this->lang->line('REC_DELETE_SUCC');$this->session->unset_userdata('succ_delete');?></strong>
						</div>
					 <?php }
					 if(isset($succ_update) && !empty($succ_update)){ ?>
					<div class="alert alert-success">
						<button class="close" data-dismiss="alert">×</button>
						<strong><?php echo $this->lang->line('STATUS_UPDATE_SUCC');$this->session->unset_userdata('succ_update');?></strong>
					</div>
				 <?php }
				 if(isset($succ_active) && !empty($succ_active)){ ?>
					<div class="alert alert-success">
						<button class="close" data-dismiss="alert">×</button>
						<strong><?php echo $this->lang->line('REC_ACTIVE_SUCC');$this->session->unset_userdata('succ_active');?></strong>
					</div>
				 <?php }
				 if(isset($succ_inactive) && !empty($succ_inactive)){ ?>
					<div class="alert alert-success">
						<button class="close" data-dismiss="alert">×</button>
						<strong><?php echo $this->lang->line('REC_INACTIVE_SUCC');$this->session->unset_userdata('succ_inactive');?></strong>
					</div>
				 <?php }?> 
				
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<?php echo $page_head; ?>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="btn-group">
									<button id="sample_editable_1_new" class="btn green" onclick="window.location='<?php echo $this->config->site_url();?>admin/countdown/add'" >
										<?php echo $this->lang->line('ADD_NEW');?> <i class="fa fa-plus"></i>
									</button>
								</div>
                                <div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('ACTIONS');?> <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a onClick="return confirm_multiple('countdown');">
												 <?php echo $this->lang->line('DELETE_ALL');?>
											</a>
										</li>
										<li>
											<a onClick="return confirm_active('countdown');">
												 <?php echo $this->lang->line('ACTIVE_ALL');?>
											</a>
										</li>
										<li>
											<a onClick="return confirm_inactive('countdown');">
												 <?php echo $this->lang->line('INACTIVEE_ALL');?>
											</a>
										</li>
									</ul>
								</div>
							</div>
                            <form action="" method="post" name="actionfrm">
							<table class="table table-striped table-bordered table-hover" id="sample_2">
								<thead>
									<tr>
										<th class="table-checkbox" width="5%">
											<input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes"/>
										</th>
										<th width="20%">
											 <?php echo $this->lang->line('COUNTDOWNLOAD_TITLE'); ?>
										</th>
										<th width="45%">
											 <?php echo $this->lang->line('PRODUCT_NAME'); ?>
										</th>
										<th width="15%">
											 <?php echo $this->lang->line('STATUS'); ?>
										</th width="15%">
										<th>
											 <?php echo $this->lang->line('ACTIONS'); ?>
										</th>
									</tr>
								</thead>
								<tbody>
                                	<?php 
									
									foreach($tagsdata as $cdata){?>
									<tr class="odd gradeX">
										<td>
											<input type="checkbox" class="checkboxes" id="delete_rec[]" name="delete_rec[]" value="<?php echo $cdata['id']; ?>"/>
										</td>
										
										<td>
											<?php echo $cdata['title']; ?>
										</td>
										<td>
											<?php
												$commod = new Countdownmodel();
												$productname = $commod->getproidtoproname($cdata['product_id']);
												echo $productname;
											?>
										</td>
										
										<td>
											 <a onclick="return confirm('<?php echo $this->lang->line('STATUS_COMFIRM'); ?>');"style="text-decoration: none;" href="<?php echo $this->config->site_url();?>admin/countdown/update_status?id=<?php echo $cdata['id'];?>">
												<span style="font-size: 13px;" class="label label-sm label-<?php if($cdata['status'] == 'active'){?>success<?php }else{ ?>danger<?php } ?>"><?php echo ucfirst($cdata['status']); ?></span>
											</a>
										</td>
										<td class="center">
											 <a href="<?php echo $this->config->site_url();?>admin/countdown/edit?id=<?php echo $cdata['id'];?>" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i> Edit</a>
											 <a onclick="return confirm('<?php echo $this->lang->line('DELETE_COMFIRM'); ?>');" href="<?php echo $this->config->site_url();?>admin/countdown/delete?id=<?php echo $cdata['id'];?>" class="btn default btn-xs green-stripe"><i class="fa fa-trash-o"></i> Delete</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
                            </form>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
	</div>
</div>

