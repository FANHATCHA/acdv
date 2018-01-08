<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<?php echo $left_nav;?>
	<!-- END SIDEBAR -->
	
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					<?php echo $this->lang->line('DASHBOARD_MENU');?>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo $this->config->site_url();?>/admin/dashboard">
								<?php echo $this->lang->line('HOME');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>/admin/dashboard">
								<?php echo $this->lang->line('DASHBOARD_MENU');?>
							</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
				
				<div class="col-md-12 col-sm-12">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<?php echo $this->lang->line('DASHBOARD_RESIENT_TRIVING');?>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
									<?php 
									
									if(isset($recentproduct) && !empty($recentproduct)){ 
										foreach($recentproduct as $recentpro){?>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-check"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 <a href="product/edit?id=<?php echo $recentpro->id; ?>"><?php echo $recentpro->product_name;?></a>
														</div>
													</div>
												</div>
											</div>
										</li>
									<?php 
									}
									} ?>	
								</ul>
							</div>
							<div class="scroller-footer">
								<div class="pull-right">
									<a href="product">
										 <?php echo $this->lang->line('SEE_ALL_TRAVEL');?> <i class="m-icon-swapright m-icon-gray"></i>
									</a>
									 &nbsp;
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	<!-- END CONTENT -->
	</div>
</div>	
<!-- END CONTAINER -->
