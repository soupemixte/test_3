@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
 <!-- Home Page -->
 <main class="home">
    <section class="welcome">
        <div class="section-title"><h2>@lang('lang.welcome_message')</h2></div>
        <!-- @lang('lang.cellars') -->
        
        <div class="welcome-buttons">
          @guest
            <button class="button-login">
              <a class="nav-link" href="{{ route('login') }}">@lang('lang.login')</a>
            </button>
            <button class="button-register">
              <a class="nav-link" href="{{ route('user.create') }}">@lang('lang.register_user')</a>
            </button>
          @else
            <button class="button-login">
              <a class="nav-link" href="{{ route('logout') }}">@lang('lang.logout')</a>
            </button>
              
          @endguest
          
        </div>
    </section>

  </main>
@endsection