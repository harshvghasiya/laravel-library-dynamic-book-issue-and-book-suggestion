<ul class="menu ui-sortable menuitems" id="menuitems">
  <?php $__currentLoopData = $menuLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li data-id="<?php echo e($value->menuitem->id); ?>" id="menu_<?php echo e($value->menuitem->id); ?>"  ><span class="menu-item-bar"><?php echo e($value->menuitem->name); ?><a href="#collapse<?php echo e($value->menuitem->id); ?>" class="pull-right" data-toggle="collapse"><i class="caret"></i></a>  </span>
                    <div class="collapse" id="collapse<?php echo e($value->menuitem->id); ?>">
                      <form  class="menuitem_edit" accept-charset="utf-8">
                        <input type="hidden" name="id" value="<?php echo e(Crypt::encrypt($value->menuitem->cms_id)); ?>">
                        <div class="input-box">
                          <div class="form-actions">
                                <div class="row">
                                  <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn yellow menuitem_edit_btn">Edit</button>
                                    <button class="btn red remove_menu" data-id="<?php echo e(Crypt::encrypt($value->menuitem->id)); ?>" data-child_id="" type="button">Delete</button>
                                  </div>
                                </div>
                          </div>
                        </div>
                      </form> 
                    </div>  
                    <ul>   
                        <?php if(isset($value->children_id) && $value->children_id != null): ?> 
                        <?php $__currentLoopData = json_decode($value->children_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <li data-id="<?php echo e($v->children_id); ?>" id="menu_<?php echo e($v->children_id); ?>"  class="menu-item"> <span class="menu-item-bar"><?php echo e($v->name); ?> <a href="#childcollapse<?php echo e($v->children_id); ?>" class="pull-right" data-toggle="collapse"><i class="caret"></i></a> </span> 
                              <div class="collapse" id="childcollapse<?php echo e($v->children_id); ?>">
                                <form  class="menuitem_edit" accept-charset="utf-8">
                                 <input type="hidden" name="id" value="<?php echo e(Crypt::encrypt($v->cms_id)); ?>">
                                 <input type="hidden" name="menu_id" value="<?php echo e(Crypt::encrypt($value->menuitem->id)); ?>">
                                 <input type="hidden" name="key" value="<?php echo e($k); ?>">
                                  <div class="input-box">
                                    <div class="form-actions">
                                      <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                          <button type="submit" class="btn yellow menuitem_edit_btn">Edit</button>
                                          <button class="btn red remove_menu" data-id="<?php echo e(Crypt::encrypt($value->menuitem->id)); ?>" data-child_id="<?php echo e(Crypt::encrypt($v->children_id)); ?>" type="button">Delete</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                             </div> 
                           </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                 
                        <?php endif; ?>
                    </ul> 
    </li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                 
</ul>
<script type="text/javascript">
  var group = $(".menuitems").sortable({
    group: 'serialization',
    onDrop: function ($item, container, _super) {
      var data = group.sortable("serialize").get();     
      var jsonString = JSON.stringify(data, null, ' ');
      $('#serialize_output2').val(jsonString);
      _super($item, container);
    }
  });
</script>

<?php /**PATH C:\laragon\www\newlaunch\Modules/Admin\Resources/views/menu/menustrucutre.blade.php ENDPATH**/ ?>