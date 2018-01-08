<div class="footer">
	<div class="footer-inner">
		<?php echo date('Y'); ?> &copy; Au Coeur Du Voyage
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
<script src="<?php echo $this->config->base_url();?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script><script src="<?php echo $this->config->base_url();?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="<?php echo $this->config->base_url()?>assets/plugins/ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="<?php echo $this->config->base_url()?>assets/plugins/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url()?>assets/plugins/tinymce/tinymce.min.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/plugins/jstree/dist/jstree.min.js"></script>

<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script src="<?php echo $this->config->base_url();?>assets/plugins/jquery.colorbox.js"></script>
<link rel="stylesheet" href="<?php echo $this->config->base_url();?>assets/plugins/colorbox.css" />  

<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>/assets/plugins/validation/additional-methods.min.js"></script>

<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/ui-tree.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/core/app.js"></script>

<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/table-managed.js"></script>
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
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/blogcategory.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/blogarticle.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/components-pickers.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/countdown.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/productinfo.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/productinfocat.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/banner.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/medialibrary.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/import.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/cmsblock.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/clientreview.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/scripts/custom/userdetails.js"></script>
<script>

jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
   ComponentsPickers.init();
   MedialibraryValidation.init();
   ImportValidation.init();
   ProductValidation.init();
   ProductinfoValidation.init();
   BannerValidation.init();
   BlogcatValidation.init();
   BlogValidation.init();
   UserdetailsValidation.init();
   ClientreviewValidation.init();
   ProductinfocatValidation.init();
   SocialValidation.init();
   SettingValidation.init();
   MyprofileValidation.init();
   CountdownValidation.init();
   CmsValidation.init();
   CmsblockValidation.init();
   RedirecturlValidation.init();
   MenuValidation.init();
   TagsValidation.init();
   ProductcatValidation.init(); 
   
   
   UITree.init();
   TableManaged.init();
  UINestable.init();
   //UIExtendedModals.init();
});

function removeitem(id)
{
	var answer = confirm("Are you sure you want to delete this entire?");
	if (answer){
		$('li[data-id='+id+']').remove();
		UINestable.init();
	
	  if (window.XMLHttpRequest)
	  {
	  xmlhttp=new XMLHttpRequest();
	  }
	  else
	  {
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		  {
			//alert(xmlhttp.responseText);
		  }
	  }
	  var url="<?php echo $this->config->site_url();?>admin/menulink/ajaxdelete";
	  url=url+"?id="+id;
	  xmlhttp.open("GET",url,true);
	  xmlhttp.send();
	  return false;
	}
	
}
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
function ShowPromoting(value)
{
	if (value == 'Y')
	{		
		document.getElementById('promoting').style.display='';
	}else
	{
		document.getElementById('promoting').style.display='none';
	}
}


function shocanonial_url(value)
{
	if (value == 'canonical')
	{		
					
		document.getElementById('canonial_urls').style.display='';
		
	}else
	{
		document.getElementById('canonial_urls').style.display='none';
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
			document.actionfrm.action = '<?php echo $this->config->site_url();?>admin/'+module+'/delete';
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
			
			document.actionfrm.action = '<?php echo $this->config->site_url();?>admin/'+module+'/update_status_activeall';
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
			
			document.actionfrm.action = '<?php echo $this->config->site_url();?>admin/'+module+'/update_status_inactiveall';
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
