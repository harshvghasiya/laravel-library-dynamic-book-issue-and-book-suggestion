 
 <form id="addmenuform" class="addupdatemenuform">
  <div class="form-group" >
    <label for="exampleInputEmail1" class="form-label">Text</label>
    <input type="hidden" name="id" value="<?php echo e(Crypt::encrypt($edit->id)); ?>">
    <input type="hidden" name="menu_id" value="<?php echo e($menu_id); ?>">
    <input type="text" name="name" class="form-control" value="<?php echo e($edit->name); ?>" placeholder="Name">

  </div>
  <div class="form-group" >
    <label for="exampleInputEmail1" class="form-label">Target</label>

    <select class="form-select form-control" name="target"  aria-label="Default select example">
      <option value="0">Select Target</option>
      <option value="1" <?php if($edit->menulink->target == 1): ?> selected <?php endif; ?> >Self</option>
      <option value="2" <?php if($edit->menulink->target == 2): ?> selected <?php endif; ?>>Blank</option>
      <option value="3" <?php if($edit->menulink->target == 3): ?> selected <?php endif; ?>>None</option>
    </select>
  </div>
  <button class="btn btn-warning update_menu" type="submit">Update</button>
</form><?php /**PATH C:\laragon\www\newlaunch\Modules/Admin\Resources/views/menu/menu_edit_structure.blade.php ENDPATH**/ ?>