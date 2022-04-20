<ul class="menu ui-sortable menuitems" id="menuitems">
  @foreach($menuLinks as $key=>$value)
    <li data-id="{{$value->menuitem->id}}" id="menu_{{$value->menuitem->id}}"  ><span class="menu-item-bar">{{$value->menuitem->name}}<a href="#collapse{{$value->menuitem->id}}" class="pull-right" data-toggle="collapse"><i class="caret"></i></a>  </span>
                    <div class="collapse" id="collapse{{$value->menuitem->id}}">
                      <form  class="menuitem_edit" accept-charset="utf-8">
                        <input type="hidden" name="id" value="{{Crypt::encrypt($value->menuitem->cms_id)}}">
                        <div class="input-box">
                          <div class="form-actions">
                                <div class="row">
                                  <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn yellow menuitem_edit_btn">Edit</button>
                                    <button class="btn red remove_menu" data-id="{{Crypt::encrypt($value->menuitem->id)}}" data-child_id="" type="button">Delete</button>
                                  </div>
                                </div>
                          </div>
                        </div>
                      </form> 
                    </div>  
                    <ul>   
                        @if(isset($value->children_id) && $value->children_id != null) 
                        @foreach(json_decode($value->children_id) as $k=>$v)
                           <li data-id="{{$v->children_id}}" id="menu_{{$v->children_id}}"  class="menu-item"> <span class="menu-item-bar">{{$v->name}} <a href="#childcollapse{{$v->children_id}}" class="pull-right" data-toggle="collapse"><i class="caret"></i></a> </span> 
                              <div class="collapse" id="childcollapse{{$v->children_id}}">
                                <form  class="menuitem_edit" accept-charset="utf-8">
                                 <input type="hidden" name="id" value="{{Crypt::encrypt($v->cms_id)}}">
                                 <input type="hidden" name="menu_id" value="{{Crypt::encrypt($value->menuitem->id)}}">
                                 <input type="hidden" name="key" value="{{$k}}">
                                  <div class="input-box">
                                    <div class="form-actions">
                                      <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                          <button type="submit" class="btn yellow menuitem_edit_btn">Edit</button>
                                          <button class="btn red remove_menu" data-id="{{Crypt::encrypt($value->menuitem->id)}}" data-child_id="{{Crypt::encrypt($v->children_id)}}" type="button">Delete</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                             </div> 
                           </li>
                        @endforeach                 
                        @endif
                    </ul> 
    </li>
  @endforeach                 
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

