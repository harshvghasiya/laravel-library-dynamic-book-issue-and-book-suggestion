 
 <form id="addmenuform" class="addupdatemenuform">
  <div class="form-group" >
    <label for="exampleInputEmail1" class="form-label">Text</label>
    <input type="hidden" name="id" value="{{Crypt::encrypt($edit->id)}}">
    <input type="hidden" name="menu_id" value="{{$menu_id}}">
    <input type="text" name="name" class="form-control" value="{{$edit->name}}" placeholder="Name">

  </div>
  <div class="form-group" >
    <label for="exampleInputEmail1" class="form-label">Target</label>

    <select class="form-select form-control" name="target"  aria-label="Default select example">
      <option value="0">Select Target</option>
      <option value="1" @if($edit->menulink->target == 1) selected @endif >Self</option>
      <option value="2" @if($edit->menulink->target == 2) selected @endif>Blank</option>
      <option value="3" @if($edit->menulink->target == 3) selected @endif>None</option>
    </select>
  </div>
  <button class="btn btn-warning update_menu" type="submit">Update</button>
</form>