<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="modal"></div>

<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(trans('lang_data.home_label')); ?></a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
     <?php echo e(trans('lang_data.team_listing_label')); ?>

  </li>
</ul>
<div class="row">
  <div class="col-md-12">
     <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-search" aria-hidden="true"></i> <?php echo e(trans('lang_data.custome_filter')); ?></h3>
          </div>
          <div class="panel-body">
              <form method="POST" id="search-form" class="form-inline" role="form">
                <?php echo e(csrf_field()); ?>

                  <div class="form-group">
                      <label for="name"><?php echo e(trans('lang_data.name_label')); ?></label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo e(trans('lang_data.search_name_placeholder')); ?>">
                  </div>
                  <div class="form-group">
                      <label for="name"><?php echo e(trans('lang_data.status_label')); ?></label>
                      <select name="status" class="form-control">
                        <option value=""><?php echo e(trans('lang_data.select_status_label')); ?></option>
                        <option value="1"><?php echo e(trans('lang_data.active_label')); ?></option>
                        <option value="0"><?php echo e(trans('lang_data.inactive_label')); ?></option>
                      </select>
                  </div>
                 <button type="button" class="btn btn-primary search_text"><?php echo e(trans('lang_data.search_label')); ?></button>
                  <a href="javascript:void(0);" onclick="RESET_FORM();" class="btn btn-danger  btn-flat" id="reset_data_table"><?php echo e(trans('lang_data.reset_label')); ?></a>
              </form>
          </div>
      </div>
    <div class="portlet box grey-cascade">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-globe"></i><?php echo e(trans('lang_data.managed_team_label')); ?>

        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse">
          </a>
          <a href="javascript:;" class="reload" onclick="RESET_FORM();">
          </a>
        </div>
      </div>
     <div class="portlet-body">
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-6">
              <div class="btn-group">
                <a href="<?php echo e(route('admin.teams.create')); ?>" id="sample_editable_1_new" class="btn green">
                Add New <i class="fa fa-plus"></i>
                </a>
              </div>
              <?php if(env('ACCESS_TO_DELETE') == true): ?>
                <div class="btn-group">
                  <a class="btn btn-danger" onclick="deleteAll('table_form','<?php echo e(route('admin.teams.delete_all')); ?>')"><?php echo e(trans('lang_data.delete_all_label')); ?>

                  </a>
                </div>
              <?php endif; ?>
              <div class="btn-group">
                <a class="btn btn-warning" onclick="statusAll('table_form','<?php echo e(route('admin.teams.status_all')); ?>')"><?php echo e(trans('lang_data.status_all_label')); ?>

                </a>
              </div>
            </div>
          </div>
        </div>
          <?php echo e(Form::open([
              'id'=>'table_form',
              'class'=>'table_form',
              'name'=> 'form_data'
            ])); ?>

        <table class="table table-striped table-bordered table-hover" id="users-table">
          <thead>
            <tr>
             <th class="table-checkbox">
              <input type="checkbox" name="checkbox" value="1" id="select_all" />
            </th>
            <th><?php echo e(trans('lang_data.name_label')); ?></th>
            <th><?php echo e(trans('lang_data.role_label')); ?></th>
            <th><?php echo e(trans('lang_data.image_label')); ?></th>
            <th><?php echo e(trans('lang_data.status_label')); ?></th>
            <th><?php echo e(trans('lang_data.action_label')); ?></th>
            </tr>
          </thead>
        </table>
         <?php echo e(Form::close()); ?>

      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script>
  var oTable = $('#users-table').DataTable({
      processing: true,
      serverSide: true,
      searching:false,
      responsive: true,
      ajax: {
            url:'<?php echo route('admin.teams.any_data'); ?>',
            data: function (d) {
                d.name = $('input[name=name]').val();
                d.status = $('select[name=status]').val();
              }
          },
      columns: [
          { data: 'id',orderable: false,searchable: false},
          { data: 'name'},
          { data: 'role'},
          { data: 'image'},
          { data: 'status'},
          { data: 'action',name:'action', orderable: false, searchable: false}
      ]
  });
  
  $(document).on("click",".search_text",function(){
      oTable.draw();
      return false;
  });

  function RESET_FORM(){

    $("#search-form").trigger('reset'); 
        oTable.draw();
        return false;
  }
  $(document).ready(function(){
      
    $(document).on("click","#active_inactive",function(){
        
      swal({
        title: "<?php echo e(trans('lang_data.are_you_sure_want_change_status_label')); ?>",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
              var status = $(this).attr('status');
              var id = $(this).attr('data-id');
              var cur =$(this);
              $.ajax({
                type:"POST",
                url:"<?php echo e(route('admin.teams.single_status_change')); ?>",
                data:{"status":status,"id":id,"_token": "<?php echo e(csrf_token()); ?>"},
                success:function(data){
                         if (data.status == 0) {
                            cur.removeClass('btn-success');
                            cur.addClass('btn-danger');
                            cur.text('<?php echo e(trans('lang_data.inactive_label')); ?>');
                         }else{
                            cur.removeClass('btn-danger');
                            cur.addClass('btn-success');
                            cur.text('<?php echo e(trans('lang_data.active_label')); ?>');
                         }
                  }
              })
          swal("<?php echo e(trans('lang_data.status_has_been_successfully_changed_label')); ?>", {
                      icon: "success",
          });
        } 
      });
    })
  });

  // Open modal in AJAX callback
  $('#manual-ajax').click(function(event) {
    event.preventDefault();
    this.blur(); // Manually remove focus from clicked link.
    $.get(this.href,function(html) {

        $(".modal").show();
        $(".modal").html(html);
      
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\newlaunch\Modules/Admin\Resources/views/team/index.blade.php ENDPATH**/ ?>