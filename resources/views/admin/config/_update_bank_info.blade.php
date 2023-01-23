<div class="modal-dialog modal-sm">
  <div class="modal-content">
    {!! Form::open(['route' => ['admin.setting.bankInfo.update', $bankInfo->shop_id], 'method' => 'PUT', 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      {{ trans('app.form.form') }}
    </div>
    <div class="modal-body">
      <div class="form-group">
        {!! Form::label('ac_holder_name', trans('app.form.account_holder_name') . '*') !!}
        {!! Form::text('ac_holder_name', $bankInfo->ac_holder_name, ['class' => 'form-control', 'required', 'placeholder' => trans('app.placeholder.ac_holder_name')]) !!}
      </div>
      <div class="form-group">
        {!! Form::label('ac_number', trans('app.form.account_number') . '*') !!}
        {!! Form::number('ac_number', $bankInfo->ac_number, ['class' => 'form-control', 'required', 'placeholder' => trans('app.placeholder.account_number')]) !!}
      </div>
      <div class="row">
        <div class="col-md-6 nopadding-right">
          <div class="form-group">
            {!! Form::label('ac_type', trans('app.form.account_type'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.account_type') }}"></i>
            {!! Form::text('ac_type', $bankInfo->ac_type, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.account_type')]) !!}
          </div>
        </div>
        <div class="col-md-6 nopadding-left">
          <div class="form-group">
            {!! Form::label('ac_routing_number', trans('app.form.account_routing_number'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.account_routing_number') }}"></i>
            {!! Form::text('ac_routing_number', $bankInfo->ac_routing_number, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.account_routing_number')]) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 nopadding-right">
          <div class="form-group">
            {!! Form::label('ac_swift_bic_code', trans('app.form.ac_swift_bic_code') . '*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.account_swift_bic_code') }}"></i>
            {!! Form::text('ac_swift_bic_code', $bankInfo->ac_swift_bic_code, ['class' => 'form-control', 'required', 'placeholder' => trans('app.placeholder.ac_swift_bic_code')]) !!}
          </div>
        </div>
        <div class="col-md-6 nopadding-left">
          <div class="form-group">
            {!! Form::label('ac_iban', trans('app.form.ac_iban'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.account_iban') }}"></i>
            {!! Form::text('ac_iban', $bankInfo->ac_iban, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.ac_iban')]) !!}
          </div>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('ac_bank_address', trans('app.form.ac_bank_address')) !!}
        {!! Form::text('ac_bank_address', $bankInfo->ac_bank_address, ['class' => 'form-control', 'required', 'placeholder' => trans('app.placeholder.ac_bank_address')]) !!}
      </div>
    </div>
    <div class="modal-footer">
      {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
