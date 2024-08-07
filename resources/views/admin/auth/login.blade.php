@extends('admin.layouts.auth')

@section('title')
    {{ __('Login') }}
@endsection

{{--
    @section('language-bar')
    <div class="all-select">
        <a href="#" class="monthly-btn">
            <span class="monthly-text">{{__('Change Language')}}</span>
            <select name="language" id="language" class="select-box" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                @foreach(Utility::languages() as $language)
                    <option @if($lang == $language) selected @endif value="{{ route('login',$language) }}">{{Str::upper($language)}}</option>
                @endforeach
            </select>
        </a>
    </div>
@endsection --}}

@section('content')
    <div class="login-form">
        <div class="page-title"><h5>{{__('Login')}}</h5></div>
        <form method="POST" action="{{ route('admin.loginsubmit') }}" class="needs-validation" novalidate="">
            @csrf
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div class="form-group">
                <label class="form-control-label">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-control-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
                @enderror
            </div>
            <div class="custom-control custom-checkbox remember-me-text">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input" id="remember-me">
                <label class="custom-control-label" for="remember-me">{{ __('Remember Me') }}</label>
            </div>
            <div class="text-xs text-muted text-center">
                <a href="#" class="text-xs">{{ __('Forgot Your Password?') }}</a>
            </div>
            <button type="submit" class="btn-login" tabindex="4">{{ __('Login') }}</button>
        </form>
    </div>
@endsection
