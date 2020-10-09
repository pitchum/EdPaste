@extends('default')

@section('pagetitle') {{ __('edpaste.page.title.dashboard') }} - {{ config('app.name', 'EdPaste') }} @endsection

@section('navbar')
<li class="nav-item"><a href="/" class="nav-link">{{ __('edpaste.menu.home') }}</a></li>
@if (cas()->isAuthenticated())
<li class="nav-item active"><a href="/users/dashboard" class="nav-link">{{ __('edpaste.menu.dashboard') }}</a></li>
{{--
<li class="nav-item"><a href="/users/account" class="nav-link">My Account</a></li>
<li class="nav-item"><a href="/logout" class="nav-link">Logout <i>({{ User::getCurrentUser()->name }})</i></a></li>
--}}
@else
{{--
<li class="nav-item"><a href="/login" class="nav-link">Login</a></li>
<li class="nav-item"><a href="/register" class="nav-link">Register</a></li>
--}}
@endif
@endsection

@section('script')
<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<h2 class="text-center display-4">{{ __('edpaste.page.title.dashboard') }}</h2>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>{{ __('edpaste.paste.title') }}</th>
          <th class="hidden-xs">{{ __('edpaste.paste.content') }}</th>
          <th class="hidden-xs"></th>
          <th class="hidden-xs"></th>
          <th>{{ __('edpaste.paste.view_count') }}</th>
          <th>{{ __('edpaste.paste.creation') }}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      @foreach ($userPastes as $userPaste)
      <tr>
        <td><a href="/{{ $userPaste->link }}">@if (strlen($userPaste->title) <= 20) {{ $userPaste->title}} @else {{ mb_substr($userPaste->title,0,20,'UTF-8') }}... @endif</a></td>
        <td class="hidden-xs"><i>@if ($userPaste->syntaxHl) <i class="fa fa-file-code-o"></i> &nbsp; @endif @if (strlen($userPaste->content) < 90) {{ $userPaste->content}} @else {{ mb_substr($userPaste->content,0,90,'UTF-8') }}... @endif</i></td>
        {{--  Bloc d'infos  --}}
        <td class="hidden-xs">
          @if ($userPaste->privacy == "link") <i class="fa fa-globe fa-lg" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.option.privacy.link') }}"></i>
          @elseif ($userPaste->privacy == "internal") <i class="fa fa-users fa-lg" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.option.privacy.internal') }}"></i>
          @elseif ($userPaste->privacy == "password") <i class="fa fa-key fa-lg" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.option.privacy.password') }}"></i>
          @elseif ($userPaste->privacy == "private") <i class="fa fa-user-secret fa-lg" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.option.privacy.private') }}"></i> @endif
        </td>
        <td class="hidden-xs">
          @if ($userPaste->expiration == "0") <i class="fa fa-calendar-check-o fa-lg" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.option.expiration.never') }}"></i>
          @elseif ($userPaste->burnAfter == "1") <i class="fa fa-exclamation-circle fa-lg" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.option.expiration.burn_after_reading') }}"></i>
          @elseif (time() > strtotime($userPaste->expiration)) <i class="fa fa-calendar-times-o fa-lg" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.option.expired') }}"></i>
          @else <i class="fa fa-hourglass fa-lg" data-toggle="tooltip" data-placement="bottom" title="Expiration set"></i>@endif
        </td>
        <td class="pull-right"> {{ $userPaste->views }}</td>
        {{-- Là on repasse à la date --}}
        <td>{{ $userPaste->created_at->format('Y-m-d') }}</td>
        <td><button class="btn btn-danger btn-sm pull-right" type="button" data-toggle="modal" data-target="#delete{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapseExample{{ $loop->iteration }}"><i class="fa fa-trash-o"></i></button></td>
      </tr>
      <div class="modal fade" id="delete{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="preview" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="preview" style="word-wrap: break-word;">@lang('edpaste.paste.confirm.delete.title', ['pastename' => $userPaste->title])</h4>
            </div>
            <div class="modal-body">@lang('edpaste.paste.confirm.delete')</div>
            <div class="modal-footer">
              <a class="btn btn-danger btn-sm" href="/users/delete/{{ $userPaste->link }}" role="button">{{ __('edpaste.button.yes') }}</a>
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('edpaste.button.no') }}</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
</div>
</div>
@endsection
