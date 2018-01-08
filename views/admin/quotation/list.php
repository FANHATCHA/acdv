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
						<?php }  ?>
						 
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
									
								</div>
								<div class="btn-group pull-right" style="display:none">
									<button class="btn dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('ACTIONS');?> <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a onClick="return confirm_multiple('quotation');">
												 <?php echo $this->lang->line('DELETE_ALL');?>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<table class="table table-striped table-bordered table-hover">
								<tbody>
								
									<tr class="filter" role="row">
										<td width="80%">
											<div class="form-group">
												<input type="text" value="<?php if(isset($search_val) && !empty($search_val)){ echo $search_val;}?>" placeholder="Demande De Devis" name="search" class="form-control" id="search">
											</div>
										</td>
										<td width="20%">
											<div class="form-group">
												<input type="submit" value="Search" id="search_products" name="search_products" class="btn green btn-large" onclick="search_products_call();">
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							<form action="" method="post" name="actionfrm">
								
								<div class="row">
									<div class="col-md-5 col-sm-12">
										<div id="sample_23_info" class="dataTables_info">Showing <?php echo $p_start;?> - <?php echo $p_end;?> of <b><?php echo $p_total;?></b> entries</div>
									</div>
									<br><br>
									<div class="dataTables_paginate paging_bootstrap">
										<ul class="pagination" style="visibility: visible;">
											<?php foreach ($links as $link) {
											echo $link;
											} ?>
										</ul>
									</div>
							   </div>	
								<table class="table table-striped table-bordered table-hover" id="sample_23">
									<thead>
										<tr>
											<th class="table-checkbox" width="5%" style="display:none">
												<input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes"/>
											</th>
											<th width="7%">
												 <?php echo $this->lang->line('DATE'); ?>
											</th>
											<th width="4%">
												 Heure
											</th>
											
											<th width="10%">
												 Produit/Page
											</th>
											<th width="10%">
												 <?php echo $this->lang->line('FIRSTNAME'); ?>
											</th>
											<th width="10%">
												 <?php echo $this->lang->line('LASTNAME'); ?>
											</th>
											<th width="10%">
												 <?php echo $this->lang->line('EMAIL'); ?>
											</th>
											<th width="10%">
												 <?php echo $this->lang->line('PHONENO'); ?>
											</th>
											<th width="5%">
												 Opt-in ?
											</th>
											<th width="10%">
												 <?php echo $this->lang->line('ACTIONS'); ?>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										foreach($quotationdata as $data){?>
										<tr class="odd gradeX">
											<td style="display:none">
												<input type="checkbox" class="checkboxes" id="delete_rec[]" name="delete_rec[]" value="<?php echo $data['quotation_id']; ?>"/>
											</td>
											<td>
												<?php echo date('d F Y',strtotime($data['created_date'])); ?>
											</td>
											<td>
												<?php echo date('H:i',strtotime($data['created_date'])); ?>
											</td>
											<td>
												<?php if (empty($data['destination_id'])) { echo $data['product_id']; } else {echo $data['destination_id'];} ; ?>
											</td>
											<td>
												<?php echo $data['firstname']; ?>
											</td>
											<td>
												<?php echo $data['lastname']; ?>
											</td>
											<td>
												<a class="btn default btn-xs black" href="mailto:<?php echo $data['email'];?>"><?php echo $data['email']; ?></a>
											</td>
											<td>
												<?php echo $data['telephone']; ?>
											</td>
											<td>
												<?php echo $data['accepte']; ?>
											</td>
											<td>
												<a  onclick="return confirm('<?php echo $this->lang->line('DELETE_COMFIRM'); ?>');" href="<?php echo $this->config->site_url();?>admin/quotation/delete?id=<?php echo $data['quotation_id'];?>" class="btn default btn-xs green-stripe"><i class="fa fa-trash-o"></i> Delete</a>
												<a  href="<?php echo $this->config->site_url();?>admin/quotation/view_from?id=<?php echo $data['quotation_id'];?>" class="btn default btn-xs green-stripe"><i class="fa fa-edit"></i> View</a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<div class="row">
									<div class="col-md-5 col-sm-12">
										<div id="sample_23_info" class="dataTables_info">Showing <?php echo $p_start;?> - <?php echo $p_end;?> of <b><?php echo $p_total;?></b> entries</div>
									</div>
									<div class="dataTables_paginate paging_bootstrap">
										<ul class="pagination" style="visibility: visible;">
											<?php foreach ($links as $link) {
											echo $link;
											} ?>
										</ul>
									</div>
							   </div>	
							</form>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function search_products_call()
{ 
	var search_value = document.getElementById('search').value;
	search_value = search_value.replace(" ","%20"); 
	window.location.href = '<?php echo $this->config->site_url();?>admin/quotation?search='+search_value;
	
}
</script>