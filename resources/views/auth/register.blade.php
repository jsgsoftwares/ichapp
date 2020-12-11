@extends('layouts.applogin')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="row flexbox-container">
                <div class="col-xl-8 col-10 d-flex justify-content-center">
                    <div class="card bg-authentication rounded-0 mb-0">
                        <div class="row m-0">
                            <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                                <img src="../../../app-assets/images/pages/register.jpg" alt="branding logo">
                            </div>
                            <div class="col-lg-6 col-12 p-0">
                                <div class="card rounded-0 mb-0 p-2">
                                    <div class="card-header pt-50 pb-1">
                                        <div class="card-title">
                                            <h4 class="mb-0">{{ __('Create Account') }}</h4>
                                        </div>
                                    </div>
                                    <p class="px-2">{{ __('Fill the below form to create a new account.') }}</p>
                                    <div class="card-content">
                                        <div class="card-body pt-0">
                                            <form action="index.html">
                                                <div class="form-label-group">
                                                    <input type="text" id="inputName" class="form-control" placeholder="Name" required>
                                                    <label for="inputName">{{ __('Name') }}</label>
                                                </div>
                                                <div class="form-label-group">
                                                    <input type="email" id="inputEmail" class="form-control" placeholder="Email" required>
                                                    <label for="inputEmail">{{ __('Email') }}</label>
                                                </div>
                                                <div class="form-label-group">
                                                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                                    <label for="inputPassword">{{ __('Password') }}Password</label>
                                                </div>
                                                <div class="form-label-group">
                                                    <input type="password" id="inputConfPassword" class="form-control" placeholder="Confirm Password" required>
                                                    <label for="inputConfPassword">{{ __('Confirm Password') }}</label>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <fieldset class="checkbox">
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input type="checkbox" checked>
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                                <span class="">{{ __('I accept the terms & conditions.') }} </span>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <a href="{{ route('login') }}" class="btn btn-outline-primary float-left btn-inline mb-50">{{ __('Login') }}</a>
                                                <button type="submit" class="btn btn-primary float-right btn-inline p-1 mb-50">{{ __('Register') }}</a>
                                            </form>
                                        </div>
                                        <div class="login-footer">
                                            <div class="divider">
                                                <div class="divider-text">{{ __('OR') }} </div>
                                            </div>
                                            <div class="footer-btn d-inline">
                                                <a href="{{route('login.twitter')}}" class="btn btn-twitter white"><span class="fa fa-twitter"></span></a>
                                                <a href="{{route('login.google')}}" class="btn btn-google"><span class="fa fa-google"></span></a>
                                                <a href="{{route('login.facebook')}}" class="btn btn-facebook"><span class="fa fa-facebook"></span></a>
                                                <a href="{{route('login.github')}}" class="btn btn-github"><span class="fa fa-github-alt"></span></a> 
                                            </div>
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
<!-- END: Content-->

@endsection
