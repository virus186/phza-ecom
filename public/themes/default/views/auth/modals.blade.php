<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    @if (is_incevio_package_loaded('otp-login'))
      <div class="modal-content p-2">
        <div class="modal-header p-3">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-title text-center">
            <h4>{{ trans('theme.account_login') }}</h4>
          </div>

          <div class="d-flex flex-column text-center">
            <div class="boxed">
              <div class="nav-tabs-custom">
                <ul class="nav nav-justified">
                  <li class="active">
                    <a href="#login_with_email" data-toggle="tab" class="btn btn-default">
                      <i class="fa fa-envelope hidden-sm"></i>
                      @lang('otp-login::lang.login_with_email')
                    </a>
                  </li>

                  <li>
                    <a href="#login_with_phone" data-toggle="tab" class="btn btn-default">
                      <i class="fa fa-phone hidden-sm"></i>
                      @lang('otp-login::lang.login_with_phone')
                    </a>
                  </li>
                </ul>
                <div class="tab-content mb-2" style="border-top: 0">
                  <div class="tab-pane active" id="login_with_email">
                    {!! Form::open(['route' => 'customer.login.submit', 'id' => 'loginForm', 'data-toggle' => 'validator', 'novalidate']) !!}

                    <div class="form-group">
                      <input name="email" id="email" class="form-control input-lg" type="email" placeholder="{{ trans('theme.placeholder.your_email') }}" required />
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <input name="password" id="password" class="form-control input-lg" type="password" placeholder="{{ trans('theme.placeholder.password') }}" required />
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group text-left">
                      <label>
                        <input name="remeber" id="remeber" class="i-check-blue" type="checkbox" /> {{ trans('theme.remember_me') }}
                      </label>
                    </div>

                    <input class="btn btn-primary btn-block btn-lg btn-round mt-3" type="submit" value="{{ trans('theme.button.login') }}">
                    {!! Form::close() !!}
                  </div>
                  <div class="tab-pane" id="login_with_phone">
                    {!! Form::open(['route' => 'customer.login.submit', 'id' => 'loginForm', 'data-toggle' => 'validator', 'novalidate']) !!}

                    @include('otp-login::phone_field')

                    <input class="btn btn-primary btn-block btn-lg btn-round mt-3" type="submit" value="{{ trans('theme.button.login') }}">
                    {!! Form::close() !!}
                  </div>
                </div><!-- /.tab-pane -->
              </div><!-- /.tab-content -->
            </div> <!-- /.nav-tabs-custom -->
          </div> <!-- /.d-flex -->
        </div> <!-- /.modal-body -->

        @include('theme::auth._social_login')

        <div class="modal-footer d-flex justify-content-center">
          <div class="signup-section">
            <a href="javascript:void(0);" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#passwordResetModal">{{ trans('theme.forgot_password') }}</a>

            <a href="javascript:void(0);" class="btn btn-link text-info" data-dismiss="modal" data-toggle="modal" data-target="#createAccountModal">{{ trans('theme.register_here') }}</a>
          </div>
        </div> <!-- /.modal-footer -->
      </div> <!-- /#loginModal -->
    @else
      <div class="modal-content p-2">
        <div class="modal-header p-3">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-title text-center">
            <h4>{{ trans('theme.account_login') }}</h4>
          </div>

          <div class="d-flex flex-column text-center">
            {!! Form::open(['route' => 'customer.login.submit', 'id' => 'loginForm', 'data-toggle' => 'validator', 'novalidate']) !!}
            <div class="form-group">
              <input name="email" id="email" class="form-control input-lg" type="email" placeholder="{{ trans('theme.placeholder.your_email') }}" required />
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <input name="password" id="password" class="form-control input-lg" type="password" placeholder="{{ trans('theme.placeholder.password') }}" required />
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group text-left">
              <label>
                <input name="remeber" id="remeber" class="i-check-blue" type="checkbox" /> {{ trans('theme.remember_me') }}
              </label>
            </div>

            <input class="btn btn-primary btn-block btn-lg btn-round mt-3" type="submit" value="{{ trans('theme.button.login') }}">
            {!! Form::close() !!}

            @include('theme::auth._social_login')
          </div>
        </div>

        <div class="modal-footer d-flex justify-content-center">
          <div class="signup-section">
            @if (!is_incevio_package_loaded('otp-login'))
              <a href="javascript:void(0);" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#passwordResetModal">{{ trans('theme.forgot_password') }}</a>
            @endif

            <a href="javascript:void(0);" class="btn btn-link text-info" data-dismiss="modal" data-toggle="modal" data-target="#createAccountModal">{{ trans('theme.register_here') }}</a>
          </div>
        </div>
      </div>
    @endif
  </div>
