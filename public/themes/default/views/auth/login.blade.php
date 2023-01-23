@extends('theme::auth.layout')

@section('content')
  <div class="customer-login-mod">
    @if (is_incevio_package_loaded('otp-login'))
      {{-- <div class="box"> --}}
      <div class="nav-tabs-custom" style="box-shadow: none; margin-bottom: 0;">
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
                <h3 class="box-title">{{ trans('theme.account_login') }}</h3>
              </div> <!-- /.box-header --> --}}
            {{-- <div class="box-body"> --}}
            {!! Form::open(['route' => 'customer.login.submit', 'id' => 'form', 'data-toggle' => 'validator']) !!}

            <div class="form-group has-feedback">
              {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.email'), 'required']) !!}
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback">
              {!! Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('theme.placeholder.password'), 'data-minlength' => '6', 'required']) !!}
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <div class="help-block with-errors"></div>
            </div>

            <div class="row">
              <div class="col-sm-7">
                <div class="form-group">
                  <label>
                    {!! Form::checkbox('remember', null, null, ['class' => 'icheck']) !!} {{ trans('theme.remember_me') }}
                  </label>
                </div>
              </div>

              <div class="col-sm-5 pull-right">
                {!! Form::submit(trans('theme.button.login'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
              </div>
            </div>
            {!! Form::close() !!}

            {{-- @if (!is_incevio_package_loaded('otp-login')) --}}
            <a class="btn btn-link" href="{{ route('customer.password.request') }}">
              {{ trans('theme.forgot_password') }}
            </a>
            {{-- @endif --}}
            {{-- </div> --}}
            {{-- </div> --}}
          </div><!-- /.tab-pane -->

          <div class="tab-pane" id="login_with_phone">
            {{-- <div class="box login-box-body"> --}}
            {{-- <div class="box-header with-border">
                <h3 class="box-title">{{ trans('theme.account_login') }}</h3>
              </div> <!-- /.box-header --> --}}
            {{-- <div class="box-body"> --}}
            {!! Form::open(['route' => 'customer.login.submit', 'id' => 'form', 'data-toggle' => 'validator']) !!}

            @include('otp-login::phone_field')

            <div class="row">
              <div class="col-sm-7">
              </div>

              <div class="col-sm-5 pull-right">
                {!! Form::submit(trans('theme.button.login'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
              </div>
            </div>
            {!! Form::close() !!}
            {{-- </div> --}}

            {{-- @if (config('system_settings.social_auth'))
              <div class="row">
                <div class="col-sm-12">
                  <div class="social-auth-links text-center">
                    @if (is_incevio_package_loaded('facebook-login'))
                      <a href="{{ route('socialite.customer.facebook') }}" class="btn btn-block btn-social btn-facebook btn-lg btn-flat">
                        <i class="fa fa-facebook"></i> {{ trans('theme.button.login_with_fb') }}
                      </a>
                    @endif

                    @if (is_incevio_package_loaded('google-login'))
                      <a href="{{ route('socialite.customer.google') }}" class="btn btn-block btn-social btn-google btn-lg btn-flat">
                        <i class="fa fa-google"></i> {{ trans('theme.button.login_with_g') }}
                      </a>
                    @endif

                    @if (is_incevio_package_loaded('apple-login'))
                      <a href="{{ route('socialite.customer', 'apple') }}" class="btn btn-block btn-social btn-apple btn-lg btn-flat">
                        <i class="fa fa-apple"></i> {{ trans('appleLogin::lang.login_with_apple') }}
                      </a>
                    @endif
                  </div> <!-- /.social-auth-links -->
                </div> <!-- /.col-sm-12 -->
              </div> <!-- /.row -->
            @endif --}}

            {{-- @if (!is_incevio_package_loaded('otp-login'))
              <a class="btn btn-link" href="{{ route('customer.password.request') }}">
                {{ trans('theme.forgot_password') }}
              </a>
            @endif --}}

            {{-- <a class="btn btn-link" href="{{ route('customer.register') }}" class="text-center">
              {{ trans('theme.register_here') }}
            </a> --}}
            {{-- </div> <!-- /.box --> --}}
          </div> <!-- /.tab-pane -->
        </div><!-- /.tab-content -->
      </div> <!-- /.nav-tabs-custom -->
      {{-- </div> <!-- /.box --> --}}

      @if (config('system_settings.social_auth'))
        <div class="social-auth-links text-center">
          @if (is_incevio_package_loaded('facebook-login'))
            <a href="{{ route('socialite.customer.facebook') }}" class="btn btn-block btn-social btn-facebook btn-lg btn-flat">
              <i class="fa fa-facebook"></i> {{ trans('theme.button.login_with_fb') }}
            </a>
          @endif

          @if (is_incevio_package_loaded('google-login'))
            <a href="{{ route('socialite.customer.google') }}" class="btn btn-block btn-social btn-google btn-lg btn-flat">
              <i class="fa fa-google"></i> {{ trans('theme.button.login_with_g') }}
            </a>
          @endif

          @if (is_incevio_package_loaded('apple-login'))
            <a href="{{ route('socialite.customer', 'apple') }}" class="btn btn-block btn-social btn-apple btn-lg btn-flat">
              <i class="fa fa-apple"></i> {{ trans('appleLogin::lang.login_with_apple') }}
            </a>
          @endif
        </div> <!-- /.social-auth-links -->
      @endif

      <a class="btn btn-link" href="{{ route('customer.register') }}" class="text-center">
        {{ trans('theme.register_here') }}
      </a>
    @else
      <div class="box login-box-body">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('theme.account_login') }}</h3>
        </div> <!-- /.box-header -->
        <div class="box-body">
          {!! Form::open(['route' => 'customer.login.submit', 'id' => 'form', 'data-toggle' => 'validator']) !!}
          <div class="form-group has-feedback">
            {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.email'), 'required']) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group has-feedback">
            {!! Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('theme.placeholder.password'), 'data-minlength' => '6', 'required']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <div class="help-block with-errors"></div>
          </div>

          <div class="row">
            <div class="col-sm-7">
              <div class="form-group">
                <label>
                  {!! Form::checkbox('remember', null, null, ['class' => 'icheck']) !!} {{ trans('theme.remember_me') }}
                </label>
              </div>
            </div>

            <div class="col-sm-5 pull-right">
              {!! Form::submit(trans('theme.button.login'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
            </div>
          </div>
          {!! Form::close() !!}

          @if (config('system_settings.social_auth'))
            <div class="social-auth-links text-center">
              @if (is_incevio_package_loaded('facebook-login'))
                <a href="{{ route('socialite.customer.facebook') }}" class="btn btn-block btn-social btn-facebook btn-lg btn-flat">
                  <i class="fa fa-facebook"></i> {{ trans('theme.button.login_with_fb') }}
                </a>
              @endif

              @if (is_incevio_package_loaded('google-login'))
                <a href="{{ route('socialite.customer.google') }}" class="btn btn-block btn-social btn-google btn-lg btn-flat">
                  <i class="fa fa-google"></i> {{ trans('theme.button.login_with_g') }}
                </a>
              @endif

              @if (is_incevio_package_loaded('apple-login'))
                <a href="{{ route('socialite.customer', 'apple') }}" class="btn btn-block btn-social btn-apple btn-lg btn-flat">
                  <i class="fa fa-apple"></i> {{ trans('appleLogin::lang.login_with_apple') }}
                </a>
              @endif
            </div> <!-- /.social-auth-links -->
          @endif

          {{-- @if (!is_incevio_package_loaded('otp-login')) --}}
          <a class="btn btn-link" href="{{ route('customer.password.request') }}">
            {{ trans('theme.forgot_password') }}
          </a>
          {{-- @endif --}}

          <a class="btn btn-link" href="{{ route('customer.register') }}" class="text-center">
            {{ trans('theme.register_here') }}
          </a>
        </div>
      </div>
    @endif

    @if (config('app.demo') == true)
      <div class="box login-box-body">
        <div class="box-header with-border">
          <h3 class="box-title">Demo Login::</h3>
        </div> <!-- /.box-header -->
        <div class="box-body">
          <p>Username: <strong>customer@demo.com</strong> | Password: <strong>123456</strong></p>
        </div>
      </div>
    @endif
  </div>
@endsection

@section('scripts')
@endsection
