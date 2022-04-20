<div class="form-group" >
  <label class="control-label mb-10 text-left">{{trans('lang_data.subcategory_label')}} </label>
    {{ Form::select('subcategory_id',[''=>'Select Sub Category']+ \App\Models\Category::getSubcatDropDown($category_id),null,['id'=>'subcategory_id',"class"=>"form-control"])  }}
</div> 