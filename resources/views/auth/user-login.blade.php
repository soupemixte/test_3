@extends('layouts.app')
@section('title', 'Login')
@section('content')

<main class="flex-center height60">
    <section class="structure flex-col gap10">
        <div class="section-title">
            <h2>Formulaire de connexion.</h2>
        </div>
        <div class="line"></div>
        <form method="POST" class="form" action="{{ route('user.login.submit') }}">
            @csrf
            <div class="form-control">
                <label for="username" >@lang('lang.email')</label>
                    <input type="text" id="username" name="email" value="{{old('email', $user->email ?? '')}}">
                </div>
                @if ($errors->has('email'))
                    <div class="alert_msg">
                        {{$errors->first('email')}}
                    </div>
                @endif
            <div class="form-control">
                <label for="password">@lang('lang.password')</label>
                <input type="password" id="password" name="password">
                @if ($errors->has('password'))
                    <div class="alert_msg">
                        {{$errors->first('password')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-border btn-icon btn-go flex-al just-between gap5">@lang('lang.login')<i class="fa-solid fa-right-to-bracket"></i></button>
        </form>
        
        <div class="form_footer">
            <p>@lang('lang.register_question') <a href="{{ route('user.create') }}" class="new_member">@lang('lang.register_subtitle')</a></p>
        </div>
        
    </section>
</main>
@endsection