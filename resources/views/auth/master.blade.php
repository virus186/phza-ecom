<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? get_site_title() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="{{ mix("css/app.css") }}" rel="stylesheet">

    @if(is_incevio_package_loaded('otp-login'))
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  @endif

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .select2-selection__arrow{
        display: none;
      }
      .form-control-feedback{
        width: 46px;
        height: 46px;
        line-height: 46px;
      }
      .select2-container--default .select2-selection--single {
          height: 46px !important;
          padding: 10px 16px;
          font-size: 18px;
          line-height: 1.33;
      }
      .select2-container--default .select2-selection--single .select2-selection__rendered {
          line-height: 31px !important;
      }

      .iti {
          display: block;
      }
    </style>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>{{ trans('app.error') }}!</strong> {{ trans('messages.input_error') }}<br><br>
              <ul class="list-group">
                  @foreach ($errors->all() as $error)
                      <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      @if (Session::has('message'))
          <div class="alert alert-success">
            {{ Session::get('message') }}
          </div>
      @endif

      <div class="login-logo">
        <a href="{{ url('/') }}">{{ get_site_title() }}</a>
      </div>

      @yield('content')

    </div>
    <!-- /.login-box -->

    <script src="{{ mix("js/app.js") }}"></script>

    <!-- Scripts -->
    @yield('scripts', '')

    @if(is_incevio_package_loaded('otp-login'))
      @include('otp-login::scripts')
    @endif

    <script type="text/javascript">
      // ;(function($, window, document) {
        $("#plans").select2({
          minimumResultsForSearch: -1,
        });
        $("#exp-year").select2({
          placeholder: "{{ trans('app.placeholder.exp_year') }}",
          minimumResultsForSearch: -1,
        });
        $("#exp-month").select2({
          placeholder: "{{ trans('app.placeholder.exp_month') }}",
          minimumResultsForSearch: -1,
        });

        $('.icheck').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
      // });
    </script>

    <div class="loader">
      <center>
        <img class="loading-image" src="{{ asset('images/gears.gif') }}" alt="busy...">
      </center>
    </div>
  </body>
</html>
