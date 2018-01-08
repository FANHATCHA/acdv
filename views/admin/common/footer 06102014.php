<div class="footer">
	<div class="footer-inner">
		 2014 &copy; Au Coeur Du Voyage
	</div>
	<div class="footer-tools">
		<span class="go-top">
			<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
   <script src="assets/plugins/respond.min.js"></script>
   <script src="assets/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo $this->config->base_url();?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url();?>assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url();?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url();?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url();?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url();?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="<?php echo $this->config->base_url()?>assets/plugins/ckeditor/ckeditor.js"></script> 
<script src="<?php echo $this->config->base_url();?>assets/plugins/jstree/dist/jstree.min.js"></script>

<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script src="<?php echo $this->config->base_url();?>assets/plugins/jquery.colorbox.js"></script>
<link rel="stylesheet" href="<?php echo $this->config->base_url();?>assets/plugins/colorbox.css" />  

<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>

<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/ui-tree.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/core/app.js"></script>






<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>










<script src="<?php echo $this->config->base_url();?>assets/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url();?>assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/index.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/tasks.js" type="text/javascript"></script>



<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/table-managed.js"></script>
<!--<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/ui-extended-modals.js"></script>-->
<script src="<?php echo $this->config->base_url();?>assets/plugins/jquery-nestable/jquery.nestable.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/ui-nestable.js"></script>

<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/cmspage.js"></script>

<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/setting.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/socialmedia.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/tags.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/productcategory.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/product.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/redirecturl.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/menu.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/myprofile.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/components-pickers.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/countdown.js"></script>

<script>

jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
   ComponentsPickers.init();
   ProductValidation.init();
   SocialValidation.init();
   SettingValidation.init();
   MyprofileValidation.init();
   CountdownValidation.init();
   CmsValidation.init();
   RedirecturlValidation.init();
   MenuValidation.init();
   TagsValidation.init();
   ProductcatValidation.init(); 
   //UINestable.init();
   
   UITree.init();
   TableManaged.init();
   //UIExtendedModals.init();
});

function ShowSeo(value)
{
	
if (value == 'Y')
{		
				
	document.getElementById('seo').style.display='';
	
}else
{
	document.getElementById('seo').style.display='none';
}
}


function confirm_multiple(module)
{
	var	checkedElements=0;
	var form = document.actionfrm;
	for (var i=0;i<form.elements.length;i++)
	{
		var e = form.elements[i];
		if ((e.type=='checkbox') && (!e.disabled) && e.checked) {
			checkedElements = checkedElements+1;
		}
	}
	var val =checkedElements;
	if(document.getElementById('delete_rec')){
		document.getElementById('delete_rec').value=eval(checkedElements);
	}

	if(val<=0){
		alert("<?php echo $this->lang->line('DELETE_MULTIPLE_SELECT'); ?>");
		return false;
	}else{
		
		if(window.confirm("<?php echo $this->lang->line('DELETE_MULTIPLE_COMFIRM'); ?>"))
		{
			document.actionfrm.action = '<?php echo $this->config->site_url();?>/admin/'+module+'/delete';
			document.actionfrm.submit();
		}
		else
		{
			return false;
		}
	}
	return true;
}
function confirm_active(module)
{
	var	checkedElements=0;
	var form = document.actionfrm;
	for (var i=0;i<form.elements.length;i++)
	{
		var e = form.elements[i];
		if ((e.type=='checkbox') && (!e.disabled) && e.checked) {
			checkedElements = checkedElements+1;
		}
	}
	var val =checkedElements;
	if(document.getElementById('delete_rec')){
		document.getElementById('delete_rec').value=eval(checkedElements);
	}

	if(val<=0){
		alert("<?php echo $this->lang->line('DELETE_MULTIPLE_ACTIVE'); ?>");
		return false;
	}else{
		
		if(window.confirm("<?php echo $this->lang->line('STATUS_COMFIRM'); ?>"))
		{
			
			document.actionfrm.action = '<?php echo $this->config->site_url();?>/admin/'+module+'/update_status_activeall';
			document.actionfrm.submit();
		}
		else
		{
			return false;
		}
	}
	return true;
}

function confirm_inactive(module)
{
	var	checkedElements=0;
	var form = document.actionfrm;
	for (var i=0;i<form.elements.length;i++)
	{
		var e = form.elements[i];
		if ((e.type=='checkbox') && (!e.disabled) && e.checked) {
			checkedElements = checkedElements+1;
		}
	}
	var val =checkedElements;
	if(document.getElementById('delete_rec')){
		document.getElementById('delete_rec').value=eval(checkedElements);
	}

	if(val<=0){
		alert("<?php echo $this->lang->line('DELETE_MULTIPLE_INACTIVE'); ?>");
		return false;
	}else{
		
		if(window.confirm("<?php echo $this->lang->line('STATUS_COMFIRM'); ?>"))
		{
			
			document.actionfrm.action = '<?php echo $this->config->site_url();?>/admin/'+module+'/update_status_inactiveall';
			document.actionfrm.submit();
		}
		else
		{
			return false;
		}
	}
	return true;
}

/******************* scripts for menu links tree ************/

jQuery("#tree_menu_links").jstree({
	"core" : {
		"themes" : {
			"responsive": false
		}, 
		// so that create works
		"check_callback" : true,
		'data' : {
			'url' : function (node) {
			  return '<?php echo $this->config->site_url();?>admin/menulink/getLinksajax/?menu=<?php echo $this->input->get("menu"); ?>';
			},
			'data' : function (node) {
			  return { 'parent' : node.id };
			}
		}
	},
	"types" : {
		"default" : {
			"icon" : "fa fa-folder icon-warning icon-lg"
		},
		"file" : {
			"icon" : "fa fa-file icon-warning icon-lg"
		}
	},
	"state" : { "key" : "demo3" },
	"plugins" : [ "dnd", "state", "types" ]
});

/********************end scripts ****************************/

</script>

</body>
<!-- END BODY -->
</html>
