@extends('user.auth.layouts.app',['title'=>'Login'])
@section('content')
    <div class="container">
        <h1 class="title">Login!</h1>
        <form method="POST" action="{{ route('user_login') }}">
            @csrf
            <div>
                <input id="email" placeholder="Email" type="email" class=" input @error('email')
                    is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email"
                       autofocus>

                @error('email')
                    <strong class="error">{{ $message }}</strong>
                @enderror
            </div>
            <div>
                <input id="password" type="password" placeholder="Password"
                       class="input @error('password') is-invalid @enderror" name="password"
                       required autocomplete="current-password">

                @error('password')
                    <strong class="error">{{ $message }}</strong>
                @enderror
            </div>
            <div class="action">
                <button type="submit" class="button">
                    {{ __('Login') }}
                </button>

            </div>
        </form>
        <div class="login_bottom_links">
            <a href="{{route('landing')}}">Go Home</a>
            <a href="/forgot-password">Forgot Password?</a>
            <a href="/register">Register</a>
        </div>
    </div>
@endsection
<style>

</style>
