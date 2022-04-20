<script src='<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/mix/js/all.js'></script>
<script src='<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/ckeditor/ckeditor.js'></script>
<script src='<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/admin/comman_js/common.js'></script>
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
});

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
</script><?php /**PATH C:\xampp\htdocs\softtechover\Modules/Admin\Resources/views/layouts/javascript.blade.php ENDPATH**/ ?>