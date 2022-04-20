<script src='<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/mix/js/all.js'></script>
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/js/tinymce/jquery.tinymce.min.js"></script>	
<script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/js/tinymce/tinymce.min.js"></script>
<script src='<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/comman_js/common.js'></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>


$(document).on("click","#select_all",function(){
	check_uncheck_data();
});
function check_uncheck_data(){
  if($("#select_all").prop("checked")){
    $(".select_checkbox_value").prop("checked",true);
  }else{
    $(".select_checkbox_value").prop("checked",false);
  }
}

tinymce.init({
		selector : '.editor-tinymce',
		height: 250,
		directionality : "ltr",
		plugins : 'advlist autolink lists link charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table contextmenu paste code image codesample',
		toolbar : 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image codesample',

		images_upload_url : "<?php echo e(route('admin.save_tinymce_image')); ?>",
		automatic_uploads : false,
		relative_urls : false,

		images_upload_handler : function(blobInfo, success, failure) {
			var xhr, formData;

			xhr = new XMLHttpRequest();


			xhr.withCredentials = false;
			xhr.open('POST', "<?php echo e(route('admin.save_tinymce_image')); ?>",true);

			var generateToken = '<?php echo e(csrf_token()); ?>';
            xhr.setRequestHeader("X-CSRF-Token", generateToken);

			xhr.onload = function(data) {
				
				var json;

				if (xhr.status != 200) {
					failure('HTTP Error: ' + xhr.status);
					return;
				}

				json = JSON.parse(xhr.responseText);

				if (!json || typeof json.file_path != 'string') {
					failure('Invalid JSON: ' + xhr.responseText);
					return;
				}

				success(json.file_path);
			};

			formData = new FormData();
			formData.append('file', blobInfo.blob(), blobInfo.filename());

			xhr.send(formData);
		}
	});
	
	$(document).ready(function() {    

	   Metronic.init(); 
	   Layout.init(); 

	   
	});
</script><?php /**PATH /home/i1qxzjn7zpro/public_html/softtechover_phase_3/newlaunch/Modules/Admin/Resources/views/layouts/javascript.blade.php ENDPATH**/ ?>