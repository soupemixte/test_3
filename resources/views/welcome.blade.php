@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
 <!-- Home Page -->
 <main class="home">
    <section class="welcome">

        <!-- @lang('lang.cellars') -->
        <p>@lang('lang.welcome_message')</p>
        <div class="welcome-buttons">
          <button>
            <a class="nav-link" href="{{ route('login') }}">@lang('lang.login')</a>
          </button>
          <button>
            <a class="nav-link" href="{{ route('user.create') }}">@lang('lang.register_user')</a>
          </button>
        </div>
    </section>

  </main>
@endsection