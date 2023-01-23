{{-- Card update form for vendor subscription billing --}}
{!! Form::model($profile, ['method' => 'PUT', 'route' => ['admin.account.card.update'], 'id' => 'stripe-form', 'data-toggle' => 'validator']) !!}

@include('auth.stripe_form')

<div class="text-right">
  {!! Form::submit(trans('app.update'), ['class' => 'btn btn-lg btn-new', 'id' => 'card-button', 'data-secret' => $intent->client_secret]) !!}
</div>
{!! Form::close() !!}
<div class="spacer10"></div>
