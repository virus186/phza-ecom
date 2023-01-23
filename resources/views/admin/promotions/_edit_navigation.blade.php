<div class="modal-dialog modal-md">
  <div class="modal-content">
    {!! Form::open(['route' => 'admin.promotion.navigation.update', 'method' => 'PUT', 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      {{ trans('app.main_nav') }}
    </div>
    <div class="modal-body">
      @foreach ($navigations as $key => $navigation)
        <div class="form-group">
          <div class="checkbox">
            <label class="">
              {!! Form::checkbox('hide[]', $key, in_array($key, $hidden_items), ['class' => 'icheck']) !!} {{ $navigation }}
            </label>
          </div>
        </div>
      @endforeach
    </div>
    <div class="modal-footer">
      <p class="text-info pull-left"> <i class="fa fa-info-circle"></i> {{ trans('help.hide_item_from_main_nav') }}</p>
      {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
