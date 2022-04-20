@extends('admin::layouts.master')
@section('style')
<style>
  .imagePreview {
    width: 100% !important;
    height: 180px !important;
    background-position: center center !important;
    background-color:#fff !important;
    background-size: cover !important;
    background-repeat:no-repeat !important;
    display: inline-block !important;
    box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2) !important;
  }
  .btn-danger
  {
    display:block;
    border-radius:0px;
    box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
    margin-top:-5px;
  }
  .btn-danger a{
    color: white !important;
  }
  .imgUp
  {
    margin-bottom:15px;
  }
  .menu{
   list-style-type: none ! important;
 }

 .menu_lable{
  width: 38%;
}

</style>
<style>
  .menu-item-bar{background: #eee;padding: 11px 10px;border:1px solid #d7d7d7;margin-bottom: 5px; width: 89%; cursor: move;display: block;}
  /*#serialize_output{display: none;}*/
  .menulocation label{font-weight: normal;display: block;}
  body.dragging, body.dragging * {cursor: move !important;}
  .dragged {position: absolute;z-index: 1;}
  ul.example li.placeholder {position: relative;}
  ul.example li.placeholder:before {position: absolute;}
  #menuitem{list-style: none;}
  #menuitem ul{list-style: none;}
  .input-box{width:75%;background:#fff;padding: 10px;box-sizing: border-box;margin-bottom: 5px;}
  .input-box .form-control{width: 50%}
  .menulocation label{font-weight: normal;display: block;}
</style>
<link href="{{asset('public/admin/jquery_filter/jquery.filer.css')}}" rel="stylesheet">
@endsection
@section('content')
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="{{route('admin.dashboard')}}">{{trans('lang_data.home_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
   {{trans('lang_data.menu_manage')}}
 </li>
</ul>
<div class="row">
  <div class="col-md-4">
    <div class="todo-content">
        <div class="portlet light">
          <div class="portlet-title">
            <div class="caption">
              <i class="icon-bar-chart font-green-sharp hide"></i>
              <span class="caption-subject font-green-sharp bold uppercase">Choose Menu</span>
            </div>
          </div>
          <div class="portlet-body">
            <div class="row">
              <ul class="menu ui-sortable" >
              @if(isset($headerSectionLink) && !$headerSectionLink->isEmpty())
              @foreach($headerSectionLink as $key=>$value)
              <li>
                <div class="row">
                  <div class="col-md-4">
                    <h5 style="font-size: 15px;">{{$value->name}}</h5>
                  </div> 
                  <div class="col-md-6"> 
                   <button type="buttton" id="add_to_menu_btn" data-id="{{Crypt::encrypt($value->id)}}" class="btn blue">Add Menu</button>
                  </div>
                </div>
              </li><hr>
              @endforeach
              @endif

              </ul>
            </div>
            
          </div>
        </div>
         <input type="text" name="" hidden id="serialize_output2">
    </div>
  </div>
  <div class="col-md-3">
      <div class="todo-content">
        <div class="portlet light">
          <div class="portlet-title">
            <div class="caption">
              <i class="icon-bar-chart font-green-sharp hide"></i>
              <span class="caption-subject font-green-sharp bold uppercase">Add/Edit Menu</span>
            </div>
          </div>
          <div class="portlet-body menu_edit_structure">
            <form id="addmenuform" class="addupdatemenuform">
              <div class="form-group" >
                <label for="exampleInputEmail1" class="form-label">Text</label>
                <input type="text" name="name" class="form-control name" value="" placeholder=" Name">
                 
              </div>
              <div class="form-group" >
                <label for="exampleInputEmail1" class="form-label">Url</label>
                <input type="text" name="slug" class="form-control set-slug" value="" placeholder=" Url Slug">    
              </div>
              <div class="form-group" >
                <label for="exampleInputEmail1" class="form-label">Target</label>

                <select class="form-select form-control" name="target" aria-label="Default select example">
                  <option value="0" selected>Select Target</option>
                  <option value="1">Self</option>
                  <option value="2">Blank</option>
                  <option value="3">None</option>
                </select>
              </div>
              <button class="btn btn-primary add_menu" type="submit">Add</button>
            </form>
          </div>
        </div>
         <input type="text" name="" hidden id="serialize_output2">
      </div>
  </div>
  <div class="col-md-5">
      <div class="todo-content">
        <div class="portlet light">
          <div class="portlet-title">
            <div class="caption">
              <i class="icon-bar-chart font-green-sharp hide"></i>
              <span class="caption-subject font-green-sharp bold uppercase">Menu Strucutre</span>
            </div>
          </div>
          <div class="portlet-body">
            <div class="row menu_strucutre">
              
            </div>
            <button class="btn btn-success save_menu">Save Menu</button>
          </div>
        </div>
         <input type="text" name="" hidden id="serialize_output2">
      </div>
  </div>
  
</div>
@endsection
@section('javascript')
<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/admin/jquery_filter/jquery.filer.min.js"></script>


<script type="text/javascript">


  $(document).on('click', '#add_to_menu_btn', function(event) {
    event.preventDefault();

    var id=$(this).data('id');
    $.ajax({
      url: '{{route('admin.menu.store')}}',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {cms_id: id},
      success:function (response) {
        if(response.msg != '' && response.status ==1){
         $.bootstrapGrowl(response.msg, {
          type: 'success',
          delay: 5000
        });
         MenuStrucutre();
       }
     },
     error: function (jqXhr) {
      var errors = $.parseJSON(jqXhr.responseText);
      var msgs = "";
      $.each(errors.errors, function(key, value) {
        msgs += value + " <br>";
      });
      $.bootstrapGrowl(msgs, {
        type: 'danger',
        delay: 5000
      });
     }
    });
  });

  $(document).on('click', '.save_menu', function(event) {
    event.preventDefault();
    $(this).attr('disabled', 'true');
    $(this).text('loding...');
    var sorted_data=$('#serialize_output2').val();
    var op=$(this);
    $.ajax({
      url: '{{route('admin.menu.sorting')}}',
      type: 'POST',
      data: {sorted_data: sorted_data},
      success:function(response) {
        if(response.msg != null && response.status ==1){
          $.bootstrapGrowl(response.msg, {
            type: 'success',
            delay: 5000
          });
          op.text('Save Menu');
          op.removeAttr('disabled');

        }
      }
    });

  });

  $(document).on('click', '.remove_menu', function(event) {
    event.preventDefault();
    var remove_id=$(this).data('id');
    var remove_child_id=$(this).data('child_id');
    var op=$(this);
    $.ajax({
      url: '{{route('admin.menu.remove_menu')}}',
      type: 'POST',
      
      data: {remove_id: remove_id,remove_child_id:remove_child_id},
      success:function(data) {
        if(data.status == 1 && data.msg != null){
          MenuStrucutre();
         $.bootstrapGrowl(data.msg, {
          type: 'success',
          delay: 5000
        });
       }
     }
   }); 
  });

  $(document).on('submit', 'form.menuitem_edit', function(event) {
    event.preventDefault();
    $('.menuitem_edit_btn').attr('disabled', 'true');
    $('.menuitem_edit_btn').text('loding...');

    $.ajax({

      url: '{{route('admin.menu.menuitem_edit')}}',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      contentType: false,
      processData: false,
      data: new FormData(this),
      success:function (response) {
         $('.menu_edit_structure').html(response);
          $('.menuitem_edit_btn').text('Edit');
       $('.menuitem_edit_btn').removeAttr('disabled');
     },
     error: function (jqXhr) {
       $('.menuitem_edit_btn').text('Edit');
       $('.menuitem_edit_btn').removeAttr('disabled');
       var errors = $.parseJSON(jqXhr.responseText);
       var msgs = "";
       $.each(errors.errors, function(key, value) {
        msgs += value + " <br>";
      });
       $.bootstrapGrowl(msgs, {
        type: 'danger',
        delay: 5000
      });


     }
   });

  });

  $(document).on('submit', 'form.addupdatemenuform', function(event) {
    event.preventDefault();
    $('.add_menu').attr('disabled', 'true');
    $('.update_menu').attr('disabled', 'true');
    $('.add_menu').text('loding...');
    $('.update_menu').text('loding...');

    $.ajax({

      url: '{{route('admin.menu.menuitem_store')}}',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      contentType: false,
      processData: false,
      data: new FormData(this),
      success:function (response) {
        if(response.msg != '' && response.status ==1){
          $('.add_menu').text('Add');
          $('.update_menu').text('Update');
          $('.add_menu').removeAttr('disabled');
          $('.update_menu').removeAttr('disabled');
          $.bootstrapGrowl(response.msg, {
            type: 'success',
            delay: 5000
          });
         MenuStrucutre();

       }
     },
     error: function (jqXhr) {
       $('.add_menu').text('Add');
       $('.update_menu').text('Update');
       $('.add_menu').removeAttr('disabled');
       $('.update_menu').removeAttr('disabled');
       var errors = $.parseJSON(jqXhr.responseText);
       var msgs = "";
       $.each(errors.errors, function(key, value) {
        msgs += value + " <br>";
      });
       $.bootstrapGrowl(msgs, {
        type: 'danger',
        delay: 5000
      });


     }
   });

  });

  function MenuStrucutre() {
    $.ajax({
      url: '{{route('admin.menu.menu_strucutre_data')}}',
      type: 'POST',
      success:function(response) {

        $('.menu_strucutre').html(response);
      }
    });   
  }

  function makeslug(slug) {

      var a = slug;

      var b = a.toLowerCase().replace(/ /g, '-')
          .replace(/[^\w-]+/g, '');
      
      $(".set-slug").val(b);    
   }

   $(document).on('keyup', '.name', function(event) {
     event.preventDefault();
     var slug =$(this).val();

     makeslug(slug);
     
   });

  MenuStrucutre();  
</script>
@endsection
