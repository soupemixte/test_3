@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
 <!-- Home Page -->
 <main class="home">
    <section class="welcome">
        <div class="section-title"><p>@lang('lang.welcome_message')</p></div>
        <!-- @lang('lang.cellars') -->
        
        <div class="welcome-buttons">
          <button class="button-login">
            <a class="nav-link" href="{{ route('login') }}">@lang('lang.login')</a>
          </button>
          <button class="button-register">
            <a class="nav-link" href="{{ route('user.create') }}">@lang('lang.register_user')</a>
          </button>
        </div>
    </section>

  </main>
@endsection