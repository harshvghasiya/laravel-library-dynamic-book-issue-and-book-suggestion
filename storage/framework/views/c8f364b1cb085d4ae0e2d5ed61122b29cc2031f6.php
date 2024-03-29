<link href="<?php echo e(asset("public/css/fileinput.css")); ?>" rel="stylesheet">
<script src="<?php echo e(asset("public/js/fileinput.js")); ?>"></script>


<!-- page script -->
<script type="text/javascript">
;(function($, window, document) {
	$( document ).ready(function () {
	    var formData = new FormData();

	    var footerTemplate = '<div class="file-thumbnail-footer">\n' +
	            '     {actions}\n' +
	            '</div>';

	    var actionsTemplate = '<div class="file-actions">\n' +
	            '    <div class="file-footer-buttons">\n' +
	            '       {zoom} {other} {delete}' +
	            '    </div>\n' +
	            '    {drag}\n' +
	            '    <div class="clearfix"></div>\n' +
	            '</div>';

	    var deleteTemplate = '<button type="button" class="delete_im btn btn-kv btn-default btn-flat btn-xs" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.remove')); ?>" {dataUrl}{dataKey}><i {dataUrl}{dataKey} class="fa fa-trash delete_im"></i></button>\n';


	    var zoomTemplate = '<button type="button" class="kv-file-zoom btn btn-default btn-flat btn-xs"  data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.preview')); ?>"><i class="fa fa-search-plus"></i></button>';

	    var dragTemplate = '<span class="file-drag-handle {dragClass}" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.move')); ?>"><i class="fa fa-arrows"></i></span>';

	    var initialPreview = [<?=isset($preview) ? $preview['urls'] : '';?>];

	    var initialPreviewConfig = [<?=isset($preview) ? $preview['configs'] : '';?>];

	    $("#dropzone-input").fileinput({
	        uploadUrl: "",
	        uploadExtraData: function () {
	            var extra = {};
	            extra['model_id'] = formData.get('model_id');
	            extra['model_name'] = formData.get('model_name');
	            extra['redirect_url'] = formData.get('redirect_url');
	            return extra;
	        },
	        showUpload: false,
	        enableResumableUpload: true,
	        resumableUploadOptions: {
	            // testUrl: "/site/test-file-chunks",
	            chunkSize: <?php echo e(config('image.chunk_size', 1024)); ?>,
	        },
	        dropZoneEnabled: true,
	        browseOnZoneClick: true,
	        dropZoneTitle: "<?php echo e(trans('lang_data.drag_n_drop_here')); ?>",
	        showClose: false,
	        showRemove: false,
	        showCaption: false,
	        maxFilePreviewSize: 25600,
	        minFileSize: <?php echo e(getAllowedMinImgSize()); ?>,
	        maxFileSize: <?php echo e(getAllowedMaxImgSize()); ?>,
	        minFileCount: 0,
	        maxTotalFileCount: 10,
	        allowedFileExtensions: ['jpg', 'jpeg', 'gif', 'png'],
	        msgFilesTooLess : "<?php echo trans('help.number_of_img_upload_required'); ?>",
	        msgTotalFilesTooMany : "<?php echo trans('help.number_of_img_upload_exceeded'); ?>",
	        msgInvalidFileExtension : "<?php echo trans('help.msg_invalid_file_extension'); ?>",
	        msgSizeTooLarge : "<?php echo trans('help.msg_invalid_file_too_learge'); ?>",
	        dragSettings: {
	    		animation: 300,
				onUpdate: function (evt) {
					console.log(evt);
				},
	        },
	        initialPreview: initialPreview,
	        overwriteInitial: false,
	        initialPreviewAsData: true,
	        initialPreviewFileType: 'image',
	        initialPreviewDownloadUrl: "<?php echo e(url('download/{key}')); ?>",
	        initialPreviewConfig: initialPreviewConfig,
	        layoutTemplates: { footer: footerTemplate, actions: actionsTemplate, actionDelete: deleteTemplate, actionZoom: zoomTemplate, actionDrag: dragTemplate },
	    }).on('filedeleted', function() {
	        setTimeout(function() {
	          notie.alert(1, "<?php echo e(trans('messages.file_deleted')); ?>", 3);
	        }, 900);
	    }).on('filesorted', function(event, params) {
	    	var sortUrl = "<?php echo e(route('admin.image.sort')); ?>";
	    	var max = Math.max(params.oldIndex, params.newIndex);
	    	var min = Math.min(params.oldIndex, params.newIndex);
	    	var order = {};
	    	var stack = params.stack;
			for(k in stack){
				if (k >= min && k <= max)
					order[stack[k].key] = k;
			};

			// Update the database using AJAX
		   	$.post(sortUrl, order, function(theResponse, status){
				notie.alert(1, "<?php echo e(trans('responses.reordered')); ?>", 2);
		    });
		}).on('fileuploaded', function(event, previewId, index, fileId) {
	        console.log('File Uploaded', 'ID: ' + fileId + ', Thumb ID: ' + previewId);
	    }).on('fileuploaderror', function(event, previewId, index, fileId) {
	        console.log('File Upload Error', 'ID: ' + fileId + ', Thumb ID: ' + previewId);
	    }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {
	        console.log('File Batch Uploaded', preview, config, tags, extraData);
			window.location.href = extraData.redirect_url;
	    });

	    $('div.btn.btn-primary.btn-file').hide();

	    $('#productValidation').on('submit', function(event) {
	      	$(this).find(":submit").prop("disabled", true);

			var action = $(this).attr('action');

			$.ajax({
				url: action,
				type: "POST",
				datatype: "json",
				data: new FormData(this),
				processData: false,  // tell jQuery not to process the data
				contentType: false,   // tell jQuery not to set contentType
			})
			.done(function(result){
				// return false;
				window.location.href = result.redirect;
			})
			.fail(function(xhr){
		      	$("#productValidation").find(":submit").removeAttr("disabled");
				var err = '';
				if (401 === xhr.status){
					alert("erro");

				}
				else if( 422 === xhr.status ) {
				  notie.alert(3, "<?php echo e(trans('responses.form_validation_failed')); ?>", 3);
				  var response = xhr.responseJSON;

				  $.each(response.errors,function(key,input){
				    err += input + '<br/>';
				  });
				}
				else{
				  err += "<?php echo e(trans('responses.error')); ?>";
				}

				var msg = '<div class="alert alert-danger alert-dismissible">' +
				            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
				            '<h4><i class="icon fa fa-warning"></i><?php echo e(trans('app.error')); ?></h4>' +
				            '<p id="global-alert-msg">' + err + '</p>' +
				          '</div>';
				$("section.content").prepend(msg);
			});

			return false;
	    });
	});
	
	$(document).on("click",".delete_im",function(){

			
	var curThis = $(this);

	  swal({
	      title: "Are you sure want to delete this record ?",
	      icon: "warning",
	      buttons: true,
	      dangerMode: true,
	    })
	    .then((willDelete) => {
	      if (willDelete) {
	        var formAction = $(this).attr('data-url');
	        $.ajax({
	            type: "POST",
	            url: formAction,
	            success: function (response) {
	                
	                if(response.success == 1){
	               	
	               		curThis.parent().parent().parent().parent().empty();	    

	                  swal(response.msg, {
	                    icon: "success",
	                    });

	                }else{
	                  	
	                  
	                    swal(response.msg, {
	                    icon: "warning",
	                    });
	                }
	            },
	            error: function (jqXhr) {
	          }
	        });
	        
	      } 
	    });
	});


}(window.jQuery, window, document));
</script><?php /**PATH /var/www/html/laravel_ecommerce/Modules/Admin/Resources/views/product/dropzone-upload.blade.php ENDPATH**/ ?>