@extends('layouts.applogin')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="row flexbox-container">
                <div class="col-xl-8 col-11 d-flex justify-content-center">
                    <div class="card bg-authentication rounded-0 mb-0">
                        <div class="row m-0">
                            <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                <img src="{{asset('app-assets/images/pages/login.png') }}" alt="branding logo">
                            </div>
                            <div class="col-lg-6 col-12 p-0">
                                <div class="card rounded-0 mb-0 px-2">
                                    <div class="card-header pb-1">
                                        <div class="card-title">
                                            <h4 class="mb-0">{{__('Login')}}</h4>
                                        </div>
                                    </div>
                                    @if($errors->any())
                                    <b-alert show variant="danger">
                                    <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                    </b-alert>
                                    @else
                                    <p class="px-2">{{ __('Welcome back, please login to your account.') }}</p>
                                    @endif
                                    
                                    <div class="card-content">
                                        <div class="card-body pt-1">
                                            <form method="POST" action="{{ route('login') }}">
                                                {{ csrf_field() }}
                                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                    <input 
                                                    class="form-control" 
                                                    type="email"
                                                    id="email"
                                                    placeholder="example@123.com"
                                                    value="{{ old('email') }}"
                                                    name="email"
                                                    required autofocus
                                                    >
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    <label for="user-name">{{ __('Username') }}</label>
                                                </fieldset>

                                                <fieldset class="form-label-group position-relative has-icon-left">
                                                    <input
                                                    class="form-control" 
                                                    type="password"
                                                    id="password"
                                                    placeholder="Password"
                                                    name="password"
                                                    required autofocus
                                                     >
                                                    <div class="form-control-position">
                                                        <i class="feather icon-lock"></i>
                                                    </div>
                                                    <label for="user-password">{{ __('Password') }}</label>
                                                </fieldset>
                                                <div class="form-group d-flex justify-content-between align-items-center">
                                                    <div class="text-left">
                                                        <fieldset class="checkbox">
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked="true"' : '' }}>
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                                <span class="">{{ __('Remenber me') }}</span>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="text-right"><a href="{{ route('password.request') }} "class="card-link">Forgot Password?</a></div>
                                                </div>
                                                <a  href="{{ route('register') }}" class="btn btn-outline-primary float-left btn-inline">{{ __('Register') }}</a>
                                                <button type="submit" class="btn btn-primary float-right btn-inline p-1">{{ __('Login') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="login-footer">
                                        <div class="divider">
                                            <div class="divider-text">{{ __('OR') }}</div>
                                        </div>
                                        <div class="footer-btn d-inline">
                                            <a href="{{route('login.facebook')}}" class="btn btn-facebook" ><span class="fa fa-facebook"></span></a>
                                            <a href="{{route('login.twitter')}}" class="btn btn-twitter white"><span class="fa fa-twitter"></span></a>
                                            <a href="{{route('login.google')}}" class="btn btn-google"><span class="fa fa-google"></span></a>
                                            <a href="{{route('login.github')}}" class="btn btn-github"><span class="fa fa-github-alt"></span></a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection
