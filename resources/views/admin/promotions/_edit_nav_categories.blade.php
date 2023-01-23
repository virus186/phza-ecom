<div class="modal-dialog modal-md">
  <div class="modal-content">
    {!! Form::open(['route' => 'admin.promotion.navCategories.update', 'method' => 'PUT', 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      {{ trans('app.select_categories') }}
    </div>
    <div class="modal-body">
      <div class="form-group">
        {!! Form::label('trending_categories', trans('app.form.categories')) !!}
        {!! Form::select('main_nav_categories[]', $categories, $nav_categories, ['class' => 'form-control select2-normal', 'multiple' => 'multiple']) !!}
        <small class="text-muted">{{ trans('help.show_category_on_main_nav') }}</small>
        <div class="help-block with-errors"></div>
      </div>
    </div>
    <div class="modal-footer">
      {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
