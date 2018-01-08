<div class="clearfix">
</div>
<div class="page-container">
  <?php echo $left_nav;?>
	<div class="page-content-wrapper">
		<div class="page-content">
			
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					<?php echo $this->lang->line('MEDIA_LIBRAY');?> 
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
							<a href="<?php echo $this->config->site_url();?>admin/medialibrary">
								<?php echo $this->lang->line('MEDIA_LIBRAY');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
								<?php echo $this->lang->line('MANAGE_MEDIA_LIBRAY');?>
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
				$ids			 = $this->session->userdata('succe');
				$updatescc 		= $this->session->userdata('updatescc');
				$succ_delete    = $this->session->flashdata('succ_delete');
				$succ_update 	= $this->session->flashdata('succ_update');
				$succ_active 	= $this->session->flashdata('succ_active');
				$succ_inactive  = $this->session->flashdata('succ_inactive');
				
				if(isset($ids) && !empty($ids)){ ?>
					<div class="alert alert-success">
						<button class="close" data-dismiss="alert">×</button>
						<strong><?php echo $this->lang->line('REC_INSERT_SUCC');$this->session->unset_userdata('succe');?></strong>
					</div>
				<?php }
				if(isset($updatescc) && !empty($updatescc)){ ?>
					<div class="alert alert-success">
						<button class="close" data-dismiss="alert">×</button>
						<strong><?php echo $this->lang->line('REC_UPDATE_SUCC');$this->session->unset_userdata('updatescc');?></strong>
					</div>
				<?php }
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
			
				<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
							<?php echo $this->lang->line('MANAGE_MEDIA_LIBRAY');?>
							</div>
						</div>
						<div class="portlet-body">
							
							<div class="table-toolbar">
								<?php /*<div class="btn-group">
									<button id="sample_editable_1_new" class="btn green" onclick="window.location='<?php echo $this->config->site_url();?>/admin/banner/add'" >
										<?php echo $this->lang->line('ADD_NEW');?> <i class="fa fa-plus"></i>
									</button>
								</div> */?>
								<div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('ACTIONS');?> <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a onClick="return confirm_multiple('medialibrary');">
												 <?php echo $this->lang->line('DELETE_ALL');?>
											</a>
										</li>
									</ul>
								</div>
							</div>

							<form action="<?php echo $this->config->site_url();?>admin/medialibrary/delete" method="post" name="actionfrm" id="actionfrm">
								<table class="table table-striped table-bordered table-hover"  id="sample_2">
									<thead>
										<tr>
											<th class="table-checkbox" width="5%">
											<input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
											</th>
											<th class="head1" width="55%"><?php echo $this->lang->line('NAME');?></th>
											<th class="head1" width="20%"><?php echo $this->lang->line('ACTIONS');?></th>
										</tr>
									</thead>
									<tbody>
										<?php 	foreach($bannerdata_list as $result){ ?>
											<tr class="odd gradeX">
												
												<td>
													<input type="checkbox" class="checkboxes" id="delete_rec[]" name="delete_rec[]" value="<?php echo $result['id']?>" />
												</td>
												<td><?php echo $result["title"]; ?></td>
												<td>
													<a href="<?php  echo $this->config->site_url();?>admin/medialibrary/edit?id=<?php echo $result["id"]; ?>" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i> Edit</a>
													<a onclick="return confirm('<?php echo $this->lang->line('DELETE_COMFIRM'); ?>');"  href="<?php  echo $this->config->site_url();?>admin/medialibrary/delete?id=<?php echo $result["id"]; ?>" class="btn default btn-xs green-stripe"><i class="fa fa-trash-o"></i> Delete</a>
												</td>
											</tr>
										<?php  } ?>                   
									</tbody>
								</table>
							</form>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
