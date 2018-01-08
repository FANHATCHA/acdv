<div class="clearfix">
</div>
<?php
function date_clientreview_french2 ($date)
{
	$month_name=array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août",
	"Septembre","Octobre","Novembre","Décembre");

	$split = preg_split('/-/', $date);
	$year = $split[0];
	$month = round($split[1]);
	$day = round($split[2]);

	$week_day = date("w", mktime(12, 0, 0, $month, $day, $year));
	return $date_fr = $day.' '.$month_name[$month] .' '. $year;
}
?>
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
					$insert_record = $this->session->userdata('succe');
					$error_image   = $this->session->userdata('error_image');
					$succ_delete   = $this->session->flashdata('succ_delete');
					$update_record = $this->session->userdata('updatescc');
					$succ_update = $this->session->flashdata('succ_update');
					$succ_active = $this->session->flashdata('succ_active');
					$succ_inactive = $this->session->flashdata('succ_inactive');
					
					if(isset($insert_record) && !empty($insert_record)){ ?>
						<div class="alert alert-success">
							<button class="close" data-dismiss="alert">×</button>
							<strong><?php echo $this->lang->line('REC_INSERT_SUCC');$this->session->unset_userdata('succe');?></strong>
						</div>
					<?php } if(isset($error_image) && !empty($error_image)) {?>
					  <div class="alert alert-danger">
						  <button class="close" data-close="alert"></button>
						 <?php print_r($error_image);
						 $this->session->unset_userdata('error_image');
						 ?>
					 </div>
					 <?php }
					 if(isset($succ_delete) && !empty($succ_delete)){ ?>
						<div class="alert alert-success">
							<button class="close" data-dismiss="alert">×</button>
							<strong><?php echo $this->lang->line('REC_DELETE_SUCC');$this->session->unset_userdata('succ_delete');?></strong>
						</div>
					 <?php } 
					 if(isset($update_record) && !empty($update_record)){ ?>
						<div class="alert alert-success">
							<button class="close" data-dismiss="alert">×</button>
							<strong><?php echo $this->lang->line('REC_UPDATE_SUCC');$this->session->unset_userdata('updatescc');?></strong>
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
									<button id="sample_editable_1_new" class="btn green" onclick="window.location='<?php echo $this->config->site_url();?>admin/clientreview/add'" >
										<?php echo $this->lang->line('ADD_NEW');?> <i class="fa fa-plus"></i>
									</button>
								</div>
								<div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('ACTIONS');?> <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a onClick="return confirm_multiple('clientreview');">
												 <?php echo $this->lang->line('DELETE_ALL');?>
											</a>
										</li>
										<li>
											<a onClick="return confirm_active('clientreview');">
												 <?php echo $this->lang->line('ACTIVE_ALL');?>
											</a>
										</li>
										<li>
											<a onClick="return confirm_inactive('clientreview');">
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
										<th class="table-checkbox" width="10%">
											<input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes"/>
										</th>
										<th width="30%">
											<?php echo $this->lang->line('TITLE'); ?>
										</th>
										<th width="20%">
											<?php echo $this->lang->line('CATEGORY_CLIENT'); ?>
										</th>
										<?php /*<th width="5%" align="center">
											<?php echo $this->lang->line('SHOW_HOME_CLIENT'); ?>
										</th>*/?>
										<th width="15%">
											<?php echo $this->lang->line('REVIEW_DATE'); ?>
										</th>
										<th width="10%">
											 <?php echo $this->lang->line('STATUS'); ?>
										</th>
										<th width="15%">
											 <?php echo $this->lang->line('ACTIONS'); ?>
										</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								foreach($clientreviewdata as $pdata)
								{?>
									<tr class="odd gradeX">
										<td>
											<input type="checkbox" class="checkboxes" id="delete_rec[]" name="delete_rec[]" value="<?php echo $pdata['id']; ?>"/>
										</td>
										<td>
											<?php echo $pdata['name']; ?>
										</td>
										<td>
											<?php 
											$categorymod = new Clientreviewmodel();
											$destinationid = explode(',',$pdata['destination_id']);
											$destinatitotal = count($destinationid);
											if(isset($destinationid) && !empty($destinationid))
											{	$i = 0;
												foreach($destinationid as $destinationids)
												{
													if($i == $destinatitotal - 1 )
													{
														$comma = '';
													}
													else
													{
														$comma = ' , ';
													}
													$categorytitle = $categorymod->getcategoryname($destinationids);
													echo  $categorytitle.$comma;
													$i++;
												}
											
											}
											else
											{
												echo '-';
											}	
											?>
										</td>
										<?php /*<td align="center">
											<?php if(isset($pdata['show_home']) && !empty($pdata['show_home']) && $pdata['show_home'] == 'no'){?>
												<i class="fa fa-star-o"></i>
											<?php }else if(isset($pdata['show_home']) && !empty($pdata['show_home']) && $pdata['show_home'] == 'yes'){ ?>
												<i class="fa fa-star"></i>
											<?php } ?>
										</td>*/ ?>
										<td>
											<?php
												$reviewdate_fromat =  date('Y-m-d',strtotime($pdata['review_date'])); 
												echo date_clientreview_french2($reviewdate_fromat);
											?>
										</td>
										<td>
											 <a onclick="return confirm('<?php echo $this->lang->line('STATUS_COMFIRM'); ?>');"style="text-decoration: none;" href="<?php echo $this->config->site_url();?>admin/clientreview/update_status?id=<?php echo $pdata['id'];?>">
												<span style="font-size: 13px;" class="label label-sm label-<?php if($pdata['status'] == 'active'){?>success<?php }else{ ?>danger<?php } ?>"><?php echo ucfirst($pdata['status']); ?></span>
											</a>
										</td>
										<td>
											 <a href="<?php echo $this->config->site_url();?>admin/clientreview/edit?id=<?php echo $pdata['id'];?>" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i> Edit</a>
											 <a  onclick="return confirm('<?php echo $this->lang->line('DELETE_COMFIRM'); ?>');" href="<?php echo $this->config->site_url();?>admin/clientreview/delete?id=<?php echo $pdata['id'];?>" class="btn default btn-xs green-stripe"><i class="fa fa-trash-o"></i> Delete</a>
										</td>
									</tr>
									<?php 
									}
								?>
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


