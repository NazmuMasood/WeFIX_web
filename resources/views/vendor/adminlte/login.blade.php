@extends('adminlte::master')

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('title', 'WeFIX Admin')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', 'login-page')

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{url('/')}}"><img src="{{ asset('app_icon.png')}}" alt="Wefix logo" class="rounded-circle" height="48"></a>
            <a href="{{url('/')}}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
            {{-- <a href="{{ $dashboard_url }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a> --}}
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                    {{-- {{ __('adminlte::adminlte.login_message') }} --}}
                    Login to view pollution reports
                </p>
                <form action="{{ $login_url }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('adminlte::adminlte.password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="far fa-eye field-icon" id="togglePassword"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <button style="border-radius: 5px;" type="submit" class="btn btn-primary btn-block btn-flat">
                        {{-- {{ __('adminlte::adminlte.sign_in') }} --}}
                        LOGIN
                    </button>
                    <div class="row" style="display:block;overflow:auto;margin: 14px 0px 0px 0px;">
                        {{-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">{{ __('adminlte::adminlte.remember_me') }}</label>
                            </div>
                        </div> --}}
                        <div style="float:left;">
                            @if ($register_url)
                                <p style="text-align:left;">
                                    No account? 
                                    <a href="{{ $register_url }}">
                                        {{-- {{ __('adminlte::adminlte.register_a_new_membership') }} --}}
                                        Sign up!
                                    </a>
                                </p>
                            @endif                           
                        </div>
                        <div style="float: right;">
                            <p style="text-align:right;">
                                <a href="{{ $password_reset_url }}">
                                    {{-- {{ __('adminlte::adminlte.i_forgot_my_password') }} --}}
                                    Forgot password?
                                </a>
                            </p>
                        </div>
                        {{-- <div class="col-4" style="margin-top: 5px;"> --}}
                            {{-- button was here --}}
                        {{-- </div> --}}
                    </div>
                </form>
                {{-- <p class="mt-2 mb-1">
                    <a href="{{ $password_reset_url }}">
                        {{ __('adminlte::adminlte.i_forgot_my_password') }}
                    </a>
                </p>
                @if ($register_url)
                    <p class="mb-0">
                        <a href="{{ $register_url }}">
                            {{ __('adminlte::adminlte.register_a_new_membership') }}
                        </a>
                    </p>
                @endif --}}
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script>
        function showPassword() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
    </script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    @stack('js')
    @yield('js')
@stop
