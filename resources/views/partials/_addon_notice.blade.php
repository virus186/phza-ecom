@if (config('app.demo') == true)
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong class="badge">{{ trans('app.addon') }} </strong>
    {!! trans('app.this_is_addon_feature') !!}
  </div>
@endif
