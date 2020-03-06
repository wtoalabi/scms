@extends('shared.layouts.app',['title'=>'Login'])
@section('content')
    <div class="container">
        <h1>Main Landing</h1>
        @guest
            <a href={{route('user_login')}}>Login</a>
            <a href="{{route('user_register')}}">Register</a>
        @endguest
        @auth('user')
            <a href="{{route('user_dashboard')}}">Dashboard</a>
            <form  id="user_logout" action="{{route('user_logout')}}" METHOD="POST">
                @csrf
                <button class="button" type="submit">Logout</button>
            </form>
        @endauth

    </div>
@endsection

