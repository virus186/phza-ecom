@extends('auth.master')

@section('content')
  <div class="admin-login-mod">
    @if (is_incevio_package_loaded('otp-login'))
      {{-- <div class="box"> --}}
      <div class="nav-tabs-custom no-shadow">
        <ul class="nav nav-tabs nav-justified">
          <li class="active">
            <a href="#login_with_email" data-toggle="tab">
              <i class="fa fa-envelope hidden-sm"></i>
              @lang('otp-login::lang.login_with_email')
            </a>
          </li>

          <li>
            <a href="#login_with_phone" data-toggle="tab">
              <i class="fa fa-phone hidden-sm"></i>
              @lang('otp-login::lang.login_with_phone')
            </a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane active" id="login_with_email">
            {{-- <div class="box login-box-body"> --}}
            {{-- <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('app.form.login') }}</h3>
                </div> <!-- /.box-header --> --}}
            {{-- <div class="box-body"> --}}
            {!! Form::open(['route' => 'login', 'id' => 'form', 'data-toggle' => 'validator']) !!}

            <div class="form-group has-feedback">
              {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.form.email_address'), 'required']) !!}
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
              {!! Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('app.form.password'), 'data-minlength' => '6', 'required']) !!}
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <div class="help-block with-errors"></div>
            </div>

            <div class="row">
              <div class="col-xs-7">
                <div class="form-group">
                  <label>
                    {!! Form::checkbox('remember', null, null, ['class' => 'icheck']) !!} {{ trans('app.form.remember_me') }}
                  </label>
                </div>
              </div>

              <div class="col-xs-5 pull-right">
                {!! Form::submit(trans('app.form.login'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
              </div>
            </div>
            {!! Form::close() !!}

            <a class="btn btn-link" href="{{ route('password.request') }}">{{ trans('app.form.forgot_password') }}</a>

            <a class="btn btn-link" href="{{ route('vendor.register') }}" class="text-center">{{ trans('app.form.register_as_merchant') }}</a>
            {{-- </div> --}}
            {{-- </div> --}}
          </div><!-- /.tab-pane -->

          <div class="tab-pane" id="login_with_phone">
            {{-- <div class="box login-box-body"> --}}
            {{-- <div class="box-body"> --}}
            {!! Form::open(['route' => 'login', 'id' => 'form', 'data-toggle' => 'validator']) !!}

            @include('otp-login::phone_field')

            <div class="row">
              <div class="col-xs-7">
                <a class="btn btn-link" href="{{ route('vendor.register') }}" class="text-center">{{ trans('app.form.register_as_merchant') }}</a>
              </div>
              <div class="col-xs-5 pull-right">
                {!! Form::submit(trans('app.form.login'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
              </div>
            </div>
            {!! Form::close() !!}
            {{-- </div><!-- /.box-body --> --}}
            {{-- </div> --}}
          </div>
        </div> <!-- /.tab-content -->
      </div> <!-- /.nav-tabs-custom -->
      {{-- </div> <!-- /.box --> --}}
    @else
      <div class="box login-box-body">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('app.form.login') }}</h3>
        </div> <!-- /.box-header -->
        <div class="box-body">
          {!! Form::open(['route' => 'login', 'id' => 'form', 'data-toggle' => 'validator']) !!}

          @if (is_incevio_package_loaded('otp-login'))
            @include('otp-login::phone_field')
          @else
            <div class="form-group has-feedback">
              {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.form.email_address'), 'required']) !!}
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
              {!! Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('app.form.password'), 'data-minlength' => '6', 'required']) !!}
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <div class="help-block with-errors"></div>
            </div>

            <div class="row">
              <div class="col-xs-7">
                <div class="form-group">
                  <label>
                    {!! Form::checkbox('remember', null, null, ['class' => 'icheck']) !!} {{ trans('app.form.remember_me') }}
                  </label>
                </div>
              </div>
          @endif

          <div class="col-xs-5 pull-right">
            {!! Form::submit(trans('app.form.login'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
          </div>
        </div>
        {!! Form::close() !!}

        @if (!is_incevio_package_loaded('otp-login'))
          <a class="btn btn-link" href="{{ route('password.request') }}">{{ trans('app.form.forgot_password') }}</a>
        @endif

        <a class="btn btn-link" href="{{ route('vendor.register') }}" class="text-center">{{ trans('app.form.register_as_merchant') }}</a>
      </div>
    @endif
  </div>

  @if (config('app.demo') == true)
    <div class="box login-box-body">
      <div class="box-header with-border">
        <h3 class="box-title">Demo Login::</h3>
      </div> <!-- /.box-header -->
      <div class="box-body">
        <p><strong>ADMIN::</strong> Username: <strong>superadmin@demo.com</strong> | Password: <strong>123456</strong>
        </p>
        <p><strong>MERCHANT::</strong> Username: <strong>merchant@demo.com</strong> | Password: <strong>123456</strong>
        </p>
      </div>
    </div>
  @endif
  </div>
@endsection
