@extends('admin::layouts.master')
@section('style')
@endsection
@section('content')
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="{{route('admin.dashboard')}}">{{trans('lang_data.home_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
     {{trans('lang_data.brand_list_label')}}
  </li>
</ul>
<div class="row">
  <div class="col-md-12">
     <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-search" aria-hidden="true"></i> {{trans('lang_data.custome_filter')}}</h3>
          </div>
          <div class="panel-body">
            <!-- form-inline -->
              <form method="POST" id="search-form" class="" role="form">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="name">{{trans('lang_data.name_label')}}</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="{{trans('lang_data.search_name_placeholder')}}">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">{{trans('lang_data.status_label')}}</label>
                        <select name="status" class="form-control">
                          <option value="">{{trans('lang_data.select_status_label')}}</option>
                          <option value="1">{{trans('lang_data.active_label')}}</option>
                          <option value="0">{{trans('lang_data.inactive_label')}}</option>
                        </select>
                    </div>
                  </div>
                </div>
                 <button type="button" class="btn btn-primary search_text">{{trans('lang_data.search_label')}}</button>
                  <a href="javascript:void(0);" onclick="RESET_FORM();" class="btn btn-danger  btn-flat" id="reset_data_table">{{trans('lang_data.reset_label')}}</a>
              </form>
          </div>
      </div>
    <div class="portlet box grey-cascade">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-globe"></i>{{trans('lang_data.managed_brand_label')}}
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
                <a href="{{route('admin.brand.create')}}" id="sample_editable_1_new" class="btn green">
                {{trans('lang_data.add_new_label')}} <i class="fa fa-plus"></i>
                </a>
              </div>
              @if(env('ACCESS_TO_DELETE') == true)
              <div class="btn-group">
                <a class="btn btn-danger" onclick="deleteAll('table_form','{{route('admin.brand.delete_all')}}')">{{trans('lang_data.delete_all_label')}}
                </a>
              </div>
              @endif
              <div class="btn-group">
                <a class="btn btn-warning" onclick="statusAll('table_form','{{route('admin.brand.status_all')}}')">{{trans('lang_data.status_all_label')}}
                </a>
              </div>
            </div>
          </div>
        </div>
          {{ Form::open([
              'id'=>'table_form',
              'class'=>'table_form',
              'name'=> 'form_data'
            ])
          }}
        <table class="table table-striped table-bordered table-hover" id="users-table">
          <thead>
            <tr>
              <th class="table-checkbox">
                <input type="checkbox" name="checkbox" value="1" id="select_all" />
              </th>
              <th>{{trans('lang_data.name_label')}}</th>
              <th>{{trans('lang_data.status_label')}}</th>
              <th>{{trans('lang_data.action_label')}}</th>
            </tr>
          </thead>
        </table>
         {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
<script>
  var oTable = $('#users-table').DataTable({
      processing: true,
      serverSide: true,
      searching:false,
      responsive: true,
      ajax: {
            url:'{!! route('admin.brand.any_data') !!}',
            data: function (d) {
              d.name = $('input[name=name]').val();
              d.status = $('select[name=status]').val();
            }
          },
      columns: [
        { data: 'id',orderable: false,searchable: false},
        { data: 'name'},
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
        title: "{{trans('lang_data.are_you_sure_want_change_status_label')}}",
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
                url:"{{route('admin.brand.single_status_change')}}",
                data:{"status":status,"id":id,"_token": "{{ csrf_token() }}"},
                success:function(data){
                         if (data.status == 0) {
                            cur.removeClass('btn-success');
                            cur.addClass('btn-danger');
                            cur.text('{{trans('lang_data.inactive_label')}}');
                         }else{
                            cur.removeClass('btn-danger');
                            cur.addClass('btn-success');
                            cur.text('{{trans('lang_data.active_label')}}');
                         }
                  }
              })
          swal("{{trans('lang_data.status_has_been_successfully_changed_label')}}", {
                      icon: "success",
          });
        } 
      });
    })
  });
</script>
@endsection