</div> <!-- /#loginModal -->

<div class="modal fade" id="createAccountModal" tabindex="-1" role="dialog" aria-labelledby="createAccountModal" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content px-3">
      <div class="modal-header p-3">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4>{{ trans('theme.create_account') }}</h4>
        </div>

        <div class="d-flex flex-column text-center">
          {!! Form::open(['route' => 'customer.register', 'id' => 'registerForm', 'data-toggle' => 'validator', 'novalidate']) !!}
          <div class="form-group">
            <input name="name" class="form-control input-lg" placeholder="{{ trans('theme.placeholder.full_name') }}" type="text" required />
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <input name="email" class="form-control input-lg" placeholder="{{ trans('theme.placeholder.your_email') }}" type="email" required />
            <div class="help-block with-errors"></div>
          </div>
          @if (is_incevio_package_loaded('otp-login'))
            @include('otp-login::phone_field')
          @endif
          <div class="row">
            <div class="col-md-6 pr-1">
              <div class="form-group">
                <input name="password" class="form-control input-lg" placeholder="{{ trans('theme.placeholder.password') }}" type="password" required />
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6 pl-1">
              <div class="form-group">
                <input name="password_confirmation" class="form-control input-lg" placeholder="{{ trans('theme.placeholder.confirm_password') }}" type="password" required />
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="form-group text-left pb-2 has-feedback">
            @if (config('services.recaptcha.key'))
              <div class="g-recaptcha" data-sitekey="{!! config('services.recaptcha.key') !!}"></div>
            @endif
            <div class="help-block with-errors"></div>
          </div>

          @if (config('system_settings.ask_customer_for_email_subscription'))
            <div class="form-group text-left pb-2">
              <label>
                <input name="subscribe" class="i-check-blue" type="checkbox" /> {{ trans('theme.input_label.subscribe_to_the_newsletter') }}
              </label>
            </div>
          @endif

          <div class="form-group text-left pb-2">
            <label>
              <input name="agree" class="i-check-blue" type="checkbox" required /> {!! trans('theme.input_label.i_agree_with_terms', ['url' => route('page.open', \App\Models\Page::PAGE_TNC_FOR_CUSTOMER)]) !!}
            </label>
            <div class="help-block with-errors"></div>
          </div>

          <input class="btn btn-primary btn-block btn-lg btn-round mt-2" type="submit" value="{{ trans('theme.create_account') }}">
          {!! Form::close() !!}

          @include('theme::auth._social_login')
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">
          <a href="javascript:void(0);" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">{{ trans('theme.have_account') }}</a>
        </div>
      </div>
    </div>
  </div>
</div> <!-- /#createAccountModal -->

<div class="modal fade" id="passwordResetModal" tabindex="-1" role="dialog" aria-labelledby="passwordResetModal" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content px-2">
      <div class="modal-header p-3">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4>{{ trans('theme.password_recovery') }}</h4>
        </div>

        <div class="d-flex flex-column text-center">
          {!! Form::open(['route' => 'customer.password.email', 'id' => 'psswordRecoverForm', 'data-toggle' => 'validator', 'novalidate']) !!}
          <div class="form-group">
            <input name="email" class="form-control input-lg" placeholder="{{ trans('theme.placeholder.your_email') }}" type="email" required />
            <div class="help-block with-errors"></div>
          </div>

          <input class="btn btn-primary btn-block btn-lg btn-round mt-3" type="submit" value="{{ trans('theme.button.recover_password') }}">
          {!! Form::close() !!}
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">
          <a href="javascript:void(0);" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">{{ trans('theme.login') }}</a>
        </div>
      </div>
    </div>
  </div>
</div> <!-- /#passwordResetModal -->

{{-- Include the recaptcha api script when its enabled --}}
@if (config('services.recaptcha.key'))
  @include('theme::scripts.recaptcha')
@endif
