@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', 'register-page')

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{url('/')}}"><img src="{{ asset('app_icon.png')}}" alt="Wefix logo" class="rounded-circle" height="48"></a>
            <a href="{{url('/')}}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
            {{-- <a href="{{ $dashboard_url }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a> --}}
        </div>
        <div class="card">
            <div class="card-body register-card-body">
            <p class="login-box-msg">
                {{-- {{ __('adminlte::adminlte.register_message') }} --}}
                Create a new account
            </p>
            <form action="{{ $register_url }}" method="post">
                {{ csrf_field() }}

                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}"
                           placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>

                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}"
                           placeholder="{{ __('adminlte::adminlte.email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="{{ __('adminlte::adminlte.password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="far fa-eye field-icon" id="togglePassword"></span>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                           placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="far fa-eye field-icon" id="togglePasswordConfirmation"></span>
                        </div>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </div>
                    @endif
                </div>
                <button style="border-radius: 5px;" type="submit" class="btn btn-primary btn-block btn-flat">
                    {{-- {{ __('adminlte::adminlte.register') }} --}}
                    SIGN UP
                </button>
            </form>
            <p class="mt-2 mb-1">
                Already have an account?
                <a href="{{ $login_url }}">
                    {{-- {{ __('adminlte::adminlte.i_already_have_a_membership') }} --}}
                    Login!
                </a>
            </p>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script>
        const togglePassword1 = document.querySelector('#togglePassword');
        const password1 = document.querySelector('#password');
        togglePassword1.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
            password1.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    
        const togglePassword2 = document.querySelector('#togglePasswordConfirmation');
        const password2 = document.querySelector('#password_confirmation');
        togglePassword2.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
            password2.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    @stack('js')
    @yield('js')
@stop
