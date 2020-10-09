
@extends('default')

@section('pagetitle') {{ $title }} - {{ config('app.name', 'EdPaste') }} @endsection

@section('navbar')
<li class="nav-item"><a href="/" class="nav-link">{{ __('edpaste.menu.home') }}</a></li>
@if (cas()->isAuthenticated())
<li class="nav-item"><a href="/users/dashboard" class="nav-link">{{ __('edpaste.menu.dashboard') }}</a></li>
{{--
<li class="nav-item"><a href="/users/account" class="nav-link">My Account</a></li>
--}}
<li class="nav-item"><a href=" /logout" class="nav-link">{{ __('edpaste.menu.logout') }} <i>({{ cas()->getCurrentUser() }})</i></a></li>
@else
{{--
<li class="nav-item"><a href="/login" class="nav-link">Login</a></li>
<li class="nav-item"><a href="/register" class="nav-link">Register</a></li>
--}}
@endif
@endsection

@section('style')
<link rel="stylesheet" href="/highlight_styles/tomorrow.css">
<style>
	@if ($syntaxHl == true)
	pre {
		overflow: auto;
		word-wrap: normal;
		background:none;
		padding:0px;
		font-size: 75%;
		word-break: normal;
	}
	pre code {
		white-space: pre;
	}
	.hljs-line-numbers {
		text-align: right;
		border-right: 1px solid #ccc;
		color: #999;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	@else
	pre {
		color: #000;
		word-break: normal;
	}
	@endif
</style>
@endsection

@section('script')
@if ($syntaxHl == true)
<script src="highlight.pack.js"></script>
<script src="highlightjs-line-numbers.min.js"></script>
<script>
	hljs.initHighlightingOnLoad();
	hljs.initLineNumbersOnLoad();
</script>
@endif
@endsection

@section('content')
<div class="container">
	@if ($expiration == "Expired")
	<div class="alert alert-info" role="alert">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<i>{{ __('edpaste.paste.msg.expired.viewable') }}</i>
	</div>
	@elseif ($expiration == "Burn after reading (next time)")
	<div class="alert alert-warning" role="alert">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<i>{{ __('edpaste.paste.msg.burnafter.viewable') }}</i>
	</div>
	@elseif ($expiration == "Burn after reading")
	<div class="alert alert-danger" role="alert">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<i>@lang('edpaste.paste.msg.burnafter.last.view')</i>
	</div>
	@endif
	<div class="row">
		<div class="col-sm-11">
			<h3 style="margin-top:0px; word-wrap: break-word;">{{ $title }}</h3>
		</div>
		{{-- Ici le petit panel de gestion --}}
		@if ($sameUser == true)
		<div class="col-sm-1 hidden-xs">
			<button class="btn btn-danger btn-sm pull-right" type="button" data-toggle="modal" data-target="#delete" aria-expanded="false" aria-controls="collapse}"><i class="fa fa-trash-o"></i></button>
		</div>
		<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="preview" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="preview" style="word-wrap: break-word;">@lang('edpaste.paste.confirm.delete.title', ['pastename' => $title])</h4>
					</div>
					<div class="modal-body">@lang('edpaste.paste.confirm.delete')</div>
					<div class="modal-footer">
						<a class="btn btn-danger btn-sm" href="/users/delete/{{ $link }}" role="button">{{ __('edpaste.button.yes') }}</a>
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('edpaste.button.no') }}</button>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
	<div class="row">
		<div class="col-xs-12">
			<ul class="list-inline" style="color:#999FA4;">
				<script>
					$(function () {
						$('[data-toggle="tooltip"]').tooltip()
					})
				</script>
				<li><i class="fa fa-user" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.username') }}"></i> <i class="username">{{ $username }}</i></li>
				<li><i class="fa fa-calendar" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.creation') }}"></i> <i class="date" data-toggle="tooltip" data-placement="bottom" title="{{ $fulldate }}">{{ $date }}</i></li>
				<li><i class="fa fa-eye" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.view_count') }}"></i> <i>{{ trans_choice('edpaste.paste.views', $views, ['count' => $views]) }}</i></li>
				{{-- Expiration cachée si xs --}}
				<li @if ($expiration == "Never") class="hidden-xs" @endif><i class="fa fa-clock-o" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.expiration') }}"></i> <i>@if ($expiration == "Never") {{ __('edpaste.paste.option.expiration.never') }} @else {{ $expiration }} @endif</i></li>

				{{-- Privacy cachée si xs --}}
				<li @if ($privacy == "Public") class="hidden-xs" @endif><i class="fa fa-lock" data-toggle="tooltip" data-placement="bottom" title="{{ __('edpaste.paste.privacy') }}"></i> <i>{{ $privacy }}</i></li>
			</ul>
		</div>
	</div>

	{{-- N'est formaté que si le SH est activé --}}
	<div class="row" @if ($syntaxHl == true) style="margin-bottom:20px;" @endif>
		<div class="col-sm-12">
			<label for="paste"><i>@if ($syntaxHl == true) {{ __('edpaste.paste.syntax-highlighted') }} @else {{ __('edpaste.paste.plain-text') }} @endif</i></label>
			@if ($privacy != "Password-protected") <i class="pull-right"><a href="/raw/{{ $link }}">{{ __('edpaste.paste.raw') }}</a> @endif </i>
			@if ($sameUser) <i class="pull-right" style="margin-right: 10px;"><a href="/edit/{{ $link }}">{{ __('edpaste.paste.edit') }}</a> @endif </i>
			<pre id="paste"><code class="code">@if ($syntaxHl == false)<i>@endif{{ $content }} @if ($syntaxHl == false)</i>@endif</code></pre>
		</div>
	</div>
</div>
@endsection
