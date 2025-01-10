@extends('layouts.app')
@section('title', 'Login')
@section('content')

<main class="login">        
    <section class="new-login">
        <h2 class="section-title">@lang('lang.login')</h2>
        <div class="form">
        <form method="POST">
            @csrf
            <div class="mb-3 col">
                <label for="username">@lang('lang.login_user')</label>
                <input type="text" id="username" name="email"  value="{{old('email')}}" placeholder="@lang('lang.email_msg')">
                @if ($errors->has('email'))
                    <div class="alert_msg">
                        <p>
                            {{$errors->first('email')}}
                        </p>
                    </div>
                @endif
            </div>
            <div class="mb-3 col">
                <label for="password" class="form-label">@lang('lang.login_pass')</label>
                <input type="password" id="password" name="password">
                @if ($errors->has('password'))
                    <div class="alert_msg">
                        <p>
                            {{$errors->first('password')}}
                        </p>
                    </div>
                @endif
            </div>
            <!-- <p>@lang('lang.login_sub')</p> -->
            <button type="submit" class="login_btn">@lang('lang.login')</button>
            </form>
        <div class="new">
            <p>Pas encore membre ? <a href="{{ route('user.create') }}" class="new_member">@lang('lang.register_subtitle')</a></p>
        </div>
        </div>
    </section>

</main>
@endsection