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
					<?php echo $page_head;?>
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
						</li><li>
							<a href="<?php echo $this->config->site_url();?>admin/redirect">
								<?php echo $this->lang->line('URL_MENU');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<?php echo $this->lang->line('IMPORT_TITLE_URl');?>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<div class="portlet box green">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i><?php echo $page_head;?>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<form action="<?php echo base_url() ?>admin/import/importcsv" id="importfrm"  name="importfrm" class="form-horizontal form-bordered form-label-stripped" method="post" enctype= "multipart/form-data">
						<div class="form-body">
							<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button>
								<?php echo $this->lang->line('FORM_ERROR');?>
							</div>
							
							<?php $import_valid_file  = $this->session->flashdata('import_valid_file');
							if(isset($import_valid_file) && !empty($import_valid_file)){ ?>
								<div class="alert alert-danger">
									<button class="close" data-dismiss="alert">×</button>
									<strong><?php echo $this->lang->line('UPLOAD_ONLY_CSV_FILE');?></strong>
								</div>
							<?php } ?>	
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo $this->lang->line('IMPORT_FILE');?><span class="required"> *</span></label>
										<div class="col-md-9">
											 <input type="file" name="csv" id="csv">
											 <span class="help-block">
												<a href="<?php echo base_url() ?>application/uploads/csv/301url.csv"><?php echo $this->lang->line('DOWNLOAD_DEMO_CSV');?></a>
											</span>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions fluid">
							<div class="row">
								<div class="col-md-6">
									<div class="col-md-offset-3 col-md-9">
										<input type="submit" class="btn green" value="<?php echo $this->lang->line('SAVE');?>">
										<button onclick="window.location='<?php echo $this->config->site_url();?>admin/redirect'" type="button" class="btn default"><?php echo $this->lang->line('CANCEL');?></button>
									</div>
								</div>
								<div class="col-md-6">
								</div>
							</div>
						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
