@extends('admin::layouts.master')
@section('style')
@endsection
@section('content')
<ul class="page-breadcrumb breadcrumb">
  <li>
    <a href="{{route('admin.dashboard')}}">{{trans('lang_data.home_label')}}</a><i class="fa fa-circle"></i>
  </li>
  <li class="active">
     {{trans('lang_data.contactus_list_label')}}
  </li>
</ul>
<div class="row">
  <div class="col-md-12">
     <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-search" aria-hidden="true"></i> {{trans('lang_data.custome_filter')}}</h3>
          </div>
          <div class="panel-body">
              <form method="POST" id="search-form" class="form-inline" role="form">
                {{ csrf_field() }}
                  <div class="form-group">
                      <input type="text" class="form-control" name="keyword" id="keyword" placeholder="{{trans('lang_data.search_label')}}">
                  </div>
                 <button type="button" class="btn btn-primary search_text">{{trans('lang_data.search_label')}}</button>
                  <a href="javascript:void(0);" onclick="RESET_FORM();" class="btn btn-danger  btn-flat" id="reset_data_table">{{trans('lang_data.reset_label')}}</a>
              </form>
          </div>
      </div>
    <div class="portlet box grey-cascade">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-globe"></i>{{trans('lang_data.managed_contact_us_label')}}
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
                <a class="btn btn-danger" onclick="deleteAll('table_form','{{route('admin.contactus.delete_all')}}')">{{trans('lang_data.delete_all_label')}}
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
              <th>{{trans('lang_data.email_label')}}</th>
              <th>{{trans('lang_data.subject_label')}}</th>
              <th>{{trans('lang_data.c_message_label')}}</th>
              <th>{{trans('lang_data.created_by_label')}}</th>
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
            url:'{!! route('admin.contactus.any_data') !!}',
            data: function (d) {
              d.keyword = $('input[name=keyword]').val();
            }
          },
      columns: [
        { data: 'id',orderable: false,searchable: false},
        { data: 'name'},
        { data: 'email'},
        { data: 'subject'},
        { data: 'message'},
        { data: 'created_at'},
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
                url:"{{route('admin.contactus.single_status_change')}}",
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