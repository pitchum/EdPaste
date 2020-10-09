@extends('default')

@section('pagetitle') {{ __('edpaste.page.title.notfound') }} - {{ config('app.name', 'EdPaste') }} @endsection

@section('navbar')

@endsection

@section('content')
<div class="container">
  <div class="text-center">
    <div class="jumbotron">
      <h1><i>Page not found</i></h1>
      <p class="lead hidden-xs">{{ __('edpaste.paste.notfound') }}</p>
      <hr class="m-y-2">
      @if (cas()->isAuthenticated())
      <p class="lead">
        <a class="btn btn-danger btn-lg" href="/" role="button">{{ __('edpaste.button.goto.home') }}</a>
      </p>
      @else
      <p class="lead">
        <a id="authlink" class="btn btn-danger btn-lg" href="/retryAfterAuth" role="button">{{ __('edpaste.button.goto.auth') }}</a>
      </p>
      @endif
    </div>
  </div>
</div>
@endsection
