@extends('default')

@section('pagetitle') {{ __('edpaste.page.title.edit', ['pastename' => $title]) }} - {{ config('app.name', 'EdPaste') }} @endsection

@section('navbar')
<li class="nav-item"><a href="/" class="nav-link">{{ __('edpaste.menu.home') }}</a></li>
{{--
@if (cas()->isAuthenticated())
<li class="nav-item"><a href="/users/dashboard" class="nav-link">{{ __('edpaste.menu.dashboard') }}</a></li>
<li class="nav-item"><a href="/users/account" class="nav-link">My Account</a></li>
<li class="nav-item"><a href=" /logout" class="nav-link">Logout <i>({{ User::getCurrentUser()->name }})</i></a></li>
@else
<li class="nav-item"><a href="/login" class="nav-link">Login</a></li>
<li class="nav-item"><a href="/register" class="nav-link">Register</a></li>
@endif
--}}
@endsection

@section('script')
<script src="../jquery.autogrowtextarea.min.js"></script>
<script>
	function checkvalue(value)
	{
		if(value==="password")
			document.getElementById('passwordInput').style.display='block';
		else
			document.getElementById('passwordInput').style.display='none';
	}
</script>
@endsection

@section('content')
<div class="container">
	<form action="/edit/{{ $link }}" method="post" accept-charset="utf-8">
		{{ csrf_field() }}
		{{-- Ca c'est pour éviter que les navigateurs préremplissent les champs --}}
		<input style="display:none" type="text" name="fakeusernameremembered"/>
		<input style="display:none" type="password" name="fakepasswordremembered"/>

		<div class="row">
			<div class="form-group col-xs-12 @if ($errors->has('pasteTitle')) has-error @endif">
				<label for="pasteTitle">{{ __('edpaste.paste.title') }}</label>
				<input type="text" class="form-control" name="pasteTitle" id="pasteTitle" placeholder="{{ __('edpaste.paste.title.placeholder') }}" maxlength="70" value="{{ old('pasteTitle') ? old('pasteTitle') : $title }}">
				@if ($errors->has('pasteTitle'))
				<span class="help-block">
					<strong>{{ $errors->first('pasteTitle') }}</strong>
				</span>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="form-group col-xs-12 @if ($errors->has('pasteContent')) has-error @endif">
				<label for="pasteContent">{{ __('edpaste.paste.content') }}</label>
				<script type="text/javascript">
					$(document).ready(function(){
						$("#pasteContent").autoGrow();
					});
				</script>
				<textarea class="form-control input-sm" name="pasteContent" id="pasteContent" rows="15" placeholder="{{ __('edpaste.paste.content.placeholder') }}" style="font-family: monospace;">{{ old('pasteContent') ? old('pasteContent') : $content }}</textarea>
				@if ($errors->has('pasteContent'))
				<span class="help-block">
					<strong>{{ $errors->first('pasteContent') }}</strong>
				</span>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-3 @if ($errors->has('expire')) has-error @endif">
				<label for="expire">{{ __('edpaste.paste.expiration') }}</label>
				<select class="form-control" name="expire" id="expire">
                    <option disabled selected></option>
                                        <option value="never" selected="selected">{{ __('edpaste.paste.option.expiration.never') }}</option>
                                        <option value="burn">{{ __('edpaste.paste.option.expiration.burn_after_reading') }}</option>
                                        <option value="10m">{{ __('edpaste.paste.option.expiration.10min') }}</option>
                                        <option value="1h">{{ __('edpaste.paste.option.expiration.1h') }}</option>
                                        <option value="1d">{{ __('edpaste.paste.option.expiration.1d') }}</option>
                                        <option value="1w">{{ __('edpaste.paste.option.expiration.1w') }}</option>
				</select>
                @if ($errors->has('expire'))
				<span class="help-block">
					<strong>{{ $errors->first('expire') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group col-sm-3 @if ($errors->has('pastePassword')) has-error @endif">
                                <label for="privacy">{{ __('edpaste.paste.privacy') }}</label>
                                <select class="form-control" name="privacy" id="privacy" onchange='checkvalue(this.value)'>
                                        <option value="link">{{ __('edpaste.paste.option.privacy.link') }}</option>
                                        <option value="internal">{{ __('edpaste.paste.option.privacy.internal') }}</option>
                                        <option value="password" @if ($errors->has('pastePassword')) selected="selected" @endif>{{ __('edpaste.paste.option.privacy.password') }}</option>
                                        @if (cas()->isAuthenticated())
                                        <option value="private">{{ __('edpaste.paste.option.privacy.private') }}</option>
                                        @endif
                                </select>
			</div>
			{{-- Ce truc n'apparait que si "Password-protected" est séléctionné plus haut --}}
			<div class="form-group col-sm-2 @if ($errors->has('pastePassword')) has-error @endif" id="passwordInput" @if (!$errors->has('pastePassword')) style="display:none;" @endif>
				<label for="pastePassword">{{ __('edpaste.password.title') }}</label>
				<input type="password" class="form-control" name="pastePassword" id="pastePassword" placeholder="{{ __('edpaste.password.field.placeholder') }}" maxlength="40">
				@if ($errors->has('pastePassword'))
				<span class="help-block">
					<strong>{{ $errors->first('pastePassword') }}</strong>
				</span>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="form-group text-center">
				<script>
					$(function () {
						$('[data-toggle="tooltip"]').tooltip()
					})
				</script>
				{{-- La tooltip n'apparaît que pour les users non-id et le btn devient danger si y'a des erreurs --}}
				<div class="checkbox">
					<label><input type="checkbox" name="syntaxHl" @if ($syntaxHl) checked @endif>{{ __('edpaste.paste.option.enable.syntax') }}</label>
				</div>
				<button type="submit" id="submit" class="btn @if (count($errors) > 0) btn-danger @else btn-outline-success @endif  btn-lg" @if (!cas()->isAuthenticated()) data-toggle="tooltip" data-placement="top" title="Registered users have access to other privacy tools" @endif>{{ __('edpaste.paste.submit') }}</button>
			</div>
		</div>

	</div>
</div>
</form>
</div>
@endsection
