<?php 

?>
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
					$succ_back		= $this->session->userdata('succbackup');
					$deletebackup	= $this->session->userdata('deletebackup');
					
					if(isset($succ_back) && !empty($succ_back)){ ?>
						<div class="alert alert-success">
							<button class="close" data-dismiss="alert">×</button>
							<strong><?php echo $succ_back.' '.$this->lang->line('DB_BACKUP_SUCC');$this->session->unset_userdata('succbackup');?></strong>
						</div>
					<?php } 
					if(isset($deletebackup) && !empty($deletebackup)){ ?>
					<div class="alert alert-success">
						<button class="close" data-dismiss="alert">×</button>
						<strong><?php echo $this->lang->line('DB_DELETE_SUCC');$this->session->unset_userdata('deletebackup');?></strong>
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
							<div class="table-toolbar">
                            	<div class="btn-group">
									<button id="sample_editable_1_new" class="btn green" onclick="window.location='<?php echo $this->config->site_url();?>admin/backup/export_backup'" >
										<?php echo $this->lang->line('GENERATE_DATABASE');?> 
									</button>
								</div>
							</div>
							<form action="" method="post" name="actionfrm">
							<table class="table table-striped table-bordered table-hover" id="sample_2">
								<thead>
									<tr>
										<th width="50%">
											 <?php echo $this->lang->line('DATABASE_NAME'); ?>
										</th>
										<th width="30%">
											 <?php echo $this->lang->line('DATABASE_DOWNLOAD'); ?>
										</th>
										<th width="25%">
											 <?php echo $this->lang->line('ACTIONS'); ?>
										</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$temp = 1;
								if($backupdata != "")
								{
									foreach($backupdata as $key=>$val){?>
										<tr class="odd gradeX">
											<td>
												<?php echo $val; ?>
											</td>
											<td>
												<a href="<?php echo $this->config->base_url();?>application/database_backup/<?php echo $val; ?>" download="<?php echo $val; ?>"><?php echo $val; ?></a>
											</td>
											<td>
												 <a  onclick="return confirm('<?php echo $this->lang->line('DELETE_COMFIRM'); ?>');" href="<?php echo $this->config->site_url();?>admin/backup/delete_backup?db_file=<?php echo $val;?>" class="btn default btn-xs green-stripe"><i class="fa fa-trash-o"></i> Delete</a>
											</td>
										</tr>
									<?php 
									$temp++;}
								} ?>
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