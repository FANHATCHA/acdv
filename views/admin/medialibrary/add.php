<div class="clearfix">
</div>
<div class="page-container">
   <?php echo $left_nav;?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
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
								<?php echo $this->lang->line('ADD_MEDIA_LIBRAY');?>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>	
			<div class="tab-pane" id="tab_7">
				 <div class="portlet box green ">
					  <div class="portlet-title">
							<div class="caption">
								<?php echo $page_view; ?>
							</div>
					  </div>
					  <div class="portlet-body form">
							<div class="row">
								<div id="my-dropzone" class="dropzone dz-clickable">
									<div class="dz-default dz-message">
										<div id="fileuploader">Upload</div>
									</div>
								</div>
							</div>
					  </div>
			    </div>
           </div>
    </div>
</div>
<?php /*<script language="javascript" type="text/javascript">
jQuery(document).ready(function() { 
	var btnUpload=$('#banner_img');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
	action: '<?php echo $this->config->site_url();?>/admin/medialibrary/ajaxupload/',
	name: 'uploadfile[]',
	onSubmit: function(file, ext)
	{
	if (! (ext && /^(jpg|png|jpeg|gif|txt|doc|xls|jpeg|odp|pdf)$/.test(ext))){ 
    status.text('Only JPG,PNG,JPEG,GIF,DOC,XLS,TXT,ODP,PDF files are allowed');
	return false;
	}status.html('<img src="<?php echo $this->config->base_url();?>/assets/img/loader.gif">');
	},
	
	onComplete: function(file, response)
	{
	alert(file);
		status.html('');
		status.text('');
		var responseObj = jQuery.parseJSON(response);
		
			$.each(file,function(index, value ){
				var  imagename = "'"+value.file_name+"'";
				$('<span></span>').appendTo('#files').html('<div id="'+value.file_name+'" style="display:block"><img src="<?php echo $this->config->base_url().'application/uploads/medialibrary/original/'; ?>'+value.file_name+'" alt="" width="100" height="100" style="margin:5px;" /><a onclick="removeimage('+imagename+')" ><span><i class="fa fa-trash-o"></i></span></a><input type="hidden" name="banner_images[]" value="'+value.file_name+'" />').addClass('success');
			});
			
		
	}});
});
function removeimage(str)
{
  var status=$('#status');
  status.html('<img src="<?php echo $this->config->base_url();?>/assets/img/loader.gif">');
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
	  status.html('');
	  document.getElementById(str).style.display="none";
	  var elem = document.getElementById(str);
	  elem.parentNode.removeChild(elem);
	  //document.getElementById('steps1').innerHTML = xmlhttp.responseText;
	  }
  }
  var url="<?php echo $this->config->site_url();?>/admin/medialibrary/ajaxdelete";
  url=url+"?imgname="+str;
  
  xmlhttp.open("GET",url,true);
  xmlhttp.send();
  return false;
}
</script> */?>

<link href="<?php echo $this->config->base_url();?>assets/attach/uploadfile.css" rel="stylesheet">
<script src="<?php echo $this->config->base_url();?>assets/attach/jquery.min.js"></script>
<script src="<?php echo $this->config->base_url();?>assets/attach/jquery.uploadfile.min.js"></script>	
<script>
var jqr = jQuery.noConflict();
jqr(document).ready(function()
{
	jqr("#fileuploader").uploadFile({
		url:"<?php echo $this->config->site_url();?>admin/medialibrary/ajaxupload/",
		allowedTypes:"jpg,jpeg,png,gif,doc,pdf,odt,odc,txt,pdf,xls,odp",
		fileName:"myfile",
		multiple: true,
		onSuccess:function(d,dt,f){
			//alert(d);
			//alert(dt);
			//alert(f);
			//jqr(".submit_button").show();
			jqr("#upload_files").append("<input type=\'hidden\' name=\'files_data[]\' value="+d+" />");
		},
	});
	
});
</script> 